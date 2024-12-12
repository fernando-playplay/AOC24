<?php

declare(strict_types=1);

namespace Tests\Day8;

use App\Day8\Day8;
use PHPUnit\Framework\TestCase;

final class Day8Test extends TestCase
{
    public function testItSolvesTheExamplePart1(): void
    {
        // Act & Assert
        $this->assertSame(14, new Day8(withExampleData: true)->firstPart());
    }

    public function testItSolvesPart1(): void
    {
        // Act & Assert
        $this->assertSame(348, new Day8()->firstPart());
    }

    public function testItSolvesTheExamplePart2(): void
    {
        // Act & Assert
        $this->assertSame(34, new Day8(withExampleData: true)->secondPart());
    }

    public function testItSolvesPart2(): void
    {
        // Act & Assert
        $this->assertSame(1221, new Day8()->secondPart());
    }
}
