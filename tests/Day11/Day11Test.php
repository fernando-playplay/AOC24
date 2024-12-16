<?php

declare(strict_types=1);

namespace Tests\Day11;

use App\Day11\Day11;
use PHPUnit\Framework\TestCase;

final class Day11Test extends TestCase
{
    public function testItSolvesTheExamplePart1(): void
    {
        // Act & Assert
        $this->assertSame(55312, new Day11(withExampleData: true)->firstPart());
    }

    public function testItSolvesPart1(): void
    {
        // Act & Assert
        $this->assertSame(218956, new Day11()->firstPart());
    }

    public function testItSolvesPart2(): void
    {
        // Act & Assert
        $this->assertSame(259593838049805, new Day11()->secondPart());
    }
}
