<?php

namespace Rhyme\WebBundle\DependencyInjection;

class Rhymer
{
    public static function getRhymes($word)
    {
        $parser = new RhymeParser($word);
        $rhyme = $parser->getRhymes();
        $lingualeo = new TranslateLingualeo();
        $translations = [];
        foreach ($rhyme as $word) {
            $translations[] = $lingualeo->setWord($word)->getTranslation();
        }
        return array_filter($translations);
    }
}