<?php
/**
 * Created by PhpStorm.
 * User: dirk
 * Date: 10.08.17
 * Time: 21:47
 */

namespace Apipe\Model;

use Apipe\Config\ApipeConfig;
use Apipe\Config\ApipeConfigInterface;
use Interop\Container\ContainerInterface;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

/**
 * Class ApiModelFactory
 * @package Apipe\Model
 */
class ApiModelFactory
{
    /**
     * @param ContainerInterface $container
     * @return ApiModel
     */
    public function __invoke(ContainerInterface $container): ApiModel
    {
        /** @var ApipeConfig $apipeConfig */
        $apipeConfig = $container->get(ApipeConfigInterface::class);
        /** @var Serializer $serializer */
        $serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy())
            ->build();

        // todo: find better solution for annotation warmup
        new Type();

        $config = $apipeConfig->getConfig();
        $model = $serializer->fromArray($config, ApiModel::class);

        return $model;
    }

}