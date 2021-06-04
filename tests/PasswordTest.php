<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class PasswordTest extends TestCase
{
    public function testCanBeValidPassword(): void
    {
        $this->assertInstanceOf(
            Password::class,
            Password::fromString('123gfg')
        );
    }
}