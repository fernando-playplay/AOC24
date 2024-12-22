<?php

declare(strict_types=1);

namespace App\Day16;

use App\AdventOfCodeProblem;
use App\Utils\DataReader;
use SplMinHeap;

final class Day16 implements AdventOfCodeProblem
{
    private const array DIRECTIONS = [[-1, 0], [0, 1], [1, 0], [0, -1]]; // up, right, down, left
    private array $map;

    public function __construct(
        private readonly bool $withExampleData = false,
    ) {}

    public function firstPart(): int
    {
        $lineGenerator = DataReader::readLine(16, $this->withExampleData);
        $this->map = [];
        foreach ($lineGenerator as $line) {
            $this->map[] = str_split($line);
        }

        return $this->pathFinderPart1();
    }

    private function pathFinderPart1(): int
    {
        $nbRows = count($this->map);
        $nbCols = count($this->map[0]);
        // start and end positions are always the same from the maps
        $start = [$nbRows - 2, 1];
        $end = [1, $nbCols - 2];

        // SplMinHeap is a priority queue
        // we can use the cost as the priority
        // to get the minimum cost path
        $heap = new SplMinHeap();
        // also we know that the start direction is up, so the last param here is 1 (up)
        // start[0] is the row, start[1] is the col
        $heap->insert([0, $start[0], $start[1], 1]);

        $min = INF;
        while (!$heap->isEmpty()) {
            [$cost, $row, $col, $dir] = $heap->extract();
            $key = $row . '.' . $col . '.' . $dir;
            if (isset($val[$key])) {
                continue;
            }

            $val[$key] = $cost;
            if ($row === $end[0] && $col === $end[1]) {
                if ($cost > $min) {
                    break;
                }

                $min = $cost;
            }

            foreach ([$dir, ($dir + 1) % 4, ($dir + 3) % 4] as $_dir) {
                [$dY, $dX] = self::DIRECTIONS[$_dir];
                [$tmpY, $tmpX] = [$row + $dY, $col + $dX];
                // keep going on boundaries
                if ($this->map[$tmpY][$tmpX] === "#") {
                    continue;
                }

                if ($_dir === $dir) {
                    // move one step
                    $heap->insert([$cost + 1, $tmpY, $tmpX, $dir]);
                } else {
                    // rotate
                    $heap->insert([$cost + 1000, $row, $col, $_dir]);
                }
            }
        }

        return $min;
    }

    public function secondPart(): int
    {
        $lineGenerator = DataReader::readLine(16, $this->withExampleData);
        $this->map = [];
        foreach ($lineGenerator as $line) {
            $this->map[] = str_split($line);
        }

        $nbRows = count($this->map);
        $nbCols = count($this->map[0]);
        // start and end positions are always the same from the maps
        $start = [$nbRows - 2, 1];
        $end = [1, $nbCols - 2];

        $visited = [];
        $visited1 = [];
        $visited2 = [];
        $minCost = $this->pathFinderPart2($start, [1], $end, $visited1);
        $this->pathFinderPart2($end, [0, 1, 2, 3], $start, $visited2);

        foreach ($visited2 as $key => $cost) {
            [$row, $col, $dir] = array_map(static fn (string $val): int => (int) $val, explode('.', $key));
            $key = $row . '.' . $col . '.' . ($dir + 2) % 4;
            if ($cost + ($visited1[$key] ?? 0) === $minCost) {
                $visited[$row . '.' . $col] = 1;
            }
        }

        return count($visited);
    }

    private function pathFinderPart2(array $start, array $directions, array $end, array &$visited): int
    {
        // SplMinHeap is a priority queue
        // we can use the cost as the priority
        // to get the minimum cost path
        $heap = new SplMinHeap();
        // basically the same as the first part,
        // but now we have to check all directions for the best places to sit ^^
        foreach ($directions as $dir) {
            $heap->insert([0, $start[0], $start[1], $dir]);
        }
        $visited = [];

        $min = INF;
        while (!$heap->isEmpty()) {
            [$cost, $row, $col, $dir] = $heap->extract();
            $key = $row . '.' . $col . '.' . $dir;
            if (isset($visited[$key])) {
                continue;
            }

            $visited[$key] = $cost;
            if ($row === $end[0] && $col === $end[1]) {
                if ($cost > $min) {
                    break;
                }

                $min = $cost;
            }

            foreach ([$dir, ($dir + 1) % 4, ($dir + 3) % 4] as $_dir) {
                [$dY, $dX] = self::DIRECTIONS[$_dir];
                [$tmpY, $tmpX] = [$row + $dY, $col + $dX];
                // keep going on boundaries
                if ($this->map[$tmpY][$tmpX] === "#") {
                    continue;
                }

                if ($_dir === $dir) {
                    // move one step
                    $heap->insert([$cost + 1, $tmpY, $tmpX, $dir]);
                } else {
                    // rotate
                    $heap->insert([$cost + 1000, $row, $col, $_dir]);
                }
            }
        }

        return $min;
    }
}
