<?php

declare(strict_types=1);

namespace Tests\Day5;

use App\Day5\Day5;
use PHPUnit\Framework\TestCase;

final class Day5Test extends TestCase
{
    public function testItSolvesTheExamplePart1(): void
    {
        // Act & Assert
        $this->assertSame(0, new Day5(withExampleData: true)->firstPart());
    }

    public function testItSolvesPart1(): void
    {
        // Act & Assert
        $this->assertSame(0, new Day5()->firstPart());
    }

    public function testItSolvesTheExamplePart2(): void
    {
        // Act & Assert
        $this->assertSame(0, new Day5(withExampleData: true)->secondPart());
    }

    public function testItSolvesPart2(): void
    {
        // Act & Assert
        $this->assertSame(0, new Day5()->secondPart());
    }
}
