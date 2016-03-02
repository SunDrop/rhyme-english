<?php

namespace Rhyme\WebBundle\Controller;

use Rhyme\WebBundle\DependencyInjection\Rhymer;
use Symfony\Component\HttpFoundation\Response;

class RhymeController
{
    public function indexAction()
    {
        $rhymes = Rhymer::getRhymes('nation');
        var_dump($rhymes);
        return new Response('123');
    }
}