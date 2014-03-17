<?php
/**
 * FetchVendorCommand.php
 * avanzu-admin
 * Date: 15.02.14
 */

namespace Avanzu\AdminThemeBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\FormatterHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Shell\Command;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Process\Process;

class FetchVendorCommand extends ContainerAwareCommand {


    protected function configure()
    {
        $this
            ->setName('avanzu:admin:fetch-vendor')
            ->setDescription('fetch vendor assets')
            ->addOption('update', 'u', InputOption::VALUE_NONE, 'perform update instead of install')
            //->addArgument('name', InputArgument::OPTIONAL, 'Who do you want to greet?')
            //->addOption('yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $kernel = $this->getContainer()->get('kernel'); /** @var $kernel Kernel */
        $res  = $kernel->locateResource('@AvanzuAdminThemeBundle/Resources/bower');
        $helper = $this->getHelperSet()->get('formatter'); /** @var $helper FormatterHelper */

        $action = $input->hasOption('update') ? 'update' : 'install';

        $process = new Process('/usr/local/bin/bower '.$action);
        $output->writeln($helper->formatSection('Executing',$process->getCommandLine(), 'comment'));
        $process->setWorkingDirectory($res);
        $process->run(function($type, $buffer) use ($output, $helper){
            if(Process::ERR == $type) {
                $output->write($helper->formatSection('Error', $buffer, 'error' ));
            } else {
                $output->write($helper->formatSection('Progress', $buffer, 'info' ));
            }
        });



        $process = new Process('git clone https://github.com/almasaeed2010/AdminLTE.git');
        $process->setWorkingDirectory(dirname($res).'/public/vendor');
        if($input->hasOption('update')) {
            $process = new Process('git pull');
            $process->setWorkingDirectory(dirname($res).'/public/vendor/AdminLTE');
        }
        $output->writeln($helper->formatSection('Executing',$process->getCommandLine(), 'comment'));


        $process->run(function($type, $buffer) use ($output, $helper){
                if(Process::ERR == $type) {
                    $output->write($helper->formatSection('Error', $buffer, 'error' ));
                } else {
                    $output->write($helper->formatSection('Progress', $buffer, 'info' ));
                }
            });

    }

}