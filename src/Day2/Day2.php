<?php

declare(strict_types=1);

namespace App\Day2;

use App\AdventOfCodeProblem;
use App\Utils\DataReader;

final readonly class Day2 implements AdventOfCodeProblem
{
    public function __construct(
        private bool $withExampleData = false,
    ) {}

    public function firstPart(): int
    {
        $solution = 0;
        $lineGenerator = DataReader::readLine(2, $this->withExampleData);
        foreach ($lineGenerator as $line) {
            $values = array_map(static fn (string $val): int => (int) $val, explode(' ', $line));

            if ($this->areLevelsValid($values)) {
                $solution++;
            }
        }

        return $solution;
    }

    public function secondPart(): int
    {
        $solution = 0;
        $lineGenerator = DataReader::readLine(2, $this->withExampleData);
        foreach ($lineGenerator as $line) {
            $values = array_map(static fn(string $val): int => (int) $val, explode(' ', $line));

            if ($this->areLevelsValid($values)) {
                $solution++;
                continue;
            }

            $totalValues = count($values);
            for ($j = 0; $j < $totalValues; $j++) {
                $copy = $values;
                unset($copy[$j]);

                if ($this->areLevelsValid(array_values($copy))) {
                    $solution++;
                    break;
                }
            }
        }

        return $solution;
    }

    private function areLevelsValid(array $values): bool
    {
        $totalValues = count($values);
        $isIncreasing = true;
        $isDecreasing = true;
        $diffIsOk = true;
        for ($i = 1; $i < $totalValues; $i++) {
            $diff = $values[$i] - $values[$i - 1];

            if (abs($diff) < 1 || abs($diff) > 3) {
                $diffIsOk = false;
            }

            if ($diff > 0) {
                $isDecreasing = false;
            } elseif ($diff < 0) {
                $isIncreasing = false;
            }
        }

        return $diffIsOk && ($isIncreasing || $isDecreasing);
    }
}
