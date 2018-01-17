<?php
namespace Ob_Ivan\NethackNames;

class UnutterableNameGenerator implements NameGeneratorInterface {
    const CONSONANTS = 'bcdfghjkllmmnnpqrssttvwxyz';
    const VOWELS = 'aaeeiioouuy';

    public function generate(): string {
        $length = 1 + rand(0, 1) + rand(0, 1) + rand(0, 1);
        $syllables = [];
        for ($i = 0; $i < $length; ++$i) {
            $syllables[] = $this->generateSyllable();
        }
        return implode('', $syllables);
    }

    private function generateSyllable(): string {
        $letters = [];
        if (!rand(0, 1)) $letters[] = $this->generateConsonant();
        if (!rand(0, 2)) $letters[] = $this->generateConsonant();
        $letters[] = $this->generateVowel();
        if (!rand(0, 2)) $letters[] = $this->generateConsonant();
        if (!rand(0, 2)) $letters[] = $this->generateConsonant();
        return implode('', $letters);
    }

    private function generateConsonant(): string {
        return $this->getRandomChar(self::CONSONANTS);
    }

    private function generateVowel(): string {
        return $this->getRandomChar(self::VOWELS);
    }

    private function getRandomChar(string $chars): string {
        return $chars[rand(0, strlen($chars) - 1)];
    }
}
