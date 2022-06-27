<?php

declare(strict_types=1);

namespace RZ\InterventionRequestBundle\InterventionRequest;

use AM\InterventionRequest\Configuration as BaseConfiguration;
use RuntimeException;

class Configuration extends BaseConfiguration
{
    /**
     * @param string          $filesPath
     * @param string          $imageDriver
     * @param int             $defaultQuality
     * @param string|null     $pngquantPath
     * @param string|null     $jpegoptimPath
     * @param string          $cachePath
     * @param bool            $usePassThroughCache
     */
    public function __construct(
        string $filesPath,
        string $imageDriver = 'gd',
        int $defaultQuality = 90,
        ?string $pngquantPath = null,
        ?string $jpegoptimPath = null,
        string $cachePath = '/assets',
        bool $usePassThroughCache = true
    ) {
        $realCachePath = realpath($cachePath);
        if (false === $realCachePath) {
            throw new RuntimeException($cachePath . ' is not readable');
        }
        $this->setCachePath($realCachePath);
        $this->setImagesPath($filesPath);
        $this->setDriver($imageDriver);
        $this->setDefaultQuality($defaultQuality);
        $this->setPngquantPath($pngquantPath);
        $this->setJpegoptimPath($jpegoptimPath);
        $this->setUsePassThroughCache($usePassThroughCache);
    }
}
