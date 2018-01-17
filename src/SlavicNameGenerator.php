<?php
namespace Ob_Ivan\NethackNames;

class SlavicNameGenerator implements GenderAwareInterface, NameGeneratorInterface {
    private $gender;

    public function setGender(string $gender) {
        $this->gender = $gender;
    }

    public function generate(): string {
        $method = $this->select([
            'generateDoubleRoot' => 1,
            'generateSingleRoot' => 1,
            'generateDiminutive' => 1,
        ]);
        return $this->$method();
    }

    public function select(array $keyWeightMap) {
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
}
