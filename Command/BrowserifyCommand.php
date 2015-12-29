<?php
/**
 * BrowserifyCommand.php
 * avanzu-admin-2
 * Date: 29.12.15
 */

namespace Avanzu\AdminThemeBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Yaml\Parser;

class BrowserifyCommand extends ContainerAwareCommand
{
    protected $kernel;
    protected $root;

    protected function configure()
    {
        $this->setName('avanzu:admin:browserify');
    }

    public function run(InputInterface $input, OutputInterface $output)
    {
        $this->kernel  = $kernel = $this->getContainer()->get('kernel'); /** @var $kernel Kernel */
        $this->root    = $root   = realpath($this->getContainer()->getParameter('kernel.root_dir') . '/..');
        $bundles       = array_keys($kernel->getBundles());
        $fs            = $this->getContainer()->get('filesystem');
        $modules       = [];

        foreach($bundles as $bundle) {
            try {
                $resource = $kernel->locateResource(sprintf('@%s/Resources/config/browserify.yml', $bundle));
            } catch (\Exception $e) {
                continue;
            }

            $parser     = new Parser();
            $browserify = $parser->parse(file_get_contents($resource));
            $symlink    = $browserify['basename'];
            $basePath   = current($symlink);
            $baseName   = key($symlink);
            $realPath   = $this->createBaseName($baseName,  $fs);

            foreach($browserify['packages'] as $packageName => $packagePath) {
                $this->symlinkBasename($realPath, $basePath, $packagePath, $packageName, $fs);
            }

            foreach($browserify['modules'] as $target => $source) {
                $modules[$target] = $source;
            }
        }

        file_put_contents(
            $this->getContainer()->getParameter('kernel.root_dir').'/config/browserify.json',
            str_replace('\\', '', json_encode($modules, JSON_PRETTY_PRINT))
        );
    }

    /**
     * @param            $name
     * @param Filesystem $fs
     *
     * @return string
     */
    protected function createBaseName($name, $fs)
    {
        $path = sprintf("%s/node_modules/%s", $this->root, $name);
        $fs->mkdir($path);
        return $path;
    }

    /**
     * @param $nodeBase
     * @param $sourceBase
     * @param $packagePath
     * @param $packageName
     * @param Filesystem $fs
     */
    protected function symlinkBasename($nodeBase, $sourceBase, $packagePath, $packageName, $fs)
    {
        $target = sprintf('%s/%s', $nodeBase, $packageName);
        $source = sprintf('%s/%s/%s', $this->root, $sourceBase, $packagePath);
        $fs->symlink($source, $target);
    }

}