<?php declare(strict_types=1);
final class Password
{
    private $password;

    private function __construct(string $password)
    {
        $this->ensureIsValidPassword($password);

        $this->password = $password;
    }

    public static function fromString(string $password): self
    {
        return new self($password);
    }

    public function __toString(): string
    {
        return $this->password;
    }

    private function ensureIsValidPassword(string $password): void
    {
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