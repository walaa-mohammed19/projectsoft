<?php declare(strict_types=1);

require_once "connection.php";

/**
 * Class Login
 */
final class Login
{
    private $email;
    private $password;

    private function __construct(string $email,string $password)
    {
        $this->ensureIsValidLogin($email,$password);

        $this->email = $email;

        $this->password = $password;
    }

    public static function fromString(string $email,string $password): self
    {
        return new self($email,$password);

    }

    public function __toString(): string
    {
        return $this->email;
    }
    public function _toString(): string
    {
        return $this->password;
    }

    private function ensureIsValidLogin(string $email,string $password): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                sprintf(
                    '"%s" is not a valid email address',
                    $email
                )
            );
        }
        if ( strlen( $password ) <= 4) {
            throw new InvalidArgumentException(
                sprintf(
                    '"%s" is short not accepted password',
                    $password
                )
            );
        }

        if ( strlen( $password ) > 30) {
            throw new InvalidArgumentException(
                sprintf(
                    '"%s" is too long not accepted password',
                    $password
                )
            );
        }
    }

}