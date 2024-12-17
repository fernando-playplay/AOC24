<?php

declare(strict_types=1);

namespace Tests\Day12;

use App\Day12\Day12;
use PHPUnit\Framework\TestCase;

final class Day12Test extends TestCase
{
    public function testItSolvesTheExamplePart1(): void
    {
        // Act & Assert
        $this->assertSame(1930, new Day12(withExampleData: true)->firstPart());
    }

    public function testItSolvesPart1(): void
    {
        // Act & Assert
        $this->assertSame(1319878, new Day12()->firstPart());
    }

    public function testItSolvesTheExamplePart2(): void
    {
        // Act & Assert
        $this->assertSame(1206, new Day12(withExampleData: true)->secondPart());
    }

    public function testItSolvesPart2(): void
    {
        // Act & Assert
        $this->assertSame(784982, new Day12()->secondPart());
    }
}
