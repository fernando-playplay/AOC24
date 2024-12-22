<?php

declare(strict_types=1);

namespace Tests\Day15;

use App\Day15\Day15;
use PHPUnit\Framework\TestCase;

final class Day15Test extends TestCase
{
    public function testItSolvesTheExamplePart1(): void
    {
        // Act & Assert
        $this->assertSame(10092, new Day15(withExampleData: true)->firstPart());
    }

    public function testItSolvesPart1(): void
    {
        // Act & Assert
        $this->assertSame(1475249, new Day15()->firstPart());
    }

    public function testItSolvesTheExamplePart2(): void
    {
        // Act & Assert
        $this->assertSame(9021, new Day15(withExampleData: true)->secondPart());
    }

    public function testItSolvesPart2(): void
    {
        // Act & Assert
        $this->assertGreaterThan(743123, new Day15()->secondPart());
        $this->assertSame(1509724, new Day15()->secondPart());
    }
}
