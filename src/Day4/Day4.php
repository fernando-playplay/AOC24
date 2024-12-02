<?php

declare(strict_types=1);

namespace App\Day4;

use App\AdventOfCodeProblem;
use App\Utils\DataReader;

final readonly class Day4 implements AdventOfCodeProblem
{
    public function __construct(
        private bool $withExampleData = false,
    ) {}

    public function firstPart(): int
    {
        $solution = 0;
        $lineGenerator = DataReader::readLine(4, $this->withExampleData);
        foreach ($lineGenerator as $line) {
        }

        return $solution;
    }

    public function secondPart(): int
    {
        $solution = 0;
        $lineGenerator = DataReader::readLine(4, $this->withExampleData);
        foreach ($lineGenerator as $line) {
        }

        return $solution;
    }
}
