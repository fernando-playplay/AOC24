<?php

declare(strict_types=1);

namespace Tests\Day16;

use App\Day16\Day16;
use PHPUnit\Framework\TestCase;

final class Day16Test extends TestCase
{
    public function testItSolvesTheExamplePart1(): void
    {
        // Act & Assert
        $this->assertSame(11048, new Day16(withExampleData: true)->firstPart());
    }

    public function testItSolvesPart1(): void
    {
        // Act & Assert
        $this->assertSame(102504, new Day16()->firstPart());
    }

    public function testItSolvesTheExamplePart2(): void
    {
        // Act & Assert
        $this->assertSame(64, new Day16(withExampleData: true)->secondPart());
    }

    public function testItSolvesPart2(): void
    {
        // Act & Assert
        $this->assertLessThan(537, new Day16()->secondPart());
        $this->assertSame(535, new Day16()->secondPart());
    }
}
