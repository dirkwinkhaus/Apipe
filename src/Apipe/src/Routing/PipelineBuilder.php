<?php

namespace Apipe\Routing;

use Apipe\Exception\VerbUnknownException;
use Apipe\Middleware\ValidatorMiddlewareFactory;
use Apipe\Model\ApiModel;
use Apipe\Model\EndpointGroupModel;
use Apipe\Model\EndpointModel;
use Apipe\Model\EndpointVersionModel;
use Apipe\Model\ParameterModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Application;
use Zend\Stratigility\MiddlewareInterface;

/**
 * Class RoutingCreator
 * @package Aipe\Routing
 *
 * @author Dirk Winkhaus <dirkwinkhaus@googlemail.com>
 */
class PipelineBuilder implements MiddlewareInterface
{
    /**
     * @var Application
     */
    private $application;
    /**
     * @var ApiModel
     */
    private $apiModel;
    /**
     * @var ValidatorMiddlewareFactory
     */
    private $validatorMiddlewareFactory;

    /**
     * RoutingCreator constructor.
     * @param Application $application
     * @param ApiModel $apiModel
     * @param ValidatorMiddlewareFactory $validatorMiddlewareFactory
     */
    public function __construct(
        Application $application,
        ApiModel $apiModel,
        ValidatorMiddlewareFactory $validatorMiddlewareFactory
    ) {
        $this->application = $application;
        $this->apiModel = $apiModel;
        $this->validatorMiddlewareFactory = $validatorMiddlewareFactory;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable $next
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $this->buildPipelines();

        if ($next) {
            return $next($request, $response);
        }

        return $response;
    }

    /**
     * @return void
     */
    private function buildPipelines(): void
    {
        $apiModel = $this->apiModel;

        foreach ($apiModel->getEndpointGroups() as $endpointGroup) {
            /** @var EndpointGroupModel $endpointGroup */
            $groupUri = $endpointGroup->getUri();

            foreach ($endpointGroup->getEndpoints() as $endpoint) {
                /** @var EndpointModel $endpoint */
                $endpointUri = $endpoint->getUri();

                /** @var EndpointVersionModel $currentEndpointVersion */
                $currentEndpointVersion = $endpoint->getVersions()[$endpoint->getCurrentVersion()];

                foreach ($currentEndpointVersion->getAllowedVerbs() as $verbKey => $verbPipeline) {

                    $pipelineBefore = array_merge(
                        $apiModel->getBefore(),
                        $endpointGroup->getBefore(),
                        $endpoint->getBefore(),
                        $currentEndpointVersion->getBefore()
                    );
                    $pipelineBefore = $this->addValidation($currentEndpointVersion->getParameter(), $pipelineBefore);

                    $pipelineAfter = array_merge(
                        $apiModel->getAfter(),
                        $endpointGroup->getAfter(),
                        $endpoint->getAfter(),
                        $currentEndpointVersion->getAfter()
                    );

                    $this->addRoute(
                        $groupUri,
                        $endpointUri,
                        $verbKey,
                        $verbPipeline,
                        $pipelineBefore,
                        $pipelineAfter,
                        $currentEndpointVersion->getParameter()
                    );
                }
            }
        }
    }

    /**
     * @param string $groupUri
     * @param string $endpointUri
     * @param string $verbKey
     * @param array $verbPipeline
     * @param array $pipelineBefore
     * @param array $pipelineAfter
     * @param ParameterModel $parameter
     */
    private function addRoute(
        string $groupUri,
        string $endpointUri,
        string $verbKey,
        array $verbPipeline,
        array $pipelineBefore,
        array $pipelineAfter,
        ParameterModel $parameter
    ): void {

        $uri = '/' . $groupUri . '/' . $endpointUri . $this->generateParameterUri($parameter);

        switch (strtolower($verbKey)) {
            case 'get':
                $this->application->get(
                    $uri,
                    array_merge(
                        $pipelineBefore,
                        $verbPipeline,
                        $pipelineAfter
                    )
                );
                break;
            case 'post':
                $this->application->post(
                    $uri,
                    array_merge(
                        $pipelineBefore,
                        $verbPipeline,
                        $pipelineAfter
                    )
                );
                break;
            case 'put':
                $this->application->put(
                    $uri,
                    array_merge(
                        $pipelineBefore,
                        $verbPipeline,
                        $pipelineAfter
                    )
                );
                break;
            case 'patch':
                $this->application->patch(
                    $uri,
                    array_merge(
                        $pipelineBefore,
                        $verbPipeline,
                        $pipelineAfter
                    )
                );
                break;
            case 'delete':
                $this->application->delete(
                    $uri,
                    array_merge(
                        $pipelineBefore,
                        $verbPipeline,
                        $pipelineAfter
                    )
                );
                break;
            default:
                throw new VerbUnknownException($verbKey);
        }
    }

    /**
     * @param $parameter
     * @return string
     */
    private function generateParameterUri(ParameterModel $parameter): string
    {
        return
            $this->generateRequiredParameterUri($parameter) .
            $this->generateOptionalParameterUri($parameter);
    }

    /**
     * @param ParameterModel $parameter
     * @return string
     */
    private function generateOptionalParameterUri(ParameterModel $parameter): string
    {
        $parameterUri = '';

        $optionalCount = count($parameter->getOptional());
        if ($optionalCount > 0) {
            foreach ($parameter->getOptional() as $parameterKey => $parameterValue) {
                $parameterUri .= '[/:' . $parameterKey;
            }
            for ($i = 0; $i < $optionalCount; $i++) {
                $parameterUri .= ']';
            }
        }
        return $parameterUri;
    }

    /**
     * @param ParameterModel $parameter
     * @return string
     */
    private function generateRequiredParameterUri(ParameterModel $parameter): string
    {
        $parameterUri = '';

        $requiredCount = count($parameter->getRequired());
        if ($requiredCount > 0) {
            foreach ($parameter->getRequired() as $parameterKey => $parameterValue) {
                $parameterUri .= '/:' . $parameterKey;
            }
        }
        return $parameterUri;
    }

    /**
     * @param ParameterModel $parameterModel
     * @param array $verbPipeline
     * @return array
     */
    private function addValidation(ParameterModel $parameterModel, array $verbPipeline): array
    {
        if (
            count($parameterModel->getRequired()) > 0 ||
            count($parameterModel->getOptional()) > 0
        ) {
            $verbPipeline[] = $this->validatorMiddlewareFactory->create($parameterModel);
        }
        return $verbPipeline;
    }
}