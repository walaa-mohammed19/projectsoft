<?php declare(strict_types=1);
final class FullName
{
    private $full_name;

    private function __construct(string $full_name)
    {
        $this->ensureIsValidFullName($full_name);

        $this->full_name = $full_name;
    }

    public static function fromString(string $full_name): self
    {
        return new self($full_name);
    }

    public function __toString(): string
    {
        return $this->full_name;
    }

    private function ensureIsValidFullName(string $full_name): void
    {
        if (preg_match('~[0-9]+~', $full_name)) {
            throw new InvalidArgumentException(
                sprintf(
                    '"%s" is not accepted Name',
                    $full_name
                )
            );
        }
    }
}