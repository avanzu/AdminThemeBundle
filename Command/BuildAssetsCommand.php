<?php
/**
 * BuildAssetsCommand.php
 * avanzu-admin
 * Date: 21.03.15
 */

namespace Avanzu\AdminThemeBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

class BuildAssetsCommand extends ContainerAwareCommand
{

    /**
     * @var Kernel
     */
    protected $kernel;

    /**
     * @var string
     */
    protected $resdir;
    /**
     * @var string
     */
    protected $pubdir;
    /**
     * @var
     */
    protected $webdir;

    protected $builddir;


    protected function configure()
    {
        $this->setName('avanzu:admin:build-assets')
             ->setDescription('Concatenate and Uglify asset groups to static files')
             ->addOption('compress', 'c', InputOption::VALUE_NONE, 'compress javascripts')
             ->addOption('mangle', 'm', InputOption::VALUE_NONE, 'mangle javascripts')
             ->addOption('uglifyjs-bin',false, InputOption::VALUE_OPTIONAL, 'uglifyjs binary', '/usr/bin/env uglifyjs')
             ->addOption('uglifycss-bin', false, InputOption::VALUE_OPTIONAL, 'uglifycss binary', '/usr/bin/env uglifycss')
        ;

        $this->resdir   = realpath(dirname(__FILE__).'/../Resources');
        $this->pubdir   = $this->resdir.'/public';
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var $kernel Kernel */
        $this->kernel = $kernel = $this->getContainer()->get('kernel');
        $this->webdir = $webdir = realpath($this->getContainer()->getParameter('kernel.root_dir').'/../web');
        $this->builddir = $this->pubdir . '/static/' . $input->getOption('env');
        $assets         = $this->partition($this->resolveAll(include($this->resdir.'/config/assets.php')));
        $fs             = new Filesystem();


        foreach($assets['scripts'] as $group => $files) {
            $this->processScript($group, $files, $fs, $input, $output);
        }

        foreach($assets['styles'] as $group => $files) {
            $this->processStyle($group, $files, $fs, $input, $output);
        }

        $fontsdir = $this->builddir . "/fonts";
        $fs->exists($fontsdir) or $fs->mkdir($fontsdir);

        foreach($this->findFonts() as $name => $path) {
            $fs->copy($path, "$fontsdir/$name");
        }

    }


    protected function findFonts()
    {
        $finder = new Finder();
        $finder->files()->in("$this->pubdir")->path('/fonts');
        $fonts  = array();
        /** @var SplFileInfo $file */
        foreach($finder as $file) {
            if(isset($fonts[$file->getFilename()])) continue;
            $fonts[$file->getFilename()] = $file->getRealPath();
        }

        return $fonts;
    }

    /**
     * @param $name
     * @param $files
     * @param Filesystem $fs
     * @param InputInterface $in
     * @param OutputInterface $out
     */
    protected function processScript($name, $files, $fs, $in, $out)
    {

        $dir       = $this->builddir . '/scripts/';
        $file      = $dir . $this->group2file($name, '.js');

        $fs->exists($dir) or $fs->mkdir($dir);

        $command = array($in->getOption('uglifyjs-bin'));
        if($in->getOption('compress'))
            $command[] = "-c 'dead_code,drop_debugger,drop_console,keep_fargs,unused=false,properties=false'";
        if($in->getOption('mangle'))
            $command[] = '-m';

        $command[] = "-o $file";
        $command[] = implode(' ', $files);


        $proc = new Process(implode(' ', $command));

        $out->writeln($proc->getCommandLine());
        $proc->run(function ($type, $buffer) use ($in, $out) {
            if (Process::ERR === $type) {
                $out->write("<comment>$buffer</comment>");
            } else {
                $out->writeln($buffer);
            }
        });
    }


    protected function processStyle($name, $files, $fs, $in, $out)
    {
        $dir       = $this->builddir . '/styles/';
        $file      = $dir . $this->group2file($name, '.css');

        $fs->exists($dir) or $fs->mkdir($dir);

        $command = array($in->getOption('uglifycss-bin'));
        $command[] = implode(' ', $files);
        $command[] = "> $file";

        $proc = new Process(implode(' ', $command));

        // $proc = new Process("/usr/bin/env uglifycss " . implode(' ', $files) . " > $file");
        $proc->run(function ($type, $buffer) use ($in, $out) {
            if (Process::ERR === $type) {
                $out->writeln("<error>$buffer</error>");
            } else {
                $out->writeln($buffer);
            }
        });
    }

    protected function group2file($name, $extension)
    {
        return str_replace('_', '-', preg_replace('!(_js|_css)$!', '', $name)) . $extension;

    }

    protected function endsWith($extension, $file)
    {
        return (strrpos($file, $extension) === (strlen($file) - strlen($extension)));
    }

    protected function isImage($file)
    {
        return (strpos(mime_content_type($file), 'image/') === 0);
    }


    protected function resolveAll($assets)
    {
        $resolved     = array();


        foreach ($assets as $name => $inputs) {

            if (!isset($resolved[$name])) {
                $resolved[$name] = array();
            }

            foreach ($inputs['inputs'] as $input) {
                $resolved[$name] = array_unique(array_merge($resolved[$name], $this->resolve($assets, $input)));
            }
        }

        return $resolved;
    }

    protected function partition($resolved)
    {
        $grouped = array(
            'scripts' => array(),
            'styles'  => array(),
            'images'  => array(),
            'files'   => array(),
            'fonts'   => array()
        );

        foreach ($resolved as $group => $files) {
            foreach ($files as $file) {
                switch (true) {
                    case $this->endsWith('.js', $file):
                        $grouped['scripts'][$group][] = $file;
                        break;
                    case $this->endsWith('.css', $file):
                        $grouped['styles'][$group][] = $file;
                        break;
                    case $this->isImage($file):
                        $grouped['images'][$group][] = $file;
                        break;
                    default:
                        $grouped['files'][$group][] = $file;
                        break;
                }
            }
        }

        return $grouped;
    }

    protected function resolve($groups, $input)
    {
        $resolved = array();
        if(strpos($input, '@') === false) {
            return array($this->webdir.'/'.$input);
        }

        $cleaned = str_replace('@', '', $input);
        if(isset($groups[$cleaned])) {
            foreach($groups[$cleaned]['inputs'] as $candidate) {
                $resolved = array_merge($resolved, $this->resolve($groups, $candidate));
            }
            return $resolved;
        }

        if(($star = strpos($input, '*')) === false) {
            return array($this->kernel->locateResource($input));
        } else {
            $dir = $this->kernel->locateResource(substr($input, 0, $star));
            $it = new \DirectoryIterator($dir);
            foreach($it as $file) {
                if($file->isFile()) {
                    array_push($resolved, $it->getRealPath());
                }
            }

        }

        return $resolved;

    }



}