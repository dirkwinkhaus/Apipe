<?php
/**
 * Created by PhpStorm.
 * User: dirk
 * Date: 10.08.17
 * Time: 21:23
 */

namespace Apipe\Config;

use Symfony\Component\Filesystem\Filesystem;
use Zend\ServiceManager\Config;

/**
 * Class ApipeConfig
 * @package Apipe\Config
 */
class ApipeConfig implements ApipeConfigInterface
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var ConfigDissolver
     */
    private $configDissolver;
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * ApipeConfig constructor.
     * @param Filesystem $filesystem
     * @param ConfigDissolver $configDissolver
     * @param array $config
     */
    public function __construct(
        Filesystem $filesystem,
        ConfigDissolver $configDissolver,
        array $config
    ) {
        $this->filesystem = $filesystem;
        $fileName         = $this->buildFileName($config);
        $cacheEnabled     = $this->isCacheEnabled($config);

        if ($cacheEnabled && file_exists($fileName)) {
            $this->loadCachedConfig($fileName);
        } else {
            $this->generateConfig($config, $configDissolver);
        }

        if ($cacheEnabled && !file_exists($fileName)) {
            $this->createCacheFile($fileName);
        }
    }

    /**
     * @param array $config
     * @return array
     */
    private function dissolveConfig(array $config): array
    {
        if (isset($config['endpointGroups'])) {
            $config['endpointGroups'] = $this->configDissolver->dissolve($config['endpointGroups']);

            foreach ($config['endpointGroups'] as $endpointGroupKey => $endpointGroupValue) {
                $config['endpointGroups'][$endpointGroupKey]['endpoints'] =
                    $this->configDissolver->dissolve($config['endpointGroups'][$endpointGroupKey]['endpoints']);
            }
        }

        return $config;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param $fileName
     */
    private function createCacheFile(string $fileName): void
    {
        $this->filesystem->dumpFile(
            $fileName,
            sprintf(
                '<?php %sreturn %s;',
                PHP_EOL,
                var_export($this->config, true)
            )
        );
    }

    /**
     * @param array $config
     * @param ConfigDissolver $configDissolver
     */
    private function generateConfig(array $config, ConfigDissolver $configDissolver): void
    {
        $this->configDissolver = $configDissolver;
        $this->config          = $this->dissolveConfig($config);
    }

    /**
     * @param $fileName
     */
    private function loadCachedConfig(string $fileName): void
    {
        $this->config = include $fileName;
    }

    /**
     * @param array $config
     * @return string
     */
    private function buildFileName(array $config): string
    {
        $filePath = $config['settings']['cache']['filePath'] ?? '.';
        return $filePath . '/config.cache.php';
    }

    /**
     * @param array $config
     * @return bool
     */
    private function isCacheEnabled(array $config): bool
    {
        return $config['settings']['cache']['enabled'] ?? false;
    }
}