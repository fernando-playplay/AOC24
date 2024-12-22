<?php

declare(strict_types=1);

namespace Tests\Day17;

use App\Day17\Day17;
use PHPUnit\Framework\TestCase;

final class Day17Test extends TestCase
{
    public function testItSolvesTheExamplePart1(): void
    {
        // Act & Assert
        $this->assertSame('4,6,3,5,6,3,5,2,1,0', new Day17(withExampleData: true)->firstPart());
    }

    public function testItSolvesPart1(): void
    {
        // Act & Assert
        $this->assertSame('7,5,4,3,4,5,3,4,6', new Day17()->firstPart());
    }

    public function testItSolvesTheExamplePart2(): void
    {
        // Act & Assert
        $this->assertSame(117440, new Day17(withExampleData: true)->secondPart());
    }

    public function testItSolvesPart2(): void
    {
        // Act & Assert
        $this->assertSame(164278899142333, new Day17()->secondPart());
    }
}
