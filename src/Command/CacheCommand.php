<?php

declare(strict_types=1);

namespace RZ\InterventionRequestBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

/**
 * Command line utils for managing Cache from terminal.
 */
class CacheCommand extends Command
{
    public function __construct(protected readonly string $cachePath, ?string $name = null)
    {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setName('cache:clear-images')
            ->setDescription('Clear intervention-request image cache.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $fs = new Filesystem();
        $finder = new Finder();
        $cachePath = realpath($this->cachePath);

        if ($io->confirm(sprintf('Are you to clear images cache in %s?', $cachePath), false)) {
            if ($cachePath && $fs->exists($cachePath)) {
                $finder->in($cachePath);
                $fs->remove($finder);
                $io->success('Assets cache has been purged.');

                return 0;
            }
            $io->error($cachePath.' folder does not exist.');

            return 1;
        }

        return 0;
    }
}
