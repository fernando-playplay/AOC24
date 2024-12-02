<?php

declare(strict_types=1);

namespace Tests\Day3;

use App\Day2\Day2;
use App\Day3\Day3;
use PHPUnit\Framework\TestCase;

final class Day3Test extends TestCase
{
    public function testItSolvesTheExamplePart1(): void
    {
        // Act & Assert
        $this->assertSame(0, new Day3(withExampleData: true)->firstPart());
    }

    public function testItSolvesPart1(): void
    {
        // Act & Assert
        $this->assertSame(0, new Day3()->firstPart());
    }

    public function testItSolvesTheExamplePart2(): void
    {
        // Act & Assert
        $this->assertSame(0, new Day3(withExampleData: true)->secondPart());
    }

    public function testItSolvesPart2(): void
    {
        // Act & Assert
        $this->assertSame(0, new Day3()->secondPart());
    }
}
