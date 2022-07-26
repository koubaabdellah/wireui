<?php

namespace WireUi\View\Components;

use Closure;

class CircleButton extends Button
{
    public function __construct(
        public bool $outline = false,
        public bool $flat = false,
        public bool $preventWireLoading = true,
        public ?string $color = null,
        public ?string $size = null,
        public ?string $label = null,
        public ?string $icon = null,
    ) {
        parent::__construct(
            rounded: true,
            squared: false,
            outline: $outline,
            flat: $flat,
            full: false,
            preventWireLoading: $preventWireLoading,
            color: $color,
            size: $size,
            label: $label,
            icon: $icon,
            rightIcon: null,
        );
    }

    public function render(): Closure
    {
        return function (array $data) {
            return view('wireui::circle-button', $this->proccessData($data))->render();
        };
    }

    protected function proccessData(array $data): array
    {
        $data = array_merge(parent::proccessData($data), [
            'wireLoadingAttribute' => null,
        ]);

        if ($spinner = $data['spinner']) {
            $delay = $spinner->attribute('wire:loading')->modifiers()->last();

            $data['wireLoadingAttribute'] = 'wire:loading.remove';

            if ($delay && $delay !== 'remove') {
                $data['wireLoadingAttribute'] .= ".delay.{$delay}";
            }
        }

        return $data;
    }

    public function sizes(): array
    {
        return [
            '2xs'     => 'w-5 h-5',
            'xs'      => 'w-7 h-7',
            'sm'      => 'w-8 h-8',
            'default' => 'w-9 h-9',
            'md'      => 'w-10 h-10',
            'lg'      => 'w-12 h-12',
            'xl'      => 'w-14 h-14',
        ];
    }

    public function iconSizes(): array
    {
        return [
            '2xs'     => 'w-2 h-2',
            'xs'      => 'w-3 h-3',
            'sm'      => 'w-3.5 h-3.5',
            'default' => 'w-4 h-4',
            'md'      => 'w-4 h-4',
            'lg'      => 'w-5 h-5',
            'xl'      => 'w-6 h-6',
        ];
    }
}
