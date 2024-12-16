<?php

declare(strict_types=1);

namespace App\Day9;

use App\AdventOfCodeProblem;
use App\Utils\DataReader;

final readonly class Day9 implements AdventOfCodeProblem
{
    public function __construct(
        private bool $withExampleData = false,
    ) {}

    public function firstPart(): int
    {
        $solution = 0;
        $line = DataReader::readLine(9, $this->withExampleData)->current();

        $disk = [];
        $id = 0;
        for ($i = 0, $iMax = strlen($line); $i < $iMax; $i += 2) {
            $nbBlocks = $line[$i];
            $nbSpaces = isset($line[$i + 1]) ? (int) $line[$i + 1] : 0;

            for ($j = 0; $j < $nbBlocks; $j++) {
                $disk[] = $id;
            }
            for ($j = 0; $j < $nbSpaces; $j++) {
                $disk[] = '.';
            }
            $id++;
        }

        $rightPosition = count($disk) - 1;
        $rightBlock = $disk[$rightPosition];
        $maxLoop = count(array_filter($disk, static fn (string $value): bool => $value !== '.'));
        for ($leftPosition = 0; $leftPosition < $maxLoop; $leftPosition++) {
            if ($disk[$leftPosition] !== '.') {
                continue;
            }

            while ($rightBlock === '.') {
                $rightPosition--;
                $rightBlock = $disk[$rightPosition];
            }

            $disk[$leftPosition] = $rightBlock;
            $disk[$rightPosition] = '.';
            $rightBlock = '.';
        }

        for ($i = 0; $i < $maxLoop; $i++) {
            $solution += $disk[$i] * $i;
        }

        return $solution;
    }

    public function secondPart(): int
    {
        $solution = 0;
        $line = DataReader::readLine(9, $this->withExampleData)->current();

        $diskMap = array_map(static fn(string $char): int => (int) $char, str_split($line));
        $filesAndSpaces = [];
        $id = 0;
        foreach ($diskMap as $index => $value) {
            if ($index % 2 !== 0) {
                for ($i = 0; $i < $value; $i++) {
                    $filesAndSpaces[] = '.';
                }
            } else {
                for ($i = 0; $i < $value; $i++) {
                    $filesAndSpaces[] = $id;
                }
                $id++;
            }
        }

        for ($i = count($filesAndSpaces) - 1; $i >= 0; $i--) {
            if ($filesAndSpaces[$i] === '.') {
                continue;
            }

            $file = $filesAndSpaces[$i];
            $current = $i;
            while ($filesAndSpaces[$current] === $file) {
                $current--;
            }

            $blocks = array_slice($filesAndSpaces, $current + 1, $i - $current);
            for ($j = 0; $j < $i; $j++) {
                if ($filesAndSpaces[$j] !== '.') {
                    continue;
                }

                $current = $j;
                while ($filesAndSpaces[$current] === '.') {
                    $current++;
                }

                $freeSpace = array_slice($filesAndSpaces, $j, $current - $j);
                if (count($freeSpace) >= count($blocks)) {
                    array_splice($filesAndSpaces, $j, count($blocks), $blocks);
                    array_splice($filesAndSpaces, $i - count($blocks) + 1, count($blocks), array_map(static fn (int $val): string => '.', range(0, count($blocks) -1)));
                    break;
                }
                $j += count($freeSpace);
            }
            $i -= count($blocks) -1;
        }

        for ($i = 0, $iMax = count($filesAndSpaces); $i < $iMax; $i++) {
            if ($filesAndSpaces[$i] === '.') {
                continue;
            }
            $solution += $filesAndSpaces[$i] * $i;
        }

        return $solution;
    }
}
