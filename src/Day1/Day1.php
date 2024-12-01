<?php

declare(strict_types=1);

namespace App\Day1;

use App\DataReader;

final readonly class Day1
{
    public function __construct(
        private bool $withExampleData = false,
    ) {}

    public function firstPart(): int
    {
        [$firstList, $secondList] = $this->makeSortedLists();

        $solution = 0;
        foreach ($firstList as $index => $valueFirstList) {
            $solution += abs($valueFirstList - $secondList[$index]);
        }

        return $solution;
    }

    public function secondPart(): int
    {
        [$firstList, $secondList] = $this->makeSortedLists();

        $solution = 0;
        $occurrences = array_count_values($firstList);
        foreach ($secondList as $value) {
            $solution += $value * ($occurrences[$value] ?? 0);
        }

        return $solution;
    }

    private function makeSortedLists(): array
    {
        $firstList = [];
        $secondList = [];

        $lineGenerator = DataReader::readLine(1, $this->withExampleData);
        foreach ($lineGenerator as $line) {
            $values = explode('   ', $line);
            $firstList[] = (int) $values[0];
            $secondList[] = (int) $values[1];
        }

        sort($firstList, SORT_NUMERIC);
        sort($secondList, SORT_NUMERIC);

        return [$firstList, $secondList];
    }

}
