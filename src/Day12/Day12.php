<?php

declare(strict_types=1);

namespace App\Day12;

use App\AdventOfCodeProblem;
use App\Utils\DataReader;

final readonly class Day12 implements AdventOfCodeProblem
{
    private const array DIRECTIONS = [[-1, 0], [1, 0], [0, 1], [0, -1]]; // up, down, right, left
    private array $map;
    private int $nbRows;
    private int $nbCols;

    public function __construct(
        private bool $withExampleData = false,
    ) {
        $lineGenerator = DataReader::readLine(12, $this->withExampleData);
        $map = [];
        foreach ($lineGenerator as $line) {
            $map[] = str_split($line);
        }

        $this->map = $map;
        $this->nbRows = count($this->map);
        $this->nbCols = count($this->map[0]);
    }

    public function firstPart(): int
    {
        $solution = 0;
        $visited = [];
        for ($i = 0; $i < $this->nbRows; $i++) {
            for ($j = 0; $j < $this->nbCols; $j++) {
                if (!($visited[$i . '.' . $j] ?? false)) {
                    [$area, $perimeter] = $this->pathFinder([$i, $j], $visited);
                    $solution += $area * $perimeter;
                }
            }
        }

        return $solution;
    }

    private function pathFinder(array $start, array &$visited): array
    {
        $stack = [$start];
        $area = 0;
        $perimeter = 0;
        while ($stack !== []) {
            [$y, $x] = array_shift($stack);
            if ($visited[$y . '.' . $x] ?? false) {
                continue;
            }
            $visited[$y . '.' . $x] = true;
            $area++;

            // add to the stack as long as possible
            foreach (self::DIRECTIONS as [$dy, $dx]) {
                [$tmpY, $tmpX] = [$y + $dy, $x + $dx];
                // stay in bounds while moving in all directions
                if (
                    $tmpY < 0
                    || $tmpY >= $this->nbRows
                    || $tmpX < 0
                    || $tmpX >= $this->nbCols
                    || $this->map[$tmpY][$tmpX] !== $this->map[$y][$x]
                ) {
                    $perimeter++;
                } else {
                    $stack[] = [$tmpY, $tmpX];
                }
            }
        }

        return [$area, $perimeter];
    }

    public function secondPart(): int
    {
        $solution = 0;
        $visited = [];
        for ($i = 0; $i < $this->nbRows; $i++) {
            for ($j = 0; $j < $this->nbCols; $j++) {
                if (!($visited[$i . '.' . $j] ?? false)) {
                    [$area, $sides] = $this->pathFinderPart2([$i, $j], $visited);
                    $solution += $area * $sides;
                }
            }
        }

        return $solution;
    }

    private function pathFinderPart2(array $start, array &$visited): array
    {
        $stack = [$start];
        $area = 0;
        $sides = 0;
        $fences = [];
        while ($stack !== []) {
            [$y, $x] = array_shift($stack);
            if ($visited[$y . '.' . $x] ?? false) {
                continue;
            }
            $visited[$y . '.' . $x] = true;
            $area++;

            // add to the stack as long as possible
            foreach (self::DIRECTIONS as [$dy, $dx]) {
                [$tmpY, $tmpX] = [$y + $dy, $x + $dx];
                // stay in bounds while moving in all directions
                if (
                    $tmpY < 0
                    || $tmpY >= $this->nbRows
                    || $tmpX < 0
                    || $tmpX >= $this->nbCols
                    || $this->map[$tmpY][$tmpX] !== $this->map[$y][$x]
                ) {
                    $fences[$dy . '.' . $dx][$y . '.' . $x] = true;
                } else {
                    $stack[] = [$tmpY, $tmpX];
                }
            }
        }

        foreach ($fences as $fence) {
            $visitedFences = [];
            foreach ($fence as $location => $bool) {
                if (!isset($visitedFences[$location])) {
                    $sides++;
                    $plots = [explode('.', $location)];

                    while ($plots) {
                        [$y, $x] = array_shift($plots);
                        if ($visitedFences[$y . '.' . $x] ?? false) {
                            continue;
                        }

                        $visitedFences[$y . '.' . $x] = true;
                        foreach (self::DIRECTIONS as [$dY, $dX]) {
                            [$nextY, $nextX] = [$y + $dY, $x + $dX];
                            if ($fence[$nextY . '.' . $nextX] ?? false) {
                                $plots[] = [$nextY, $nextX];
                            }
                        }
                    }
                }
            }
        }

        return [$area, $sides];
    }
}
