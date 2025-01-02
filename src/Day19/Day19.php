<?php

declare(strict_types=1);

namespace App\Day19;

use App\AdventOfCodeProblem;
use App\Utils\DataReader;

final class Day19 implements AdventOfCodeProblem
{
    public function __construct(
        private readonly bool $withExampleData = false,
        private array $cache = [],
    ) {}

    public function firstPart(): int
    {
        $solution = 0;
        $lineGenerator = DataReader::readLine(19, $this->withExampleData);
        $towelPatterns = '/^(' . implode('|', explode(', ', $lineGenerator->current())) . ')*$/';

        $lineGenerator->next();
        $lineGenerator->next();
        while ($lineGenerator->valid()) {
            $line = $lineGenerator->current();
            preg_match_all($towelPatterns, $line, $matches);
            $matches = array_map(static fn (string $val): int => (int) $val, $matches[0]);
            $solution += count($matches);
            $lineGenerator->next();
        }

        return $solution;
    }

    public function secondPart(): int
    {
        $solution = 0;
        $lineGenerator = DataReader::readLine(19, $this->withExampleData);
        $towelPatterns = explode(', ', $lineGenerator->current());
        $lineGenerator->next();
        $lineGenerator->next();

        // sorting the patterns by length makes for a better cache
        usort($towelPatterns, static fn(string $a, string $b): int => strlen($b) - strlen($a));

        while ($lineGenerator->valid()) {
            $line = $lineGenerator->current();
            $solution += $this->checkDesign($line, $towelPatterns);
            $lineGenerator->next();
        }

        return $solution;
    }

    private function checkDesign(string $design, array $towelPatterns): int
    {
        if ($design === '') {
            return 1;
        }

        if (isset($this->cache[$design])) {
            return $this->cache[$design];
        }

        $result = 0;
        foreach ($towelPatterns as $pattern) {
            if (str_starts_with($design, $pattern)) {
                $result += $this->checkDesign(substr($design, strlen($pattern)), $towelPatterns);
            }
        }

        $this->cache[$design] = $result;
        return $result;
    }
}
