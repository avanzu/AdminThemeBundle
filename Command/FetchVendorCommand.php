<?php
/**
 * @class FetchVendorCommand
 *
 */
namespace Avanzu\AdminThemeBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\FormatterHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Process\Process;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FetchVendorCommand extends Command
{

    private $container;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct();
        $this->container = $container;
    }

    protected function configure()
    {
        $this->setName('avanzu:admin:fetch-vendor')
            ->setDescription('Fetch vendor assets')
            ->addOption('update', 'u', InputOption::VALUE_NONE, 'perform update instead of install')
            ->addOption('root', 'r', InputOption::VALUE_NONE, 'allow bower to run as root');
        // ->addArgument('name', InputArgument::OPTIONAL, 'Who do you want to greet?')
        // ->addOption('yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters')

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $kernel = $this->container->get('kernel');
        /** @var $kernel Kernel */
        $bowerResource = $kernel->locateResource('@AvanzuAdminThemeBundle/Resources/bower');
        $helper = $this->getHelperSet()->get('formatter');
        /** @var $helper FormatterHelper */
        $bower = $this->container->getParameter('avanzu_admin_theme.bower_bin');

        $action = $input->getOption('update') ? 'update' : 'install';
        $asRoot = $input->getOption('root') ? '--allow-root' : '';
        $process = new Process($bower . ' ' . $action . ' ' . $asRoot);
        $process->setTimeout(600);

        $output->writeln($helper->formatSection('Executing', $process->getCommandLine(), 'comment'));
        $process->setWorkingDirectory($bowerResource);
        $process->run(function ($type, $buffer) use ($output, $helper)
        {
            if(Process::ERR == $type)
            {
                $output->write($helper->formatSection('Error', $buffer, 'error'));
            }
            else
            {
                $output->write($helper->formatSection('Progress', $buffer, 'info'));
            }
        });

        $output->writeln($helper->formatSection('Done. You should now execute', 'php bin/console assets:install', 'comment'));
    }
}
