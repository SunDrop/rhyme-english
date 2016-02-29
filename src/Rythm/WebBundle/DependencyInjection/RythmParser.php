<?php

namespace Rythm\WebBundle\DependencyInjection;

use Symfony\Component\DomCrawler\Crawler;

class RythmParser
{
    const RYTHM_URL = 'http://www.rhymezone.com/r/rhyme.cgi' .
    '?typeofrhyme=perfect&org1=syl&org2=l&org3=y&Word=%word%';

    private $word;

    /**
     * RythmParser constructor.
     * @param $word
     */
    public function __construct($word = "")
    {
        $this->word = $word;
    }

    public function getHtmlBody()
    {
        return file_get_contents($this->getRythmUrl());
    }

    /**
     * @return mixed
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * @param mixed $word
     * @return self
     */
    public function setWord($word)
    {
        $this->word = $word;
        return $this;
    }

    public function getRythms()
    {
        $crawler = new Crawler($this->getHtmlBody());
        $filter = $crawler->filter('a.r');
        $result = [];
        foreach ($filter as $node) {
            $result[] = $node->nodeValue;
        }
        return $result;
    }

    /**
     * @return string
     */
    public function getRythmUrl()
    {
        return str_replace('%word%', $this->word, self::RYTHM_URL);
    }
}