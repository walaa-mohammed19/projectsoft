<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require "..\src\Login.php";

class LoginTest extends TestCase
{
    public function testCanBeFromValidLogin(): void
    {
        $this->assertInstanceOf(
            Login::class,
            Login::fromString('user@example.com','55ggdd')
        );
    }


}