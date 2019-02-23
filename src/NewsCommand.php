<?php namespace Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Console\Command;

/**
 * Author: Chidume Nnamdi <kurtwanger40@gmail.com>
 */
class NewsCommand extends Command
{
    
    public function configure()
    {
        $this -> setName('news')
            -> setDescription('Read the news in your terminal :)')
            -> setHelp('This command allows you to retrieve news from a number of sources.')
            -> addArgument('source', InputArgument::REQUIRED, 'The name of a news source.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this -> readNews($input, $output);
    }
}
