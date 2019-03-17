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
            '<fg=black;bg=cyan>====**** News Reader Console App ****====</>',
            '',
        ]);
        
        // outputs a message without adding a "\n" at the end of the line
        
        $source = $input -> getArgument('source'); 
    
        /*
            Hacker News
            The Age
            Australian Broadcasting Corporation
            The Conversation 
            Pink News
            New York Times
            CNN

        */


        switch ($source) {

            // Australian News 
            case 'abc':
            $feedurl = 'https://www.abc.net.au/news/feed/51120/rss.xml';
            $name = 'Australian Broadcasting Corporation';
            $this->fetchFeed($feedurl, $name);
            break;

            case 'theage':
            $feedurl = 'https://www.theage.com.au/rss/feed.xml';
            $name = 'The Age';
            $this->fetchFeed($feedurl, $name);
            break;

            case 'theguardian':
            $feedurl = 'https://www.theguardian.com/au/rss';
            $name = 'The Guardian';
            $this->fetchFeed($feedurl, $name);
            break;

            case 'theconversation':
            $feedurl = 'https://theconversation.com/au/articles.atom';
            $name = 'Ars Technica';
            $this->fetchFeed($feedurl, $name);
            break;


            case 'nyt':
            $feedurl = 'http://rss.nytimes.com/services/xml/rss/nyt/HomePage.xml';
            $name = 'The New York Times';
            $this->fetchFeed($feedurl, $name);
            break;
            
            // Technology News

            case 'arstechnica':
            $feedurl = 'http://feeds.arstechnica.com/arstechnica/index';
            $name = 'Ars Technica';
            $this->fetchFeed($feedurl, $name);
            break;
            
            case 'hn':
            $feedurl = 'https://news.ycombinator.com/rss';
            $name = 'Ars Technica';
            $this->fetchFeed($feedurl, $name);
            break;




            default:
                $output ->writeln("I don't know what you are talking about." . "\n");
                break;
        }



    }


protected function fetchFeed($feedurl, $name) {
    $client = new Client();
    $crawler = $client->request('GET', $feedurl);
    // Print the name of the news source
    print "Latest from " . $name . "\n";
    // Iterate over the returned nodes and print them
    $crawler->filter('item')->each(function ($node, $x = 0) {
        $title = $node->filter('title');
        $text = $title->text();
        $link = $node->filter('link');
        $url = $link->text();
        $x++;

        print $x . ': ' . $text . "\n";
        print $url . "\n";
        print "\n";
    });
}



}
