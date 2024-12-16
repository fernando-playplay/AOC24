<?php

declare(strict_types=1);

namespace App\Day10;

use App\AdventOfCodeProblem;
use App\Utils\DataReader;

final readonly class Day10 implements AdventOfCodeProblem
{
    private const array DIRECTIONS = [[-1, 0], [1, 0], [0, 1], [0, -1]]; // up, down, right, left
    private array $map;
    private int $nbRows;
    private int $nbCols;

    public function __construct(
        private bool $withExampleData = false,
    ) {
        $lineGenerator = DataReader::readLine(10, $this->withExampleData);
        $map = [];
        foreach ($lineGenerator as $line) {
            $map[] = $line;
        }

        $this->map = $map;
        $this->nbRows = count($this->map);
        $this->nbCols = strlen($this->map[0]);
    }

    public function firstPart(): int
    {
        $solution = 0;
        for ($i = 0; $i < $this->nbRows; $i++) {
            for ($j = 0; $j < $this->nbCols; $j++) {
                if ($this->map[$i][$j] !== '0') {
                    continue;
                }

                $solution += $this->pathFinder([$i, $j]);
            }
        }

        return $solution;
    }

    /** @var array{x: int, y: int} $start */
    private function pathFinder(array $start): int
    {
        $stack = [$start];
        $nextInLine = [];
        $acc = 0;
        while ($stack !== []) {
            [$y, $x] = array_shift($stack);
            if (isset($nextInLine["$y.$x"])) {
                continue;
            }
            $nextInLine["$y.$x"] = 1;

            if ((int) $this->map[$y][$x] === 9) {
                $acc++;
                continue;
            }

            // add to the stack as long as possible
            foreach (self::DIRECTIONS as [$dy, $dx]) {
                [$tmpY, $tmpX] = [$y + $dy, $x + $dx];
                // stay in bounds while moving in all directions
                if ($tmpY < 0 || $tmpY >= $this->nbRows || $tmpX < 0 || $tmpX >= $this->nbCols) {
                    continue;
                }
                if ((int) $this->map[$tmpY][$tmpX] === (int) $this->map[$y][$x] + 1) {
                    $stack[] = [$tmpY, $tmpX];
                }
            }
        }

        return $acc;
    }

    public function secondPart(): int
    {
        $solution = 0;
        for ($i = 0; $i < $this->nbRows; $i++) {
            for ($j = 0; $j < $this->nbCols; $j++) {
                if ($this->map[$i][$j] !== '0') {
                    continue;
                }

                $solution += $this->pathFinderPart2([$i, $j]);
            }
        }

        return $solution;
    }

    /** @var array{x: int, y: int} $start */
    private function pathFinderPart2(array $start): int
    {
        $stack = [$start];
        $acc = 0;
        while ($stack !== []) {
            [$y, $x] = array_shift($stack);
            if ((int) $this->map[$y][$x] === 9) {
                $acc++;
                continue;
            }

            // add to the stack as long as possible
            foreach (self::DIRECTIONS as [$dy, $dx]) {
                [$tmpY, $tmpX] = [$y + $dy, $x + $dx];
                // stay in bounds while moving in all directions
                if ($tmpY < 0 || $tmpY >= $this->nbRows || $tmpX < 0 || $tmpX >= $this->nbCols) {
                    continue;
                }
                if ((int) $this->map[$tmpY][$tmpX] === (int) $this->map[$y][$x] + 1) {
                    $stack[] = [$tmpY, $tmpX];
                }
            }
        }

        return $acc;
    }
}
