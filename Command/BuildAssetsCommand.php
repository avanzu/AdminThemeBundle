<?php
/**
 * BuildAssetsCommand.php
 * avanzu-admin
 * Date: 21.03.15
 */

namespace Avanzu\AdminThemeBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Process\Process;

class BuildAssetsCommand extends ContainerAwareCommand
{
    const DEFAULT_UGLIFY_JS_LINUX = '/usr/bin/env uglifyjs';
    const DEFAULT_UGLIFY_JS_WIN   = 'uglifyjs.exe';
    
    const DEFAULT_UGLIFY_CSS_LINUX = '/usr/bin/env uglifycss';
    const DEFAULT_UGLIFY_CSS_WIN   = 'uglifycss.exe';
    
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
        if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') 
        {
            $uglifyjs_default_option = self::DEFAULT_UGLIFY_JS_WIN;
        }
        else
        {
            $uglifyjs_default_option = self::DEFAULT_UGLIFY_JS_LINUX;
        }
        
        if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
        {
            $uglifycss_default_option = self::DEFAULT_UGLIFY_CSS_WIN;
        }
        else
        {
            $uglifycss_default_option = self::DEFAULT_UGLIFY_CSS_LINUX;
        }
        
        $this->setName('avanzu:admin:build-assets')
        ->setDescription('Concatenate and Uglify asset groups to static files')
        ->addOption('compress', 'c', InputOption::VALUE_NONE, 'compress javascripts')
        ->addOption('mangle', 'm', InputOption::VALUE_NONE, 'mangle javascripts')
        ->addOption('uglifyjs-bin', false, InputOption::VALUE_OPTIONAL, 'uglifyjs binary', $uglifyjs_default_option)
        ->addOption('uglifycss-bin', false, InputOption::VALUE_OPTIONAL, 'uglifycss binary', $uglifycss_default_option)
        ;

        $this->resdir = realpath(dirname(__FILE__) . '/../Resources');
        $this->pubdir = $this->resdir . '/public';
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var $kernel Kernel */
        $this->kernel = $this->getContainer()->get('kernel');
        $this->webdir = realpath($this->getContainer()->getParameter('kernel.root_dir') . '/../web');
        $this->builddir = $this->pubdir . '/static/' . $input->getOption('env');

        $assetsFiles = $this->resdir . '/config/assets.php';
        $output->writeln('Loading assets files config from ' . $assetsFiles);

        $assets = $this->partition($this->resolveAll(include($assetsFiles)));
        $fs = new Filesystem();

        $output->writeln('Processing scripts');
        foreach($assets['scripts'] as $group => $files)
        {
            $this->processScript($group, $files, $fs, $input, $output);
        }

        $output->writeln('Processing styles');
        foreach($assets['styles'] as $group => $files) {
            $this->processStyle($group, $files, $fs, $input, $output);
        }

        $output->writeln('Processing styles');
        foreach($assets['fonts'] as $group => $files) {
            $this->processFonts($group, $files, $fs, $input, $output);
        }

        $fontsdir = $this->builddir . '/fonts';
        $output->writeln('Searching for fonts under ' . $fontsdir);

        $fs->exists($fontsdir) or $fs->mkdir($fontsdir);

        $fontsFound = $this->findFonts();

        if(!empty($fontsFound))
        {
            foreach($fontsFound as $name => $path)
            {
                $output->writeln('Font found: ' . $name . ' in ' . $path);
                $fs->copy($path, "$fontsdir/$name");
            }
        }
        else
        {
            $output->writeln('No fonts found');
        }
    }

    protected function findFonts()
    {
        $finder = new Finder();
        $finder->files()->in("$this->pubdir")->path('/fonts');
        $fonts = [];
        /** @var SplFileInfo $file */
        foreach($finder as $file)
        {
            if(isset($fonts[$file->getFilename()])) continue;
            $fonts[$file->getFilename()] = $file->getRealPath();
        }

        return $fonts;
    }

    /**
     * @param $name
     * @param $files
     * @param Filesystem      $fs
     * @param InputInterface  $in
     * @param OutputInterface $out
     */
    protected function processScript($name, $files, $fs, $in, $out)
    {
        $dir = $this->builddir . '/scripts/';
        $file = $dir . $this->group2file($name, '.js');

        $fs->exists($dir) or $fs->mkdir($dir);

        $command = [$in->getOption('uglifyjs-bin')];
        if($in->getOption('compress'))
            $command[] = "-c 'dead_code,drop_debugger,drop_console,keep_fargs,unused=false,properties=false'";
            if($in->getOption('mangle'))
                $command[] = '-m';

                $command[] = "-o $file";
                $command[] = implode(' ', $files);

                $proc = new Process(implode(' ', $command));

                $out->writeln($proc->getCommandLine() . PHP_EOL);
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
        $dir = $this->builddir . '/styles/';
        $file = $dir . $this->group2file($name, '.css');

        $fs->exists($dir) or $fs->mkdir($dir);

        $command = [$in->getOption('uglifycss-bin')];
        $command[] = implode(' ', $files);
        $command[] = "> $file";

        $proc = new Process(implode(' ', $command));

        $out->writeln($proc->getCommandLine() . PHP_EOL);
        $proc->run(function ($type, $buffer) use ($in, $out) {
            if (Process::ERR === $type) {
                $out->writeln("<error>$buffer</error>");
            } else {
                $out->writeln($buffer);
            }
        });
    }

    /**
     *
     * @param unknown $name
     * @param unknown $files
     * @param unknown $fs
     * @param unknown $in
     * @param unknown $out
     */
    protected function processFonts($name, $files, $fs, $in, $out)
    {
        $dir = $this->builddir . '/fonts/';

        $fs->exists($dir) or $fs->mkdir($dir);

        if(!empty($files))
        {
            foreach($files as $file)
            {
                $fs->copy($file, $dir . basename($file));
            }
        }
    }

    protected function group2file($name, $extension)
    {
        return str_replace('_', '-', preg_replace('!(_js|_css)$!', '', $name)) . $extension;
    }

    protected function endsWith($extension, $file)
    {
        return strrpos($file, $extension) === (strlen($file) - strlen($extension));
    }

    protected function isImage($file)
    {
        return strpos(mime_content_type($file), 'image/') === 0;
    }

    protected function resolveAll($assets)
    {
        $resolved = [];

        foreach ($assets as $name => $inputs) {
            if (!isset($resolved[$name])) {
                $resolved[$name] = [];
            }

            foreach ($inputs['inputs'] as $input) {
                $resolved[$name] = array_unique(array_merge($resolved[$name], $this->resolve($assets, $input)));
            }
        }

        return $resolved;
    }

    /**
     *
     * @param array $resolved
     *
     * @return array[]|unknown
     */
    protected function partition($resolved)
    {
        echo 'Partitioning assets in groups ' . PHP_EOL;

        $grouped = [
            'scripts' => [],
            'styles' => [],
            'images' => [],
            'files' => [],
            'fonts' => [],
        ];

        foreach ($resolved as $group => $files) {
            echo 'Group: ' . $group . PHP_EOL;
            foreach ($files as $file)
            {
                echo '    File: ' . $file . PHP_EOL;
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

                        // Fonts
                    case $this->endsWith('.otf', $file):
                        $grouped['fonts'][$group][] = $file;
                        break;
                    case $this->endsWith('.eot', $file):
                        $grouped['fonts'][$group][] = $file;
                        break;
                    case $this->endsWith('.otf', $file):
                        $grouped['fonts'][$group][] = $file;
                        break;
                    case $this->endsWith('.svg', $file):
                        $grouped['fonts'][$group][] = $file;
                        break;
                    case $this->endsWith('.ttf', $file):
                        $grouped['fonts'][$group][] = $file;
                        break;
                    case $this->endsWith('.woff', $file):
                        $grouped['fonts'][$group][] = $file;
                        break;
                    case $this->endsWith('.woff2', $file):
                        $grouped['fonts'][$group][] = $file;
                        break;

                    default:
                        $grouped['files'][$group][] = $file;
                        break;
                }
            }

            echo PHP_EOL;
        }

        return $grouped;
    }

    protected function resolve($groups, $input)
    {
        $resolved = [];
        if(strpos($input, '@') === false) {
            return [$this->webdir . '/' . $input];
        }

        $cleaned = str_replace('@', '', $input);
        if(isset($groups[$cleaned])) {
            foreach($groups[$cleaned]['inputs'] as $candidate) {
                $resolved = array_merge($resolved, $this->resolve($groups, $candidate));
            }

            return $resolved;
        }

        if(($star = strpos($input, '*')) === false) {
            try
            {
                return [$this->kernel->locateResource($input)];
            }
            catch(InvalidArgumentException $e)
            {
                echo $e->getMessage() . PHP_EOL;
            }
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
