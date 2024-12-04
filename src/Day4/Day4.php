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
        $matrix = [];
        $xPositions = [];
        foreach ($lineGenerator as $ix => $line) {
            $row = str_split($line);
            $matrix[$ix] = $row;
            foreach ($row as $ic => $col) {
                if ($col === 'X') {
                    $xPositions[$ix][$ic] = true;
                } else {
                    $xPositions[$ix][$ic] = false;
                }
            }
        }

        $rowCount = count($matrix);
        $colCount = count($matrix[0]);
        for ($i = 0; $i < $rowCount; $i++) {
            for ($j = 0; $j < $colCount; $j++) {
                // optimize a bit only going through known X positions
                if ($xPositions[$i][$j] === false) {
                    continue;
                }

                // we are on an X, find all M letters next to it and keep going on that direction
                if (isset($matrix[$i - 1][$j]) && $matrix[$i - 1][$j] === 'M' // up
                    && isset($matrix[$i - 2][$j]) && $matrix[$i - 2][$j] === 'A'
                    && isset($matrix[$i - 3][$j]) && $matrix[$i - 3][$j] === 'S'
                ) {
                    $solution++;
                }

                if (isset($matrix[$i + 1][$j]) && $matrix[$i + 1][$j] === 'M' // down
                    && isset($matrix[$i + 2][$j]) && $matrix[$i + 2][$j] === 'A'
                    && isset($matrix[$i + 3][$j]) && $matrix[$i + 3][$j] === 'S'
                ) {
                    $solution++;
                }

                if (isset($matrix[$i][$j - 1]) && $matrix[$i][$j - 1] === 'M' // left
                    && isset($matrix[$i][$j - 2]) && $matrix[$i][$j - 2] === 'A'
                    && isset($matrix[$i][$j - 3]) && $matrix[$i][$j - 3] === 'S'
                ) {
                    $solution++;
                }

                if (isset($matrix[$i][$j + 1]) && $matrix[$i][$j + 1] === 'M' // right
                    && isset($matrix[$i][$j + 2]) && $matrix[$i][$j + 2] === 'A'
                    && isset($matrix[$i][$j + 3]) && $matrix[$i][$j + 3] === 'S'
                ) {
                    $solution++;
                }

                // here?
                if (isset($matrix[$i - 1][$j - 1]) && $matrix[$i - 1][$j - 1] === 'M' // up-left
                    && isset($matrix[$i - 2][$j - 2]) && $matrix[$i - 2][$j - 2] === 'A'
                    && isset($matrix[$i - 3][$j - 3]) && $matrix[$i - 3][$j - 3] === 'S'
                ) {
                    $solution++;
                }

                if (isset($matrix[$i - 1][$j + 1]) && $matrix[$i - 1][$j + 1] === 'M' // up-right
                    && isset($matrix[$i - 2][$j + 2]) && $matrix[$i - 2][$j + 2] === 'A'
                    && isset($matrix[$i - 3][$j + 3]) && $matrix[$i - 3][$j + 3] === 'S'
                ) {
                    $solution++;
                }

                if (isset($matrix[$i + 1][$j - 1]) && $matrix[$i + 1][$j - 1] === 'M' // down-left
                    && isset($matrix[$i + 2][$j - 2]) && $matrix[$i + 2][$j - 2] === 'A'
                    && isset($matrix[$i + 3][$j - 3]) && $matrix[$i + 3][$j - 3] === 'S'
                ) {
                    $solution++;
                }

                if (isset($matrix[$i + 1][$j + 1]) && $matrix[$i + 1][$j + 1] === 'M' // down-right
                    && isset($matrix[$i + 2][$j + 2]) && $matrix[$i + 2][$j + 2] === 'A'
                    && isset($matrix[$i + 3][$j + 3]) && $matrix[$i + 3][$j + 3] === 'S'
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
        $lineGenerator = DataReader::readLine(4, $this->withExampleData);
        $matrix = [];
        $aPositions = [];
        foreach ($lineGenerator as $ix => $line) {
            $row = str_split($line);
            $matrix[$ix] = $row;
            foreach ($row as $ic => $col) {
                if ($col === 'A') {
                    $aPositions[$ix][$ic] = true;
                } else {
                    $aPositions[$ix][$ic] = false;
                }
            }
        }

        $rowCount = count($matrix);
        $colCount = count($matrix[0]);
        for ($i = 0; $i < $rowCount; $i++) {
            for ($j = 0; $j < $colCount; $j++) {
                // optimize a bit only going through known A positions
                if ($aPositions[$i][$j] === false) {
                    continue;
                }

                // M . S
                // . A .
                // M . S
                if (isset($matrix[$i - 1][$j - 1]) && $matrix[$i - 1][$j - 1] === 'M' // up-left
                    && isset($matrix[$i - 1][$j + 1]) && $matrix[$i - 1][$j + 1] === 'S' // up-right
                    && isset($matrix[$i + 1][$j - 1]) && $matrix[$i + 1][$j - 1] === 'M' // down-left
                    && isset($matrix[$i + 1][$j + 1]) && $matrix[$i + 1][$j + 1] === 'S' // down-right
                ) {
                    $solution++;
                }

                // S . M
                // . A .
                // S . M
                if (isset($matrix[$i - 1][$j - 1]) && $matrix[$i - 1][$j - 1] === 'S' // up-left
                    && isset($matrix[$i - 1][$j + 1]) && $matrix[$i - 1][$j + 1] === 'M' // up-right
                    && isset($matrix[$i + 1][$j - 1]) && $matrix[$i + 1][$j - 1] === 'S' // down-left
                    && isset($matrix[$i + 1][$j + 1]) && $matrix[$i + 1][$j + 1] === 'M' // down-right
                ) {
                    $solution++;
                }

                // S . S
                // . A .
                // M . M
                if (isset($matrix[$i - 1][$j - 1]) && $matrix[$i - 1][$j - 1] === 'S' // up-left
                    && isset($matrix[$i - 1][$j + 1]) && $matrix[$i - 1][$j + 1] === 'S' // up-right
                    && isset($matrix[$i + 1][$j - 1]) && $matrix[$i + 1][$j - 1] === 'M' // down-left
                    && isset($matrix[$i + 1][$j + 1]) && $matrix[$i + 1][$j + 1] === 'M' // down-right
                ) {
                    $solution++;
                }

                // M . M
                // . A .
                // S . S
                if (isset($matrix[$i - 1][$j - 1]) && $matrix[$i - 1][$j - 1] === 'M' // up-left
                    && isset($matrix[$i - 1][$j + 1]) && $matrix[$i - 1][$j + 1] === 'M' // up-right
                    && isset($matrix[$i + 1][$j - 1]) && $matrix[$i + 1][$j - 1] === 'S' // down-left
                    && isset($matrix[$i + 1][$j + 1]) && $matrix[$i + 1][$j + 1] === 'S' // down-right
                ) {
                    $solution++;
                }
            }
        }

        return $solution;
    }
}
