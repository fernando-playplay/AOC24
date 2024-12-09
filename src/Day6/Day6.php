<?php

declare(strict_types=1);

namespace App\Day6;

use App\AdventOfCodeProblem;
use App\Utils\DataReader;

final readonly class Day6 implements AdventOfCodeProblem
{
    public function __construct(
        private bool $withExampleData = false,
    ) {}

    public function firstPart(): int
    {
        $solution = 0;
        $lineGenerator = DataReader::readLine(6, $this->withExampleData);
        $map = [];
        $startPosition = [];
        foreach ($lineGenerator as $yIndex => $line) {
            $row = str_split($line);
            $map[] = $row;
            if ($startPosition === [] && in_array('^', $row, true)) {
                $xPos = strpos($line, '^');
                $startPosition['x'] = $xPos;
                $startPosition['y'] = $yIndex;
            }
        }

        $currentPosition = $startPosition;
        $map[$startPosition['y']][$startPosition['x']] = 'X';
        $direction = '^'; // = up, v = down, > = right, < = left
        // # is an obstacle, if we encounter it, we turn 90 degrees to the right and keep moving in the new direction)
        while (true) {
            match ($direction) {
                '^' => --$currentPosition['y'],
                'v' => ++$currentPosition['y'],
                '>' => ++$currentPosition['x'],
                '<' => --$currentPosition['x'],
            };

            // we are out of the map!
            if (!isset($map[$currentPosition['y']][$currentPosition['x']])) {
                break;
            }

            if ($map[$currentPosition['y']][$currentPosition['x']] !== '#') {
                $map[$currentPosition['y']][$currentPosition['x']] = 'X';
            } else {
                switch ($direction) {
                    case '^':
                        $direction = '>';
                        $currentPosition['y']++;
                        break;
                    case '>':
                        $direction = 'v';
                        $currentPosition['x']--;
                        break;
                    case 'v':
                        $direction = '<';
                        $currentPosition['y']--;
                        break;
                    default:
                        $direction = '^';
                        $currentPosition['x']++;
                        break;
                }
            }
        }

        foreach ($map as $row) {
            $solution += substr_count(implode($row), 'X');
        }

        return $solution;
    }

    public function secondPart(): int
    {
        $solution = 0;
        $lineGenerator = DataReader::readLine(6, $this->withExampleData);
        $map = [];
        $startPosition = [];
        foreach ($lineGenerator as $yIndex => $line) {
            $row = str_split($line);
            $map[] = $row;
            if ($startPosition === [] && in_array('^', $row, true)) {
                $xPos = strpos($line, '^');
                $startPosition['x'] = $xPos;
                $startPosition['y'] = $yIndex;
            }
        }

        $map = $this->move($startPosition, $map);

        foreach ($map as $yIndex => $row) {
            foreach ($row as $xIndex => $value) {
                if ($value === 'X') {
                    $originalMapCopy = $map;
                    $map[$yIndex][$xIndex] = '#';
                    $map = $this->move($startPosition, $map);
                    if ($map === false) {
                        $solution++;
                    }
                    $map = $originalMapCopy;
                }
            }
        }

        return $solution;
    }

    public function move(array $startPosition, array $map): array|false
    {
        $currentPosition = $startPosition;
        $direction = '^';
        $moves = 0;
        $maxMoves = 6_000;
        while (true) {
            if ($moves === $maxMoves) {
                return false;
            }
            match ($direction) {
                '^' => --$currentPosition['y'],
                'v' => ++$currentPosition['y'],
                '>' => ++$currentPosition['x'],
                '<' => --$currentPosition['x'],
            };

            // we are out of the map!
            if (!isset($map[$currentPosition['y']][$currentPosition['x']])) {
                break;
            }

            if ($map[$currentPosition['y']][$currentPosition['x']] !== '#') {
                $map[$currentPosition['y']][$currentPosition['x']] = 'X';
                $moves++;
                continue;
            }
            switch ($direction) {
                case '^':
                    $direction = '>';
                    $currentPosition['y']++;
                    break;
                case '>':
                    $direction = 'v';
                    $currentPosition['x']--;
                    break;
                case 'v':
                    $direction = '<';
                    $currentPosition['y']--;
                    break;
                default:
                    $direction = '^';
                    $currentPosition['x']++;
                    break;
            }
        }

        return $map;
    }
}
