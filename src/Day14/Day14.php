<?php

declare(strict_types=1);

namespace App\Day14;

use App\AdventOfCodeProblem;
use App\Utils\DataReader;

final readonly class Day14 implements AdventOfCodeProblem
{
    public function __construct(
        private bool $withExampleData = false,
    ) {}

    public function firstPart(): int
    {
        $lineGenerator = DataReader::readLine(14, $this->withExampleData);

        $rows = 103; // 103
        $cols = 101; // 101
        $robotPosAndVs = [];
        foreach ($lineGenerator as $line) {
            preg_match_all('/-?(\d+)/', $line, $matches);
            $matches = array_map(static fn (string $val): int => (int) $val, $matches[0]);
            $robotPosAndVs[] = $matches;
        }

        $speeds = [];
        $positions = [];
        foreach ($robotPosAndVs as $robotIx => [$posX, $posY, $speedX, $speedY]) {
            $positions[$robotIx] = [$posY, $posX];
            $speeds[$robotIx] = [$speedY, $speedX];
        }

        $quadrants = [];
        $middleY = (int) floor($rows / 2);
        $middleX = (int) floor($cols / 2);

        foreach ($robotPosAndVs as $robot => $_) {
            $finalY = ($positions[$robot][0] + 100 * $speeds[$robot][0]) % $rows;
            $finalX = ($positions[$robot][1] + 100 * $speeds[$robot][1]) % $cols;

            if ($finalY < 0) {
                $finalY += $rows;
            }
            if ($finalX < 0) {
                $finalX += $cols;
            }

            if ($finalY < $middleY && $finalX < $middleX) {
                ++$quadrants[0];
            }

            if ($finalY < $middleY && $finalX > $middleX) {
                ++$quadrants[1];
            }

            if ($finalY > $middleY && $finalX < $middleX) {
                ++$quadrants[2];
            }

            if ($finalY > $middleY && $finalX > $middleX) {
                ++$quadrants[3];
            }
        }

        return array_product($quadrants);
    }

    public function secondPart(): int
    {
        $lineGenerator = DataReader::readLine(14, $this->withExampleData);

        $rows = 103; // 103
        $cols = 101; // 101
        $robotPosAndVs = [];
        foreach ($lineGenerator as $line) {
            preg_match_all('/-?(\d+)/', $line, $matches);
            $matches = array_map(static fn (string $val): int => (int) $val, $matches[0]);
            $robotPosAndVs[] = $matches;
        }

        $speeds = [];
        $positions = [];
        foreach ($robotPosAndVs as $robotIx => [$posX, $posY, $speedX, $speedY]) {
            $positions[$robotIx] = [$posY, $posX];
            $speeds[$robotIx] = [$speedY, $speedX];
        }

        $emptyGrid = [];
        for($y = 0; $y < $rows; $y++) {
            for($x = 0; $x < $cols; $x++) {
                $emptyGrid[$y][$x] = '.';
            }
        }

        $seconds = 0;
        while (true) {
            $grid = $emptyGrid;
            foreach ($robotPosAndVs as $robot => $_) {
                $finalY = ($positions[$robot][0] + $seconds * $speeds[$robot][0]) % $rows;
                $finalX = ($positions[$robot][1] + $seconds * $speeds[$robot][1]) % $cols;

                if ($finalY < 0) {
                    $finalY += $rows;
                }
                if ($finalX < 0) {
                    $finalX += $cols;
                }

                $grid[$finalY][$finalX] = '#';
            }
            foreach ($grid as $row) {
                if (str_contains(implode($row), '########')) {
                    break 2;
                }
            }
            $seconds++;
        }

        file_put_contents(
            __DIR__ . '/christmas.txt',
            implode(PHP_EOL, array_map(static fn (array $row): string => implode($row), $grid)),
        );
        return $seconds;
    }
}
