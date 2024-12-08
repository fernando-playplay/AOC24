<?php

declare(strict_types=1);

namespace App\Day5;

use App\AdventOfCodeProblem;
use App\Utils\DataReader;

final readonly class Day5 implements AdventOfCodeProblem
{
    public function __construct(
        private bool $withExampleData = false,
    ) {}

    public function firstPart(): int
    {
        $solution = 0;
        $lineGenerator = DataReader::readLine(5, $this->withExampleData);
        $ordering = [];
        $updates = [];
        $doPages = false;
        foreach ($lineGenerator as $line) {
            if ($line === '') {
                $doPages = true;
                continue;
            }
            if ($doPages) {
                $updates[] = array_map(static fn(string $val): int => (int) $val, explode(',', $line));
            } else {
                $order = explode('|', $line);
                $ordering[(int) $order[0]][] = (int) $order[1];
            }
        }

        foreach ($updates as $pages) {
            $sortedPages = $pages;
            usort($sortedPages, static fn(int $pageA, int $pageB): bool => in_array($pageA, $ordering[$pageB] ?? [], true));
            if ($sortedPages === $pages) {
                $solution += $pages[round((count($pages) - 1) / 2)];
            }
        }

        return $solution;
    }

    public function secondPart(): int
    {
        $solution = 0;
        $lineGenerator = DataReader::readLine(5, $this->withExampleData);
        $ordering = [];
        $updates = [];
        $doPages = false;
        foreach ($lineGenerator as $line) {
            if ($line === '') {
                $doPages = true;
                continue;
            }
            if ($doPages) {
                $updates[] = array_map(static fn(string $val): int => (int) $val, explode(',', $line));
            } else {
                $order = explode('|', $line);
                $ordering[(int) $order[0]][] = (int) $order[1];
            }
        }

        foreach ($updates as $pages) {
            $sortedPages = $pages;
            usort($sortedPages, static fn(int $pageA, int $pageB): bool => in_array($pageA, $ordering[$pageB] ?? [], true));
            if ($sortedPages !== $pages) {
                $solution += $sortedPages[round((count($sortedPages) - 1) / 2)];
            }
        }

        return $solution;
    }
}
