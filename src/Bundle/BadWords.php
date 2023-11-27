<?php

namespace App\Bundle;

class BadWords
{
    private $badWords;

    public function __construct(array $badWords)
    {
        $this->badWords = $badWords;
    }

    public function containsBadWords(string $content): bool
    {
        $content = strtolower($content); // Convertir le contenu en minuscules pour une correspondance insensible à la casse
        foreach ($this->badWords as $badWord) {
            if (strpos($content, $badWord) !== false) {
                return true;
            }
        }

        return false;
    }
    
    public function getBadWords(): array
    {
        return $this->badWords;
    }
}