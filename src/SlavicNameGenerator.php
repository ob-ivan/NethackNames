<?php
namespace Ob_Ivan\NethackNames;

class SlavicNameGenerator implements GenderAwareInterface, NameGeneratorInterface {
    const ROOTS = [
        'bogu',
        'bole',
        'bori',
        'broni',
        'bryachi',
        'daro',
        'deye',
        'dobro',
        'dolgo',
        'gordi',
        'gore',
        'gradi',
        'hitro',
        'isti',
        'krasno',
        'lado',
        'mechi',
        'milo',
        'miro',
        'ostro',
        'pere',
        'polku',
        'rado',
        'rosti',
        'slavo',
        'stani',
        'sveto',
        'svyato',
        'tverdi',
        'vence',
        'verhu',
        'vladi',
        'vyache',
        'vyshe',
        'yaro',
        'zharo',
        'zhiro',
        'zveni',
        // mocking area
        'kami', 'kaze',
        'proto', 'popo',
    ];

    private $gender;

    public function setGender(string $gender) {
        $this->gender = $gender;
    }

    public function generate(): string {
        $method = $this->select([
            'generateDoubleRoot' => 8,
            'generateSingleRoot' => 2,
            'generateDiminutive' => 1,
        ]);
        return $this->$method();
    }

    private function select(array $keyWeightMap) {
        $totalSum = array_reduce(
            $keyWeightMap,
            function ($sum, $item) { return $sum + $item; },
            0
        );
        $value = rand(1, $totalSum);
        $runningSum = 0;
        foreach ($keyWeightMap as $key => $weight) {
            $runningSum += $weight;
            if ($runningSum >= $value) {
                return $key;
            }
        }
        // Unreachable code.
    }

    private function generateDoubleRoot(): string {
        return $this->getRandomRoot() . $this->generateSingleRoot();
    }

    private function generateSingleRoot(): string {
        $name = mb_substr($this->getRandomRoot(), 0, -1);
        if ($this->gender === GenderAwareInterface::GENDER_FEMALE) {
            $name .= 'a';
        }
        return $name;
    }

    private function generateDiminutive(): string {
        $root = mb_substr($this->getRandomRoot(), 0, -1);
        if ($this->gender === GenderAwareInterface::GENDER_MALE) {
            return $root . 'ik';
        }
        if ($this->gender === GenderAwareInterface::GENDER_FEMALE) {
            return $root . 'ka';
        }
    }

    private function getRandomRoot(): string {
        return self::ROOTS[array_rand(self::ROOTS)];
    }
}
