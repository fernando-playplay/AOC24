<?php

declare(strict_types=1);

namespace App\Day8;

use App\AdventOfCodeProblem;
use App\Utils\DataReader;

final readonly class Day8 implements AdventOfCodeProblem
{
    public function __construct(
        private bool $withExampleData = false,
    ) {}

    public function firstPart(): int
    {
        [$nbRows, $nbCols, $antennas] = $this->getAntennas();

        $uniqueAntinodes = [];
        foreach ($antennas as $first) {
            foreach ($antennas as $second) {
                if ($first === $second || $first['symbol'] !== $second['symbol']) {
                    continue;
                }

                $xDiff = $second['x'] - $first['x'];
                $yDiff = $second['y'] - $first['y'];

                $antiX = $second['x'] + $xDiff;
                $antiY = $second['y'] + $yDiff;

                if ($antiX < 0 || $antiY < 0 || $antiY >= $nbRows || $antiX >= $nbCols) {
                    continue;
                }

                $uniqueAntinodes[$antiX . '-' . $antiY] = true;
            }
        }

        return count($uniqueAntinodes);
    }

    public function secondPart(): int
    {
        [$nbRows, $nbCols, $antennas] = $this->getAntennas();

        $uniqueAntinodes = [];
        foreach ($antennas as $first) {
            foreach ($antennas as $second) {
                if ($first === $second || $first['symbol'] !== $second['symbol']) {
                    continue;
                }

                $xDiff = $second['x'] - $first['x'];
                $yDiff = $second['y'] - $first['y'];

                $antiX = $first['x'];
                $antiY = $first['y'];

                while (true) {
                    $antiX += $xDiff;
                    $antiY += $yDiff;

                    if ($antiX < 0 || $antiY < 0 || $antiY >= $nbRows || $antiX >= $nbCols) {
                        break;
                    }

                    $uniqueAntinodes[$antiX . '-' . $antiY] = true;
                }
            }
        }

        return count($uniqueAntinodes);
    }

    private function getAntennas(): array
    {
        $lineGenerator = DataReader::readLine(8, $this->withExampleData);
        $map = [];
        foreach ($lineGenerator as $line) {
            $map[] = $line;
        }

        $antennas = [];
        $nbRows = count($map);
        $nbCols = strlen($map[0]);
        foreach ($map as $y => $row) {
            foreach (str_split($row) as $x => $char) {
                if ($char === '.') {
                    continue;
                }

                $antennas[] = [
                    'symbol' => $char,
                    'x' => $x,
                    'y' => $y,
                ];
            }
        }

        return [$nbCols, $nbRows, $antennas];
    }
}
