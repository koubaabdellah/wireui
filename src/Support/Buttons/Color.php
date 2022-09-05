<?php

namespace WireUi\Support\Buttons;

use Illuminate\Support\Arr;
use Stringable;

class Color implements Stringable
{
    public function __construct(
        readonly private string|array $base = '',
        readonly private string|array $hover = '',
        readonly private string|array $focus = '',
    ) {
    }

    public function toString(): string
    {
        return Arr::toRecursiveCssClasses([
            $this->base,
            $this->hover,
            $this->focus,
        ]);
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
