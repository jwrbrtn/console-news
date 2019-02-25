<?php namespace Console;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Goutte\Client;


/**
 * Author: Chidume Nnamdi <kurtwanger40@gmail.com>
 */
class Command extends SymfonyCommand
{
    
    public function __construct()
    {
        parent::__construct();
    }
    protected function greetUser(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output -> writeln([
            '====**** User Greetings Console App ****====',
            '==========================================',
            '',
        ]);
        
        // outputs a message without adding a "\n" at the end of the line
        $output -> write($this -> getGreeting() .', '. $input -> getArgument('username'));
    }
    private function getGreeting()
    {
        /* This sets the $time variable to the current hour in the 24 hour clock format */
        $time = date("H");
        /* Set the $timezone variable to become the current timezone */
        $timezone = date("e");
        /* If the time is less than 1200 hours, show good morning */
        if ($time < "12") {
            return "Good morning";
        } else
        /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
        if ($time >= "12" && $time < "17") {
            return "Good afternoon";
        } else
        /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
        if ($time >= "17" && $time < "19") {
            return "Good evening";
        } else
        /* Finally, show good night if the time is greater than or equal to 1900 hours */
        if ($time >= "19") {
            return "Good night";
        }        
    }


    protected function readNews(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output -> writeln([
            '====**** News Reader Console App ****====',
            '',
        ]);

        
        // outputs a message without adding a "\n" at the end of the line
        
        $source = $input -> getArgument('source'); 


        

        // outputs a message without adding a "\n" at the end of the line
        //$output -> write($this -> getNews($source));

        $client = new Client();

        switch ($source) {
            case 'hn':
            print "Latest from Hacker News" . "\n";
            print "\n";
            $crawler = $client->request('GET', 'https://news.ycombinator.com/');
            // Get the latest post in this category and display the titles
            $crawler->filter('a.storylink')->each(function ($node) {
                $text = $node->text();
                $url = $node->attr('href');
                print $text . "\n";
                print $url . "\n";
                print "\n";
            });
                break;

                case 'abc':
                print "Latest from Australian Broadcating Company" . "\n";
                print "\n";
                $crawler = $client->request('GET', 'https://www.abc.net.au/news/feed/51120/rss.xml');
                // Get the latest post in this category and display the titles
                $crawler->filter('item')->each(function ($node) {
                    $text = $node->text();
                    $url = $node->attr('href');
                    print $text . "\n";
                    print $url . "\n";
                    print "\n";
                });
                    break;
            
            default:
                # code...
                break;
        }



    }






}
