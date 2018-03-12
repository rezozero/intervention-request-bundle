<?php
/**
 * Copyright (c) 2017. Rezo Zero
 *
 * Théâtre de la ville de Paris
 *
 * @file CacheCommand.php
 * @author Ambroise Maupate <ambroise@rezo-zero.com>
 */
namespace RZ\InterventionRequestBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Command line utils for managing Cache from terminal.
 */
class CacheCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('cache:clear-images')
            ->setDescription('Clear intervention-request image cache.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Kernel $kernel */
        $kernel = $this->getContainer()->get('kernel');
        $output->writeln('Clearing cache for <info>' . $kernel->getEnvironment() . '</info> environment. ');

        $fs = new Filesystem();
        $finder = new Finder();
        $cachePath = realpath($kernel->getProjectDir() . '/web' . $this->getContainer()->getParameter('rz_intervention_request.cache_path'));

        if ($fs->exists($cachePath)) {
            $finder->in($cachePath);
            $fs->remove($finder);
            $output->writeln('Assets cache has been purged.');

            return true;
        }

        return false;
    }
}
