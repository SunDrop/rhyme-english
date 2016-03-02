<?php

namespace Rhyme\WebBundle\DependencyInjection;

class TranslateLingualeo
{
    const API_LOGIN = 'http://api.lingualeo.com/api/login';
    const API_TRANSLATE = 'http://api.lingualeo.com/gettranslates?word=';
    const API_ADD_WORD = 'http://api.lingualeo.com/addword';

    private $word;

    public function getWord()
    {
        return $this->word;
    }

    public function setWord($word)
    {
        $this->word = $word;
        return $this;
    }

    public function getTranslation()
    {
        if (!$this->word) {
            return;
        }

        $translateUrl = self::API_TRANSLATE . urlencode($this->word);
        $content = json_decode(file_get_contents($translateUrl), true);
        $translation = [];
        $translation['word'] = $this->word;
        $translation['transcription'] = $content['transcription'] ?: '';
        $translation['type'] = $this->getWordType($content);
        $translation['translation'] = $this->getWordTranslation($content);
        $translation['sound_url'] = $content['sound_url'] ?: '';

        return $translation;
    }

    private function getWordType($content)
    {
        if (!isset($content['word_forms'], $content['word_forms'][0], $content['word_forms'][0]['type'])) {
            return '';
        }
        return $content['word_forms'][0]['type'] ?: '';
    }

    private function getWordTranslation($content)
    {
        if (!isset($content['translate'], $content['translate'][0], $content['translate'][0]['value'])) {
            return '';
        }
        return $content['translate'][0]['value'] ?: '';
    }

}