<?php
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
    /**
     * @var string
     */
    protected $cachePath;

    /**
     * CacheCommand constructor.
     *
     * @param string      $cachePath
     * @param string|null $name
     */
    public function __construct(string $cachePath, string $name = null)
    {
        parent::__construct($name);
        $this->cachePath = $cachePath;
    }

    protected function configure()
    {
        $this->setName('cache:clear-images')
            ->setDescription('Clear intervention-request image cache.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $fs = new Filesystem();
        $finder = new Finder();
        $cachePath = realpath($this->cachePath);

        if ($fs->exists($cachePath)) {
            $finder->in($cachePath);
            $fs->remove($finder);
            $io->success('Assets cache has been purged.');
            return 0;
        }
        $io->error($cachePath . ' folder does not exist.');
        return 1;
    }
}
