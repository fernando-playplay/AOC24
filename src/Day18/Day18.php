<?php

declare(strict_types=1);

namespace App\Day18;

use App\AdventOfCodeProblem;
use App\Utils\DataReader;
use SplMinHeap;

final readonly class Day18
{
    private const array DIRECTIONS = [[-1, 0], [0, 1], [1, 0], [0, -1]]; // up, right, down, left

    public function __construct(
        private bool $withExampleData = false,
    ) {}

    public function firstPart(): int
    {
        $lineGenerator = DataReader::readLine(18, $this->withExampleData);
        //$maxRows = 7;
        //$maxBytes = 12;
        $maxRows = 71;
        $maxBytes = 1024;

        $map = array_fill(0, $maxRows, str_repeat('.', $maxRows));

        $turns = 0;
        while (++$turns && $lineGenerator->valid()) {
            [$x, $y] = array_map(static fn (string $val): int => (int) $val, explode(',', $lineGenerator->current()));
            $map[$y][$x] = '#';

            if ($turns < $maxBytes) {
                $lineGenerator->next();
                continue;
            }

            $path = null;
            if (isset($path) && !str_contains($path, $y . '.' . $x)) {
                $lineGenerator->next();
                continue;
            }

            $val = [];
            $heap = new SplMinHeap();
            $heap->insert([0, 0, 0, '0.0']);
            while (!$heap->isEmpty()) {
                [$dist, $row, $col, $path] = $heap->extract();
                if ($row === $maxRows - 1 && $col === $maxRows - 1) {
                    if ($turns === $maxBytes) {
                        return $dist;
                    }

                    $lineGenerator->next();
                    continue 2;
                }

                $key = $row . '.' . $col;
                if (isset($val[$key])) {
                    $lineGenerator->next();
                    continue;
                }

                $val[$key] = $dist;
                foreach (self::DIRECTIONS as [$dY, $dX]) {
                    [$tmpY, $tmpX] = [$row + $dY, $col + $dX];
                    if ($tmpY < 0 || $tmpY >= $maxRows || $tmpX < 0 || $tmpX >= $maxRows || $map[$tmpY][$tmpX] === '#') {
                        $lineGenerator->next();
                        continue;
                    }

                    $key = $tmpY . '.' . $tmpX;
                    if (isset($val[$key])) {
                        $lineGenerator->next();
                        continue;
                    }

                    $path .= '|' . $tmpY . '.' . $tmpX;
                    $heap->insert([$dist + 1, $tmpY, $tmpX, $path]);
                    $lineGenerator->next();
                }
            }
            break;
        }

        return 0;
    }

    public function secondPart(): string
    {
        //$maxBytes = 12;
        $maxBytes = 1024;
        while (true) {
            $result = $this->compute($maxBytes);
            if ($result !== null) {
                return $result;
            }
            $maxBytes++;
        }
    }

    public function compute(int $maxBytes): ?string
    {
        $lineGenerator = DataReader::readLine(18, $this->withExampleData);
        //$maxRows = 7;
        $maxRows = 71;

        $map = array_fill(0, $maxRows, str_repeat('.', $maxRows));

        $turns = 0;
        while (++$turns && $lineGenerator->valid()) {
            [$x, $y] = array_map(static fn (string $val): int => (int) $val, explode(',', $lineGenerator->current()));
            $map[$y][$x] = '#';

            if ($turns < $maxBytes) {
                $lineGenerator->next();
                continue;
            }

            $path = null;
            if (isset($path) && !str_contains($path, $y . '.' . $x)) {
                $lineGenerator->next();
                continue;
            }

            $val = [];
            $heap = new SplMinHeap();
            $heap->insert([0, 0, 0, '0.0']);
            while (!$heap->isEmpty()) {
                [$dist, $row, $col, $path] = $heap->extract();
                if ($row === $maxRows - 1 && $col === $maxRows - 1) {
                    $lineGenerator->next();
                    continue 2;
                }

                $key = $row . '.' . $col;
                if (isset($val[$key])) {
                    $lineGenerator->next();
                    continue;
                }

                $val[$key] = $dist;
                foreach (self::DIRECTIONS as [$dY, $dX]) {
                    [$tmpY, $tmpX] = [$row + $dY, $col + $dX];
                    if ($tmpY < 0 || $tmpY >= $maxRows || $tmpX < 0 || $tmpX >= $maxRows || $map[$tmpY][$tmpX] === '#') {
                        $lineGenerator->next();
                        continue;
                    }

                    $key = $tmpY . '.' . $tmpX;
                    if (isset($val[$key])) {
                        $lineGenerator->next();
                        continue;
                    }

                    $path .= '|' . $tmpY . '.' . $tmpX;
                    $heap->insert([$dist + 1, $tmpY, $tmpX, $path]);
                    $lineGenerator->next();
                }
            }
            return $x . ',' . $y;
        }

        return null;
    }
}
