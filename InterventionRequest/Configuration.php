<?php
/**
 * Copyright (c) 2017. Rezo Zero
 *
 * Théâtre de la ville de Paris
 *
 * @file Configuration.php
 * @author Ambroise Maupate <ambroise@rezo-zero.com>
 */

namespace RZ\InterventionRequestBundle\InterventionRequest;

use AM\InterventionRequest\Configuration as BaseConfiguration;
use Symfony\Component\HttpKernel\Kernel;

class Configuration extends BaseConfiguration
{
    /**
     * Configuration constructor.
     *
     * @param Kernel $kernel
     * @param string $filesPath
     * @param string $imageDriver
     * @param int $defaultQuality
     * @param null $pngquantPath
     * @param null $jpegoptimPath
     * @param string $cachePath
     * @param bool $usePassThroughCache
     */
    public function __construct(
        Kernel $kernel,
        $filesPath,
        $imageDriver = 'gd',
        $defaultQuality = 90,
        $pngquantPath = null,
        $jpegoptimPath = null,
        $cachePath = '/assets',
        $usePassThroughCache = true
    ) {
        $this->setCachePath(realpath($kernel->getProjectDir() . '/web' . $cachePath));
        $this->setImagesPath($filesPath);

        $this->setDriver($imageDriver);
        $this->setDefaultQuality($defaultQuality);
        $this->setPngquantPath($pngquantPath);
        $this->setJpegoptimPath($jpegoptimPath);
        $this->setUsePassThroughCache($usePassThroughCache);
    }
}
