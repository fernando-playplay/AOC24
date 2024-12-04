<?php

declare(strict_types=1);

namespace App\Day5;

use App\AdventOfCodeProblem;
use App\Utils\DataReader;

final readonly class Day5 implements AdventOfCodeProblem
{
    public function __construct(
        private bool $withExampleData = false,
    ) {}

    public function firstPart(): int
    {
        $solution = 0;
        $lineGenerator = DataReader::readLine(5, $this->withExampleData);
        foreach ($lineGenerator as $line) {
            // noop
        }

        return $solution;
    }

    public function secondPart(): int
    {
        return 0;
    }
}
