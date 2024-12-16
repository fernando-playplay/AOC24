<?php

declare(strict_types=1);

namespace Tests\Day10;

use App\Day10\Day10;
use PHPUnit\Framework\TestCase;

final class Day10Test extends TestCase
{
    public function testItSolvesTheExamplePart1(): void
    {
        // Act & Assert
        $this->assertSame(36, new Day10(withExampleData: true)->firstPart());
    }

    public function testItSolvesPart1(): void
    {
        // Act & Assert
        $this->assertSame(607, new Day10()->firstPart());
    }

    public function testItSolvesTheExamplePart2(): void
    {
        // Act & Assert
        $this->assertSame(81, new Day10(withExampleData: true)->secondPart());
    }

    public function testItSolvesPart2(): void
    {
        // Act & Assert
        $this->assertSame(1384, new Day10()->secondPart());
    }
}
