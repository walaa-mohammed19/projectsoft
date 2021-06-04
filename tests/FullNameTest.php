<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class FullNameTest extends TestCase
{
    public function testCanBeValidFullName(): void
    {
        $this->assertInstanceOf(
            FullName::class,
            FullName::fromString('Mohammed')
        );
    }
}