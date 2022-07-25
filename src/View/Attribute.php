<?php

namespace WireUi\View;

use Illuminate\Support\{Collection, Str};

class Attribute
{
    public function __construct(
        private ?string $directive,
        private mixed $value = null,
    ) {
    }

    public function hasModifier(string $modifier): bool
    {
        return $this->modifiers()->contains($modifier);
    }

    public function modifiers(): Collection
    {
        return Str::of($this->directive)
            ->explode('.')
            ->filter()
            ->unique()
            ->skip(1)
            ->values();
    }

    public function directive(): ?string
    {
        return $this->directive;
    }

    public function name(): ?string
    {
        return Str::of($this->directive)->before('.');
    }

    public function value(): mixed
    {
        return $this->value;
    }

    public function exists(): bool
    {
        return (bool) $this->name();
    }
}
