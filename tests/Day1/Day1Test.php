<?php

declare(strict_types=1);

namespace Tests\Day1;

use App\Day1\Day1;
use PHPUnit\Framework\TestCase;

final class Day1Test extends TestCase
{
    public function testItSolvesTheExamplePart1(): void
    {
        // Act & Assert
        $this->assertSame(11, new Day1(withExampleData: true)->firstPart());
    }

    public function testItSolvesPart1(): void
    {
        // Act & Assert
        $this->assertSame(1388114, new Day1()->firstPart());
    }

    public function testItSolvesTheExamplePart2(): void
    {
        // Act & Assert
        $this->assertSame(31, new Day1(withExampleData: true)->secondPart());
    }

    public function testItSolvesPart2(): void
    {
        // Act & Assert
        $this->assertSame(23529853, new Day1()->secondPart());
    }
}
