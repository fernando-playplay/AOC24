<?php

declare(strict_types=1);

namespace App\Day3;

use App\AdventOfCodeProblem;
use App\Utils\DataReader;

final readonly class Day3 implements AdventOfCodeProblem
{
    public function __construct(
        private bool $withExampleData = false,
    ) {}

    public function firstPart(): int
    {
        $solution = 0;
        $lineGenerator = DataReader::readLine(3, $this->withExampleData);
        foreach ($lineGenerator as $line) {
            $values = [];
            preg_match_all('/mul\(\d+,\d+\)/', $line,$values, PREG_OFFSET_CAPTURE);
            $values = array_map(static fn (array $value) => $value[0], $values[0]);

            foreach ($values as $value) {
                $solution += array_product(
                    array_map(
                        static fn (string $val): int => (int) $val,
                        explode(',', rtrim(ltrim($value, 'mul('), ')')),
                    ),
                );
            }
        }

        return $solution;
    }

    public function secondPart(): int
    {
        $solution = 0;

        $wholeFuckingFileAsString = DataReader::readWholeFile(3, $this->withExampleData);

        $mulValuesAndPositions = [];
        preg_match_all('/mul\(\d{1,3},\d{1,3}\)/', $wholeFuckingFileAsString,$mulValuesAndPositions, PREG_OFFSET_CAPTURE);
        $mulValuesAndPositions = $mulValuesAndPositions[0];

        $dosAndDontsPositions = [];
        preg_match_all("/don't\(\)|do\(\)/", $wholeFuckingFileAsString,$dosAndDontsPositions, PREG_OFFSET_CAPTURE);
        $dosAndDontsPositions = $dosAndDontsPositions[0];

        $actualValuesAndPositions = [];
        foreach ($mulValuesAndPositions as $mulValueAndPosition) {
            $actualValuesAndPositions[$mulValueAndPosition[1]] =
                array_map(static fn (string $val): int => (int) $val, explode(',', rtrim(ltrim($mulValueAndPosition[0], 'mul('), ')')));
        }
        foreach ($dosAndDontsPositions as $dosAndDontsPosition) {
            $actualValuesAndPositions[$dosAndDontsPosition[1]] = $dosAndDontsPosition[0] === 'do()';
        }

        $isEnabled = true;
        ksort($actualValuesAndPositions);
        foreach ($actualValuesAndPositions as $value) {
            if (is_bool($value)) {
                $isEnabled = $value;
                continue;
            }

            if ($isEnabled && is_array($value)) {
                $solution += $value[0] * $value[1];
            }
        }

        return $solution;
    }
}
