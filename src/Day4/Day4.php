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
        [$matrix, $xPositions] = $this->getMatrixAndMainLetterPositions(searchForLetter: 'X');

        $rowCount = count($matrix);
        $colCount = count($matrix[0]);
        for ($i = 0; $i < $rowCount; $i++) {
            for ($j = 0; $j < $colCount; $j++) {
                if ($xPositions[$i][$j] === false) {
                    continue;
                }

                // we are on an X, find all M letters next to it and keep going on that direction
                if (
                    isset($matrix[$i - 1][$j], $matrix[$i - 2][$j], $matrix[$i - 3][$j])
                    && $matrix[$i - 1][$j] === 'M'
                    && $matrix[$i - 2][$j] === 'A'
                    && $matrix[$i - 3][$j] === 'S'
                ) {
                    $solution++;
                }

                if (
                    isset($matrix[$i + 1][$j], $matrix[$i + 2][$j], $matrix[$i + 3][$j])
                    && $matrix[$i + 1][$j] === 'M' // down
                    && $matrix[$i + 2][$j] === 'A'
                    && $matrix[$i + 3][$j] === 'S'
                ) {
                    $solution++;
                }

                if (
                    isset($matrix[$i][$j - 1], $matrix[$i][$j - 2], $matrix[$i][$j - 3])
                    && $matrix[$i][$j - 1] === 'M' // left
                    && $matrix[$i][$j - 2] === 'A'
                    && $matrix[$i][$j - 3] === 'S'
                ) {
                    $solution++;
                }

                if (
                    isset($matrix[$i][$j + 1], $matrix[$i][$j + 2], $matrix[$i][$j + 3])
                    && $matrix[$i][$j + 1] === 'M' // right
                    && $matrix[$i][$j + 2] === 'A'
                    && $matrix[$i][$j + 3] === 'S'
                ) {
                    $solution++;
                }

                if (
                    isset($matrix[$i - 1][$j - 1], $matrix[$i - 2][$j - 2], $matrix[$i - 3][$j - 3])
                    && $matrix[$i - 1][$j - 1] === 'M' // up-left
                    && $matrix[$i - 2][$j - 2] === 'A'
                    && $matrix[$i - 3][$j - 3] === 'S'
                ) {
                    $solution++;
                }

                if (
                    isset($matrix[$i - 1][$j + 1], $matrix[$i - 2][$j + 2], $matrix[$i - 3][$j + 3])
                    && $matrix[$i - 1][$j + 1] === 'M' // up-right
                    && $matrix[$i - 2][$j + 2] === 'A'
                    && $matrix[$i - 3][$j + 3] === 'S'
                ) {
                    $solution++;
                }

                if (
                    isset($matrix[$i + 1][$j - 1], $matrix[$i + 2][$j - 2], $matrix[$i + 3][$j - 3])
                    && $matrix[$i + 1][$j - 1] === 'M' // down-left
                    && $matrix[$i + 2][$j - 2] === 'A'
                    && $matrix[$i + 3][$j - 3] === 'S'
                ) {
                    $solution++;
                }

                if (
                    isset($matrix[$i + 1][$j + 1], $matrix[$i + 2][$j + 2], $matrix[$i + 3][$j + 3])
                    && $matrix[$i + 1][$j + 1] === 'M' // down-right
                    && $matrix[$i + 2][$j + 2] === 'A'
                    && $matrix[$i + 3][$j + 3] === 'S'
                ) {
                    $solution++;
                }
            }
        }

        return $solution;
    }

    public function secondPart(): int
    {
        $solution = 0;
        [$matrix, $aPositions] = $this->getMatrixAndMainLetterPositions(searchForLetter: 'A');

        $rowCount = count($matrix);
        $colCount = count($matrix[0]);
        for ($i = 0; $i < $rowCount; $i++) {
            for ($j = 0; $j < $colCount; $j++) {
                if ($aPositions[$i][$j] === false) {
                    continue;
                }

                // M . S
                // . A .
                // M . S
                if ($this->hasPattern($matrix, $i, $j, 'M', 'S', 'M', 'S')) {
                    $solution++;
                    continue;
                }

                // S . M
                // . A .
                // S . M
                if ($this->hasPattern($matrix, $i, $j, 'S', 'M', 'S', 'M')) {
                    $solution++;
                    continue;
                }

                // S . S
                // . A .
                // M . M
                if ($this->hasPattern($matrix, $i, $j, 'S', 'S', 'M', 'M')) {
                    $solution++;
                    continue;
                }

                // M . M
                // . A .
                // S . S
                if ($this->hasPattern($matrix, $i, $j, 'M', 'M', 'S', 'S')) {
                    $solution++;
                }
            }
        }

        return $solution;
    }

    public function getMatrixAndMainLetterPositions(string $searchForLetter): array
    {
        $lineGenerator = DataReader::readLine(4, $this->withExampleData);
        $matrix = [];
        $mainLetterPositions = [];

        foreach ($lineGenerator as $i => $line) {
            $row = str_split($line);
            $matrix[$i] = $row;
            foreach ($row as $j => $col) {
                if ($col === $searchForLetter) {
                    $mainLetterPositions[$i][$j] = true;
                } else {
                    $mainLetterPositions[$i][$j] = false;
                }
            }
        }

        return [$matrix, $mainLetterPositions];
    }

    private function hasPattern(array $matrix, int $rowIndex, int $colIndex, string $char1, string $char2, string $char3, string $char4): bool
    {
        return isset($matrix[$rowIndex - 1][$colIndex - 1], $matrix[$rowIndex - 1][$colIndex + 1], $matrix[$rowIndex + 1][$colIndex - 1], $matrix[$rowIndex + 1][$colIndex + 1])
            && $matrix[$rowIndex - 1][$colIndex - 1] === $char1 // up-left
            && $matrix[$rowIndex - 1][$colIndex + 1] === $char2 // up-right
            && $matrix[$rowIndex + 1][$colIndex - 1] === $char3 // down-left
            && $matrix[$rowIndex + 1][$colIndex + 1] === $char4; // down-right
    }
}
