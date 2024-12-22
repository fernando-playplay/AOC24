<?php

declare(strict_types=1);

namespace App\Day15;

use App\AdventOfCodeProblem;
use App\Utils\DataReader;

final class Day15 implements AdventOfCodeProblem
{
    private const array DIRECTIONS = ['^' => [-1, 0], 'v' => [1, 0], '>' => [0, 1], '<' => [0, -1]]; // up, down, right, left
    private array $map;
    private readonly string $sequenceOfMoves;

    public function __construct(
        private readonly bool $withExampleData = false,
    ) {}

    public function firstPart(): int
    {
        $lineGenerator = DataReader::readLine(15, $this->withExampleData);
        $map = [];
        $sequenceOfMoves = [];
        $moves = false;
        foreach ($lineGenerator as $line) {
            if ($line === '') {
                $moves = true;
                continue;
            }

            if (!$moves) {
                $map[] = $line;
                continue;
            }

            $sequenceOfMoves[] = $line;
        }

        $this->map = $map;
        $this->sequenceOfMoves = implode('', $sequenceOfMoves);

        $nbRows = count($this->map);
        $start = [0, 0];
        for ($i = 0; $i < $nbRows; $i++) {
            if (str_contains($this->map[$i], '@')) {
                $start = [$i, strpos($this->map[$i], '@')];
                break;
            }
        }

        return $this->moveBoxesPart1(...$start);
    }

    private function moveBoxesPart1(int $startY, int $startX): int
    {
        for ($i = 0, $iMax = strlen($this->sequenceOfMoves); $i < $iMax; $i++) {
            [$dY, $dX] = self::DIRECTIONS[$this->sequenceOfMoves[$i]];
            [$tmpY, $tmpX] = [$startY + $dY, $startX + $dX];
            switch ($this->map[$tmpY][$tmpX]) {
                case '#':
                    continue 2;
                case '.':
                case '@':
                    [$startY, $startX] = [$tmpY, $tmpX];
                    continue 2;
                case 'O':
                case '[':
                case ']':
                    $queue = [[$startY, $startX]];
                    $val = [];
                    while ($queue !== []) {
                        [$tmpY, $tmpX] = array_shift($queue);
                        $key = $tmpY . '.' . $tmpX;
                        if (isset($val[$key])) {
                            continue;
                        }
                        $val[$key] = 1;
                        [$nextY, $nextX] = [$tmpY + $dY, $tmpX + $dX];
                        $temp = $this->map[$nextY][$nextX];
                        switch ($temp) {
                            case '#':
                                continue 4;
                            case 'O':
                                $queue[] = [$nextY, $nextX];
                                break;
                            case '[':
                            case ']':
                                $queue[] = [$nextY, $nextX];
                                $queue[] = [$nextY, $nextX + ($temp === '[' ? 1 : -1)];
                        }
                    }

                    while ($val) {
                        foreach (array_keys($val) as $key) {
                            [$tmpY, $tmpX] = explode('.', $key);
                            [$nextY, $nextX] = [(int) $tmpY + $dY, (int) $tmpX + $dX];
                            $nextKey = $nextY . '.' . $nextX;
                            if (!isset($val[$nextKey])) {
                                $this->map[$nextY][$nextX] = $this->map[$tmpY][$tmpX];
                                $this->map[$tmpY][$tmpX] = '.';
                                unset($val[$tmpY . '.' . $tmpX]);
                            }
                        }
                    }
                    [$startY, $startX] = [$startY + $dY, $startX + $dX];
                    break;
            }
        }

        $gps = 0;
        $nbRows = count($this->map);
        $nbCols = strlen($this->map[0]);
        for ($i = 0; $i < $nbRows; $i++) {
            for ($j = 0; $j < $nbCols; $j++) {
                if (in_array($this->map[$i][$j], ['[', 'O'])) {
                    $gps += 100 * $i + $j;
                }
            }
        }

        return $gps;
    }

    public function secondPart(): int
    {
        $lineGenerator = DataReader::readLine(15, $this->withExampleData);
        $map = [];
        $sequenceOfMoves = [];
        $moves = false;
        foreach ($lineGenerator as $line) {
            if ($line === '') {
                $moves = true;
                continue;
            }

            if (!$moves) {
                $map[] = $line;
                continue;
            }

            $sequenceOfMoves[] = $line;
        }

        $this->map = $map;
        $this->sequenceOfMoves = implode('', $sequenceOfMoves);

        $start = [0, 0];
        $nbRows = count($this->map);
        for ($i = 0; $i < $nbRows; $i++) {
            if (str_contains($this->map[$i], '@')) {
                $start = [$i, strpos($this->map[$i], '@')];
                break;
            }
        }

        for ($i = 0; $i < $nbRows; $i++) {
            $row = $this->map[$i];
            $row = str_replace(['#', 'O', '.','@'], ['##', '[]', '..','@.'], $row);
            $this->map[$i] = $row;
        }

        return $this->moveBoxesPart2($start[0], $start[1] * 2);
    }

    private function moveBoxesPart2(int $startY, int $startX): int
    {
        for ($i = 0, $iMax = strlen($this->sequenceOfMoves); $i < $iMax; $i++) {
            [$dY, $dX] = self::DIRECTIONS[$this->sequenceOfMoves[$i]];
            [$tmpY, $tmpX] = [$startY + $dY, $startX + $dX];
            switch ($this->map[$tmpY][$tmpX]) {
                case '#':
                    continue 2;
                case '.':
                case '@':
                    [$startY, $startX] = [$tmpY, $tmpX];
                    continue 2;
                case 'O':
                case '[':
                case ']':
                    $queue = [[$startY, $startX]];
                    $val = [];
                    while ($queue !== []) {
                        [$tmpY, $tmpX] = array_shift($queue);
                        $key = $tmpY . '.' . $tmpX;
                        if (isset($val[$key])) {
                            continue;
                        }
                        $val[$key] = 1;
                        [$nextY, $nextX] = [$tmpY + $dY, $tmpX + $dX];
                        $temp = $this->map[$nextY][$nextX];
                        switch ($temp) {
                            case '#':
                                continue 4;
                            case 'O':
                                $queue[] = [$nextY, $nextX];
                                break;
                            case '[':
                            case ']':
                                $queue[] = [$nextY, $nextX];
                                $queue[] = [$nextY, $nextX + ($temp === '[' ? 1 : -1)];
                        }
                    }

                    while ($val) {
                        foreach (array_keys($val) as $key) {
                            [$tmpY, $tmpX] = explode('.', $key);
                            [$nextY, $nextX] = [(int) $tmpY + $dY, (int) $tmpX + $dX];
                            $nextKey = $nextY . '.' . $nextX;
                            if (!isset($val[$nextKey])) {
                                $this->map[$nextY][$nextX] = $this->map[$tmpY][$tmpX];
                                $this->map[$tmpY][$tmpX] = '.';
                                unset($val[$tmpY . '.' . $tmpX]);
                            }
                        }
                    }
                    [$startY, $startX] = [$startY + $dY, $startX + $dX];
                    break;
            }
        }

        $gps = 0;
        $nbRows = count($this->map);
        $nbCols = strlen($this->map[0]);
        for ($i = 0; $i < $nbRows; $i++) {
            for ($j = 0; $j < $nbCols; $j++) {
                if (in_array($this->map[$i][$j], ['[', 'O'])) {
                    $gps += 100 * $i + $j;
                }
            }
        }

        return $gps;
    }
}
