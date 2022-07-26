<?php

namespace WireUi\View\Components;

use Closure;
use Illuminate\View\ComponentAttributeBag;
use WireUi\View\Attribute;

abstract class BaseButton extends Component
{
    public function __construct(
        public bool $rounded = false,
        public bool $squared = false,
        public bool $outline = false,
        public bool $flat = false,
        public bool $full = false,
        public bool $preventWireLoading = true,
        public ?string $color = null,
        public ?string $size = null,
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $rightIcon = null,
    ) {
    }

    public function render(): Closure
    {
        return function (array $data) {
            return view('wireui::button', $this->proccessData($data))->render();
        };
    }

    protected function proccessData(array $data): array
    {
        $this->mergeClasses();

        $spinner = $this->getSpinner();

        if (!$this->attributes->has('href') && !$this->attributes->has('type')) {
            $this->attributes->offsetSet('type', 'button');
        }

        if ($this->preventWireLoading) {
            $this->attributes->offsetSet('wire:loading.attr', 'disabled');
            $this->attributes->offsetSet('wire:loading.class', '!cursor-wait');
        }

        return array_merge($data, [
            'spinner'    => $spinner,
            'attributes' => $this->attributes,
            'disabled'   => (bool) $this->attributes->get('disabled'),
            'tag'        => $this->attributes->has('href') ? 'a' : 'button',
            'iconSize'   => $this->modifierClasses($this->size, $this->iconSizes()),
        ]);
    }

    private function getSpinner(): ?ComponentAttributeBag
    {
        /** @var Attribute $spinner */
        $spinner = $this->attributes->attribute('spinner');

        if (!$spinner->exists()) {
            return null;
        }

        $target  = $spinner->value();
        $loading = 'wire:loading';

        if ($delay = $spinner->modifiers()->first()) {
            $loading .= ".delay.{$delay}";
        }

        $spinnerAttributes = new ComponentAttributeBag([$loading => true]);

        if (is_string($target)) {
            $spinnerAttributes->offsetSet('wire:target', $target);
            $this->attributes->offsetSet('wire:target', $target);
        }

        $this->attributes->offsetUnset($spinner->directive());

        return $spinnerAttributes;
    }

    private function mergeClasses(): void
    {
        $this->attributes = $this->attributes->class([
            'outline-none inline-flex justify-center items-center group',
            'transition-all ease-in duration-150 focus:ring-2 focus:ring-offset-2',
            'hover:shadow-sm disabled:opacity-80 disabled:cursor-not-allowed',
            $this->modifierClasses($this->color, $this->currentColors()),
            $this->modifierClasses($this->size, $this->sizes()),
            'rounded-full' => !$this->squared && $this->rounded,
            'rounded'      => !$this->squared && !$this->rounded,
            'w-full'       => $this->full,
        ]);
    }

    private function currentColors(): array
    {
        if ($this->outline) {
            return $this->outlineColors();
        }

        if ($this->flat) {
            return $this->flatColors();
        }

        return $this->defaultColors();
    }

    abstract public function outlineColors(): array;

    abstract public function flatColors(): array;

    abstract public function defaultColors(): array;

    abstract public function sizes(): array;

    abstract public function iconSizes(): array;
}
