<?php

declare(strict_types=1);

namespace App\Day11;

use App\AdventOfCodeProblem;
use App\Utils\DataReader;

final readonly class Day11 implements AdventOfCodeProblem
{
    public function __construct(
        private bool $withExampleData = false,
    ) {}

    public function firstPart(): int
    {
        $line = DataReader::readLine(11, $this->withExampleData)->current();
        $stones = explode(' ', $line);
        for ($i = 0; $i < 25; $i++) {
            $tmpStones = [];
            foreach ($stones as $stone) {
                if ($stone === '0') {
                    $tmpStones[] = '1';
                } elseif (strlen($stone) % 2 === 0) {
                    $stoneA = (int) substr($stone, 0, strlen($stone) / 2);
                    $stoneB = (int) substr($stone, strlen($stone) / 2);

                    $tmpStones[] = (string) $stoneA;
                    $tmpStones[] = (string) $stoneB;
                } else {
                    $tmpStones[] = (string) ((int) $stone * 2024);
                }
            }
            $stones = $tmpStones;
        }

        return count($stones);
    }

    public function secondPart(): int
    {
        $solution = 0;
        $line = DataReader::readLine(11, $this->withExampleData)->current();
        $stones = explode(' ', $line);

        foreach ($stones as $stone) {
            $solution += $this->blink($stone, 75);
        }
        return $solution;
    }

    private function blink(string $stone, int $times): int
    {
        if ($times === 0) {
            return 1;
        }

        static $cache = [];
        if (isset($cache["$stone-$times"])) {
            return $cache["$stone-$times"];
        }

        if ($stone === '0') {
            $result = $this->blink('1', $times - 1);
        } elseif (strlen($stone) % 2 === 0) {
            $stoneA = substr($stone, 0, strlen($stone) / 2);
            $stoneB = (string) ((int) substr($stone, strlen($stone) / 2));
            $result = $this->blink($stoneA, $times - 1) + $this->blink($stoneB, $times - 1);
        } else {
            $result = $this->blink((string) ($stone * 2024), $times - 1);
        }

        $cache["$stone-$times"] = $result;

        return $result;
    }
}
