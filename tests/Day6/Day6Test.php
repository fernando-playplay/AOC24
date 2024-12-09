<?php

declare(strict_types=1);

namespace Tests\Day6;

use App\Day6\Day6;
use PHPUnit\Framework\TestCase;

final class Day6Test extends TestCase
{
    public function testItSolvesTheExamplePart1(): void
    {
        // Act & Assert
        $this->assertSame(41, new Day6(withExampleData: true)->firstPart());
    }

    public function testItSolvesPart1(): void
    {
        // Act & Assert
        $this->assertGreaterThan(4695, new Day6()->firstPart());
        $this->assertSame(4696, new Day6()->firstPart());
    }

    public function testItSolvesTheExamplePart2(): void
    {
        // Act & Assert
        $this->assertSame(6, new Day6(withExampleData: true)->secondPart());
    }

    public function testItSolvesPart2(): void
    {
        // Act & Assert
        $this->assertSame(1443, new Day6()->secondPart());
    }
}
