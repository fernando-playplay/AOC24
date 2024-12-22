<?php

declare(strict_types=1);

namespace App\Day17;

use App\AdventOfCodeProblem;
use App\Utils\DataReader;

final readonly class Day17
{
    private const string PROGRAM_LABEL = 'Program: ';

    public function __construct(
        private bool $withExampleData = false,
    ) {}

    public function firstPart(): string
    {
        $lineGenerator = DataReader::readLine(17, $this->withExampleData);
        $program = [];
        $regA = 0;
        $regB = 0;
        $regC = 0;
        foreach ($lineGenerator as $line) {
            if (str_starts_with($line, 'Register A')) {
                $regA = (int) substr($line, strlen('Register A: '));
            } elseif (str_starts_with($line, 'Register B')) {
                $regB = (int) substr($line, strlen('Register B: '));
            } elseif (str_starts_with($line, 'Register C')) {
                $regC = (int) substr($line, strlen('Register C: '));
            } elseif (str_starts_with($line, self::PROGRAM_LABEL)) {
                $program = array_map(
                    static fn (string $v): int => (int) $v,
                    explode(',', substr($line, strlen(self::PROGRAM_LABEL))),
                );
            }
        }

        return $this->execute($regA, $regB, $regC, $program);
    }

    private function execute(int $regA, int $regB, int $regC, array $program): string
    {
        $solution = '';
        $comboOp = static function (int $operand) use (&$regA, &$regB, &$regC): int {
            return match ($operand) {
                0, 1, 2, 3 => $operand,
                4 => $regA,
                5 => $regB,
                6 => $regC,
                default => -1,
            };
        };

        $i = 0;
        while ($i < count($program)) {
            $op = $program[$i];
            $operand = $program[$i + 1];
            // switch is cool here because we can simplify continue/break logic
            switch ($op) {
                case 0: // adv = division
                    $regA = (int) ($regA / 2 ** $comboOp($operand));
                    break;
                case 1: // bxl = bitwise xor with operand
                    $regB ^= $operand;
                    break;
                case 2: // bst = $combo % 8
                    $regB = $comboOp($operand) % 8;
                    break;
                case 3: // jnz = nothing if $regA = 0, else jump to $operand value
                    if ($regA === 0) {
                        break;
                    }
                    $i = $operand;
                    continue 2;
                case 4: // bxc = bitwise xor with regC
                    $regB ^= $regC;
                    break;
                case 5: // out = combo % 8 separated by commas
                    $solution .= $comboOp($operand) % 8 . ',';
                    break;
                case 6: // bdv = same as adv but store in regB
                    $regB = (int) ($regA / 2 ** $comboOp($operand));
                    break;
                default: // cdv = same as adv but store in regC
                    $regC = (int) ($regA / 2 ** $comboOp($operand));
                    break;
            }
            $i += 2;
        }

        return  rtrim($solution, ',');
    }

    public function secondPart(): int
    {
        $lineGenerator = DataReader::readLine(17, $this->withExampleData);
        $program = [];
        foreach ($lineGenerator as $line) {
            if (str_starts_with($line, self::PROGRAM_LABEL)) {
                $program = array_map(
                    static fn (string $v): int => (int) $v,
                    explode(',', substr($line, strlen(self::PROGRAM_LABEL))),
                );
            }
        }

        return $this->outputItself($program);
    }

    // thx god for 64-bit integers!
    private function outputItself(array $program, int $regA = 0, int $index = 1): false|int {
        if ($index > count($program)) {
            return $regA;
        }

        for ($i = 0; $i < 8; $i++) {
            // we need to shift the register A by 8 * $i bits
            $tmpRegA = $regA * 8 + $i;
            $output = $this->execute($tmpRegA, 0, 0, $program);

            if ($output === implode(',', array_slice($program, -$index))) {
                $result = $this->outputItself($program, $tmpRegA, $index + 1);
                if ($result !== false) {
                    return $result;
                }
            }
        }

        return false;
    }
}
