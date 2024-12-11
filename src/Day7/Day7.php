<?php

declare(strict_types=1);

namespace App\Day7;

use App\AdventOfCodeProblem;
use App\Utils\DataReader;

final readonly class Day7 implements AdventOfCodeProblem
{
    public function __construct(
        private bool $withExampleData = false,
    ) {}

    public function firstPart(): int
    {
        $solution = 0;
        $lineGenerator = DataReader::readLine(7, $this->withExampleData);

        foreach ($lineGenerator as $line) {
            $values = array_map(static fn(string $val): int => str_contains($val, ':') ? (int) substr($val, 0, -1) : (int) $val, explode(' ', $line));

            $result = $values[0];
            $numbers = array_slice($values, 1);

            $bits = count($numbers) - 1;
            $nbLoops = 2 ** $bits;
            for ($i = 0; $i < $nbLoops; $i++) {
                $newTotal = $numbers[0];

                $bitString = str_pad(base_convert((string) $i, 10, 2), $bits,'0',\STR_PAD_LEFT);
                for ($j = 0; $j < $bits; $j++) {
                    $operator = $bitString[$j];
                    if ($operator === '0') {
                        $newTotal += $numbers[$j + 1];
                    }
                    if ($operator === '1') {
                        $newTotal *= $numbers[$j + 1];
                    }
                    if ($operator === '2') {
                        $newTotal .= $numbers[$j + 1];
                    }
                }

                if ($newTotal === $result) {
                    $solution += $result;
                    continue 2;
                }
            }
        }

        return $solution;
    }

    public function secondPart(): int
    {
        $solution = 0;
        $lineGenerator = DataReader::readLine(7, $this->withExampleData);

        foreach ($lineGenerator as $line) {
            $values = array_map(static fn(string $val): int => str_contains($val, ':') ? (int) substr($val, 0, -1) : (int) $val, explode(' ', $line));

            $result = $values[0];
            $numbers = array_slice($values, 1);

            $bits = count($numbers) - 1;
            $nbLoops = 3 ** $bits;
            for ($i = 0; $i < $nbLoops; $i++) {
                $newTotal = $numbers[0];

                // Compute all possible combinations of operators
                $bitString = str_pad(base_convert((string) $i, 10, 3), $bits,'0',\STR_PAD_LEFT);
                for ($j = 0; $j < $bits; $j++) {
                    $operator = $bitString[$j];
                    if ($operator === '0') {
                        $newTotal += $numbers[$j + 1];
                    }
                    if ($operator === '1') {
                        $newTotal *= $numbers[$j + 1];
                        if ($newTotal > $result) {
                            continue 2;
                        }
                    }
                    if ($operator === '2') {
                        $newTotal .= $numbers[$j + 1];
                    }
                }

                if ((int) $newTotal === $result) {
                    $solution += $result;
                    continue 2;
                }
            }
        }

        return $solution;
    }
}
