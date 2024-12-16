<?php

declare(strict_types=1);

namespace Tests\Day9;

use App\Day9\Day9;
use PHPUnit\Framework\TestCase;

final class Day9Test extends TestCase
{
    public function testItSolvesTheExamplePart1(): void
    {
        // Act & Assert
        $this->assertSame(1928, new Day9(withExampleData: true)->firstPart());
    }

    public function testItSolvesPart1(): void
    {
        // Act & Assert
        $this->assertSame(6288707484810, new Day9()->firstPart());
    }

    public function testItSolvesTheExamplePart2(): void
    {
        // Act & Assert
        $this->assertSame(2858, new Day9(withExampleData: true)->secondPart());
    }

    public function testItSolvesPart2(): void
    {
        // Act & Assert
        $this->assertGreaterThan(85576451767, new Day9()->secondPart());
        $this->assertGreaterThan(6288707484810, new Day9()->secondPart());
        $this->assertSame(6311837662089, new Day9()->secondPart());
    }
}
