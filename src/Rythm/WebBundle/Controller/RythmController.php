<?php

namespace Rythm\WebBundle\Controller;

use Rythm\WebBundle\DependencyInjection\RythmParser;
use Symfony\Component\HttpFoundation\Response;

class RythmController
{
    public function indexAction()
    {
        $parser = new RythmParser("best");
        $rythm = $parser->getRythms();
        var_dump($rythm);
        return new Response("123");
    }
}