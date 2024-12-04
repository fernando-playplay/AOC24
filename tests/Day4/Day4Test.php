<?php

declare(strict_types=1);

namespace Tests\Day4;

use App\Day4\Day4;
use PHPUnit\Framework\TestCase;

final class Day4Test extends TestCase
{
    public function testItSolvesTheExamplePart1(): void
    {
        // Act & Assert
        $this->assertSame(18, new Day4(withExampleData: true)->firstPart());
    }

    public function testItSolvesPart1(): void
    {
        // Act & Assert
        $this->assertSame(2458, new Day4()->firstPart());
    }

    public function testItSolvesTheExamplePart2(): void
    {
        // Act & Assert
        $this->assertSame(9, new Day4(withExampleData: true)->secondPart());
    }

    public function testItSolvesPart2(): void
    {
        // Act & Assert
        $this->assertSame(1945, new Day4()->secondPart());
    }
}
