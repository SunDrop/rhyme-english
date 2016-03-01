<?php

namespace Rhyme\WebBundle\DependencyInjection;

use Symfony\Component\DomCrawler\Crawler;

class RhymeParser
{
    const RHYME_URL = 'http://www.rhymezone.com/r/rhyme.cgi' .
    '?typeofrhyme=perfect&org1=syl&org2=l&org3=y&Word=%word%';

    private $word;

    public function __construct($word = "")
    {
        $this->word = $word;
    }

    public function getHtmlBody()
    {
        return file_get_contents($this->getRhymeUrl());
    }

    public function getWord()
    {
        return $this->word;
    }

    public function setWord($word)
    {
        $this->word = $word;
        return $this;
    }

    public function getRhymes()
    {
        $crawler = new Crawler($this->getHtmlBody());
        $filter = $crawler->filter('a.r');
        $result = [];
        foreach ($filter as $node) {
            $result[] = $node->nodeValue;
        }
        return $result;
    }

    public function getRhymeUrl()
    {
        return str_replace('%word%', $this->word, self::RHYME_URL);
    }
}