<?php
/**
 * InitializeCommand.php
 * symfony3
 * Date: 12.06.16
 */

namespace Avanzu\AdminThemeBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

/**
 * Class InitializeCommand
 *
 */
class InitializeCommand extends ContainerAwareCommand
{
    const METHOD_COPY = 'copy';
    const METHOD_ABSOLUTE_SYMLINK = 'absolute symlink';
    const METHOD_RELATIVE_SYMLINK = 'relative symlink';

    /**
     * @var Filesystem
     */
    private $filesystem;

    protected function configure()
    {
        $this->setName('avanzu:admin:initialize')
            ->addOption('vendor-dir', null, InputOption::VALUE_OPTIONAL, 'path to vendors', 'vendor')
            ->addOption('theme-dir', null, InputOption::VALUE_OPTIONAL, 'path to adminlte', 'almasaeed2010/adminlte')
            ->addOption('web-dir', null, InputOption::VALUE_OPTIONAL, 'path to web', 'web')
            ->addOption('symlink', null, InputOption::VALUE_NONE, 'Symlinks the assets instead of copying it')
            ->addOption('relative', null, InputOption::VALUE_NONE, 'Make relative symlinks')
        ;
    }

    /**
     * @param                $appDir
     * @param InputInterface $input
     *
     * @return string
     */
    protected function getVendorDir(InputInterface $input)
    {
         return $input->getOption('vendor-dir');
    }

    /**
     * @param                $appDir
     * @param InputInterface $input
     *
     * @return string
     */
    protected function getThemeDir(InputInterface $input)
    {
        return sprintf('%s/%s', $this->getVendorDir($input), $input->getOption('theme-dir'));
    }

    /**
     * @param ContainerInterface $dic
     * @param InputInterface     $input
     *
     * @return object
     */
    protected function getDirectorySetup(ContainerInterface $dic, InputInterface $input)
    {
        $appDir = $dic->getParameter('kernel.root_dir');
        $projectDir = dirname($appDir);
        $vendors = $this->getVendorDir($input);
        $theme = $this->getThemeDir($input);
        $self = dirname(__DIR__);

        return (object) [
            'app' => $appDir,
            'project' => $projectDir,
            'vendors' => $vendors,
            'theme' => $theme,
            'self' => $self,
            'public' => $input->getOption('web-dir'),
        ];
    }

    /**
     * @param $originDir
     * @param $targetDir
     * @param $expectedMethod
     *
     * @return string
     */
    protected function establishLink($originDir, $targetDir, $expectedMethod)
    {
        $this->filesystem->remove($targetDir);

        if (self::METHOD_RELATIVE_SYMLINK === $expectedMethod) {
            $method = $this->relativeSymlinkWithFallback($originDir, $targetDir);
        } elseif (self::METHOD_ABSOLUTE_SYMLINK === $expectedMethod) {
            $method = $this->absoluteSymlinkWithFallback($originDir, $targetDir);
        } else {
            $method = $this->hardCopy($originDir, $targetDir);
        }

        return $method;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dic = $this->getContainer();
        $fs = $dic->get('filesystem');
        $folders = $this->getDirectorySetup($dic, $input);
        $io = new SymfonyStyle($input, $output);
        $this->filesystem = $fs;

        if ($input->getOption('relative')) {
            $expectedMethod = self::METHOD_RELATIVE_SYMLINK;
            $io->text('Trying to install theme assets as <info>relative symbolic links</info>.');
        } elseif ($input->getOption('symlink')) {
            $expectedMethod = self::METHOD_ABSOLUTE_SYMLINK;
            $io->text('Trying to install theme assets as <info>absolute symbolic links</info>.');
        } else {
            $expectedMethod = self::METHOD_COPY;
            $io->text('Installing theme assets as <info>hard copies</info>.');
        }

        $fs->mkdir($folders->public . '/theme');

        foreach (['bootstrap', 'dist', 'plugins', 'documentation', 'starter.html'] as $directory) {
            $io->text("installing <info>$directory</info>");

            $lnFrom = sprintf('%s/%s', $folders->theme, $directory);
            $lnTo = sprintf('%s/theme/%s', $folders->public, $directory);

            $this->establishLink($lnFrom, $lnTo, $expectedMethod);
        }
    }

    /**
     * Try to create relative symlink.
     *
     * Falling back to absolute symlink and finally hard copy.
     *
     * @param string $originDir
     * @param string $targetDir
     *
     * @return string
     */
    private function relativeSymlinkWithFallback($originDir, $targetDir)
    {
        try {
            $this->symlink($originDir, $targetDir, true);
            $method = self::METHOD_RELATIVE_SYMLINK;
        } catch (IOException $e) {
            $method = $this->absoluteSymlinkWithFallback($originDir, $targetDir);
        }

        return $method;
    }

    /**
     * Try to create absolute symlink.
     *
     * Falling back to hard copy.
     *
     * @param string $originDir
     * @param string $targetDir
     *
     * @return string
     */
    private function absoluteSymlinkWithFallback($originDir, $targetDir)
    {
        try {
            $this->symlink($originDir, $targetDir);
            $method = self::METHOD_ABSOLUTE_SYMLINK;
        } catch (IOException $e) {
            // fall back to copy
            $method = $this->hardCopy($originDir, $targetDir);
        }

        return $method;
    }

    /**
     * Creates symbolic link.
     *
     * @param string $originDir
     * @param string $targetDir
     * @param bool   $relative
     *
     * @throws IOException If link can not be created.
     */
    private function symlink($originDir, $targetDir, $relative = false)
    {
        if ($relative) {
            $originDir = rtrim($this->filesystem->makePathRelative($originDir, dirname($targetDir)), DIRECTORY_SEPARATOR);
        }
        $this->filesystem->symlink($originDir, $targetDir);
        if (!file_exists($targetDir)) {
            throw new IOException(sprintf('Symbolic link "%s" was created but appears to be broken.', $targetDir), 0, null, $targetDir);
        }
    }

    /**
     * Copies origin to target.
     *
     * @param string $originDir
     * @param string $targetDir
     *
     * @return string
     */
    private function hardCopy($originDir, $targetDir)
    {
        if(is_file($originDir)) {
            $this->filesystem->mkdir(dirname($targetDir), 0777);
            $this->filesystem->copy($originDir, $targetDir, false);

            return self::METHOD_COPY;
        }

        $this->filesystem->mkdir($targetDir, 0777);
        // We use a custom iterator to ignore VCS files
        $this->filesystem->mirror($originDir, $targetDir, Finder::create()->ignoreDotFiles(false)->in($originDir));

        return self::METHOD_COPY;
    }
}
