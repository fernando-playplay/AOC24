<?php

declare(strict_types=1);

namespace Tests\Day18;

use App\Day18\Day18;
use PHPUnit\Framework\TestCase;

final class Day18Test extends TestCase
{
    public function testItSolvesTheExamplePart1(): void
    {
        // Act & Assert
        $this->assertSame(22, new Day18(withExampleData: true)->firstPart());
    }

    public function testItSolvesPart1(): void
    {
        // Act & Assert
        $this->assertSame(226, new Day18()->firstPart());
    }

    public function testItSolvesTheExamplePart2(): void
    {
        // Act & Assert
        $this->assertSame('6,1', new Day18(withExampleData: true)->secondPart());
    }

    public function testItSolvesPart2(): void
    {
        // Act & Assert
        $this->assertSame('60,46', new Day18()->secondPart());
    }
}
