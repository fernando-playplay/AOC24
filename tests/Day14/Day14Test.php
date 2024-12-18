<?php

declare(strict_types=1);

namespace Tests\Day14;

use App\Day14\Day14;
use PHPUnit\Framework\TestCase;

final class Day14Test extends TestCase
{
    public function testItSolvesTheExamplePart1(): void
    {
        // Act & Assert
        $this->assertSame(12, new Day14(withExampleData: true)->firstPart());
    }

    public function testItSolvesPart1(): void
    {
        // Act & Assert
        $this->assertSame(222901875, new Day14()->firstPart());
    }

    public function testItSolvesPart2(): void
    {
        // Act & Assert
        $this->assertSame(6243, new Day14()->secondPart());
    }
}
