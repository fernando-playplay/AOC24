<?php

declare(strict_types=1);

namespace Tests\Day13;

use App\Day13\Day13;
use PHPUnit\Framework\TestCase;

final class Day13Test extends TestCase
{
    public function testItSolvesTheExamplePart1(): void
    {
        // Act & Assert
        $this->assertSame(480, new Day13(withExampleData: true)->firstPart());
    }

    public function testItSolvesPart1(): void
    {
        // Act & Assert
        $this->assertSame(39748, new Day13()->firstPart());
    }

    public function testItSolvesTheExamplePart2(): void
    {
        // Act & Assert
        $this->assertSame(875318608908, new Day13(withExampleData: true)->secondPart());
    }

    public function testItSolvesPart2(): void
    {
        // Act & Assert
        $this->assertSame(74478585072604, new Day13()->secondPart());
    }
}
