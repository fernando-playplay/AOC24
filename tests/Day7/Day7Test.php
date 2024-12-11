<?php

declare(strict_types=1);

namespace Tests\Day7;

use App\Day7\Day7;
use PHPUnit\Framework\TestCase;

final class Day7Test extends TestCase
{
    public function testItSolvesTheExamplePart1(): void
    {
        // Act & Assert
        $this->assertSame(3749, new Day7(withExampleData: true)->firstPart());
    }

    public function testItSolvesPart1(): void
    {
        // Act & Assert
        $this->assertSame(5702958180383, new Day7()->firstPart());
    }

    public function testItSolvesTheExamplePart2(): void
    {
        // Act & Assert
        $this->assertSame(11387, new Day7(withExampleData: true)->secondPart());
    }

    public function testItSolvesPart2(): void
    {
        // Act & Assert
        $this->assertSame(92612386119138, new Day7()->secondPart());
    }
}
