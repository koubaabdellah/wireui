<?php

namespace WireUi;

use WireUi\Support\{BladeDirectives, ComponentResolver};

class Wireui
{
    public function component(string $name): string
    {
        return (new static())->components()->resolve($name);
    }

    public function components(): ComponentResolver
    {
        return app(ComponentResolver::class);
    }

    public function directives(): BladeDirectives
    {
        return app(BladeDirectives::class);
    }
}
