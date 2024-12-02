<?php

declare(strict_types=1);

namespace Tests\Day2;

use App\Day2\Day2;
use PHPUnit\Framework\TestCase;

final class Day2Test extends TestCase
{
    public function testItSolvesTheExamplePart1(): void
    {
        // Act & Assert
        $this->assertSame(2, new Day2(withExampleData: true)->firstPart());
    }

    public function testItSolvesPart1(): void
    {
        // Act & Assert
        $this->assertSame(526, new Day2()->firstPart());
    }

    public function testItSolvesTheExamplePart2(): void
    {
        // Act & Assert
        $this->assertSame(4, new Day2(withExampleData: true)->secondPart());
    }

    public function testItSolvesPart2(): void
    {
        // Act & Assert
        $this->assertSame(566, new Day2()->secondPart());
    }
}
