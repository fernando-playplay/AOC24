<?php

declare(strict_types=1);

namespace App\Day3;

use App\AdventOfCodeProblem;
use App\Utils\DataReader;

final readonly class Day3 implements AdventOfCodeProblem
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

            // todo: here
        }

        return $solution;
    }

    public function secondPart(): int
    {
        $solution = 0;
        $lineGenerator = DataReader::readLine(2, $this->withExampleData);
        foreach ($lineGenerator as $line) {
            $values = array_map(static fn(string $val): int => (int) $val, explode(' ', $line));

            // todo: here
        }

        return $solution;
    }
}
