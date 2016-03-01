<?php

namespace Rhyme\WebBundle\Controller;

use Rhyme\WebBundle\DependencyInjection\RhymeParser;
use Symfony\Component\HttpFoundation\Response;

class RhymeController
{
    public function indexAction()
    {
        $parser = new RhymeParser("best");
        $rhyme = $parser->getRhymes();
        var_dump($rhyme);
        return new Response("123");
    }
}