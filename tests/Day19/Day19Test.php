<?php

declare(strict_types=1);

namespace Tests\Day19;

use App\Day19\Day19;
use PHPUnit\Framework\TestCase;

final class Day19Test extends TestCase
{
    public function testItSolvesTheExamplePart1(): void
    {
        // Act & Assert
        $this->assertSame(6, new Day19(withExampleData: true)->firstPart());
    }

    public function testItSolvesPart1(): void
    {
        // Act & Assert
        $this->assertSame(313, new Day19()->firstPart());
    }

    public function testItSolvesTheExamplePart2(): void
    {
        // Act & Assert
        $this->assertSame(16, new Day19(withExampleData: true)->secondPart());
    }

    public function testItSolvesPart2(): void
    {
        // Act & Assert
        $this->assertSame(666491493769758, new Day19()->secondPart());
    }
}
