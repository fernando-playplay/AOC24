<?php

declare(strict_types=1);

namespace Tests\Day3;

use App\Day3\Day3;
use PHPUnit\Framework\TestCase;

final class Day3Test extends TestCase
{
    public function testItSolvesTheExamplePart1(): void
    {
        // Act & Assert
        $this->assertSame(161, new Day3(withExampleData: true)->firstPart());
    }

    public function testItSolvesPart1(): void
    {
        // Act & Assert
        $this->assertSame(187194524, new Day3()->firstPart());
    }

    public function testItSolvesTheExamplePart2(): void
    {
        // Act & Assert
        $this->assertSame(48, new Day3(withExampleData: true)->secondPart());
    }

    public function testItSolvesPart2(): void
    {
        // Act
        $value = new Day3()->secondPart();

        // Assert
        $this->assertGreaterThan(19561285, $value);
        $this->assertNotSame(78085692, $value);
        $this->assertSame(127092535, $value);
        $this->assertLessThan(128670117, $value);
    }
}
