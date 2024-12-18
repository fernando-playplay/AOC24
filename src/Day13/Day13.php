<?php

declare(strict_types=1);

namespace App\Day13;

use App\AdventOfCodeProblem;
use App\Utils\DataReader;

final readonly class Day13 implements AdventOfCodeProblem
{
    public function __construct(
        private bool $withExampleData = false,
    ) {}

    public function firstPart(): int
    {
        $solution = 0;
        $lineGenerator = DataReader::readLine(13, $this->withExampleData);
        $aXY = [];
        $bXY = [];
        foreach ($lineGenerator as $line) {
            if ($line === '') {
                continue;
            }

            if (str_starts_with($line, 'Button A')) {
                preg_match_all('/\d+/', $line, $aXY);
                $aXY = array_map(static fn (string $value): int => (int) $value, $aXY[0]);
            } elseif (str_starts_with($line, 'Button B')) {
                preg_match_all('/\d+/', $line, $bXY);
                $bXY = array_map(static fn (string $value): int => (int) $value, $bXY[0]);
            } else {
                // To get the solution, we must solve a system of equations like:
                // Button A: X+94, Y+34
                // Button B: X+22, Y+67
                // Prize: X=8400, Y=5400
                // 94a + 22b = 8400
                // 34a + 67b = 5400
                $targetXY = [];
                preg_match_all('/\d+/', $line, $targetXY);
                $targetXY = array_map(static fn (string $value): int => (int) $value, $targetXY[0]);

                $pressA = ($targetXY[0] * $bXY[1] - $targetXY[1] * $bXY[0]) / ($aXY[0] * $bXY[1] - $aXY[1] * $bXY[0]);
                $pressB = ($targetXY[0] - $aXY[0] * $pressA) / $bXY[0];
                if (is_float($pressA) || is_float($pressB)) {
                    continue;
                }
                $solution += $pressA * 3 + $pressB;
            }
        }

        return $solution;
    }

    public function secondPart(): int
    {
        $solution = 0;
        $lineGenerator = DataReader::readLine(13, $this->withExampleData);
        $aXY = [];
        $bXY = [];
        foreach ($lineGenerator as $line) {
            if ($line === '') {
                continue;
            }

            if (str_starts_with($line, 'Button A')) {
                preg_match_all('/\d+/', $line, $aXY);
                $aXY = array_map(static fn (string $value): int => (int) $value, $aXY[0]);
                continue;
            }

            if (str_starts_with($line, 'Button B')) {
                preg_match_all('/\d+/', $line, $bXY);
                $bXY = array_map(static fn (string $value): int => (int) $value, $bXY[0]);
                continue;
            }

            if (str_starts_with($line, 'Prize:')) {
                // To get the solution, we must solve a system of equations like:
                // Button A: X+94, Y+34
                // Button B: X+22, Y+67
                // Prize: X=8400, Y=5400
                // 94a + 22b = 8400
                // 34a + 67b = 5400
                $targetXY = [];
                preg_match_all('/\d+/', $line, $targetXY);
                $targetXY = array_map(static fn (string $value): int => (int) $value + 10000000000000, $targetXY[0]);

                $pressA = ($targetXY[0] * $bXY[1] - $targetXY[1] * $bXY[0]) / ($aXY[0] * $bXY[1] - $aXY[1] * $bXY[0]);
                $pressB = ($targetXY[0] - $aXY[0] * $pressA) / $bXY[0];
                if (is_float($pressA) || is_float($pressB)) {
                    continue;
                }
                $solution += $pressA * 3 + $pressB;
            }
        }

        return $solution;
    }
}
