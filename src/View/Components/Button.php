<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;
use WireUi\Support\Buttons\Color;
use WireUi\View\Components\Buttons\Base;

class Button extends Base
{
    public function __construct(
        public bool $disableOnWireLoading = true,
        public bool $block = false,
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $rightIcon = null,
        public ?string $iconSize = null,
        public bool $rounded = false,
        public bool $squared = false,
        public bool $outline = false,
        public bool $flat = false,
        public ?string $color = null,
        public ?string $size = null,
    ) {
        parent::__construct(
            disableOnWireLoading: $disableOnWireLoading,
            label: $label,
            icon: $icon,
            rightIcon: $rightIcon,
            iconSize: $iconSize,
        );
    }

    protected function currentColors(): array
    {
        return match (true) {
            $this->outline => $this->outlineColors(),
            $this->flat    => $this->flatColors(),
            default        => $this->defaultColors(),
        };
    }

    protected function proccessData(array $data): array
    {
        return array_merge(parent::proccessData($data), [
            'iconSize' => $this->modifierClasses($this->size, $this->iconSizes()),
        ]);
    }

    protected function getCssClass(): string
    {
        return Arr::toCssClasses([
            $this->modifierClasses($this->color, $this->currentColors()),
            $this->modifierClasses($this->size, $this->sizes()),
            'outline-none inline-flex justify-center items-center group',
            'transition-all ease-in duration-150 focus:ring-2 focus:ring-offset-2',
            'hover:shadow-sm disabled:opacity-80 disabled:cursor-not-allowed',
            'rounded-full' => !$this->squared && $this->rounded,
            'rounded'      => !$this->squared && !$this->rounded,
            'w-full'       => $this->block,
        ]);
    }

    protected static function outlineColors(): array
    {
        $focus = 'focus:border-transparent dark:focus:border-transparent dark:focus:bg-slate-700 dark:focus:ring-offset-slate-800';
        $hover = 'dark:hover:bg-slate-700';

        return [
            'default' => new Color(
                base: 'border text-slate-500 dark:border-slate-500 dark:text-slate-400',
                hover: "{$hover} hover:bg-slate-100",
                focus: "{$focus} focus:ring-slate-200 dark:focus:ring-slate-600 focus:bg-slate-100",
            ),
            'primary' => new Color(
                base: 'text-primary-500 border border-primary-500',
                hover: "{$hover} hover:bg-primary-50",
                focus: "{$focus} focus:ring-primary-500 focus:bg-primary-50"
            ),
            'secondary' => new Color(
                base: 'border border-secondary-600 text-secondary-600 dark:border-secondary-400 dark:text-secondary-400',
                hover: "{$hover} hover:bg-secondary-100",
                focus: "{$focus} focus:ring-secondary-600 focus:bg-secondary-100",
            ),
            'positive' => new Color(
                base: 'text-positive-500 border border-positive-500',
                hover: "{$hover} hover:bg-positive-50",
                focus: "{$focus} focus:ring-positive-500 focus:bg-positive-50",
            ),
            'negative' => new Color(
                base: 'text-negative-500 border border-negative-500',
                hover: "{$hover} hover:bg-negative-50",
                focus: "{$focus} focus:ring-negative-500 focus:bg-negative-50",
            ),
            'warning' => new Color(
                base: 'text-warning-600 border border-warning-600',
                hover: "{$hover} hover:bg-warning-50",
                focus: "{$focus} focus:ring-warning-600 focus:bg-warning-50",
            ),
            'info' => new Color(
                base: 'text-info-600 border border-info-600',
                hover: "{$hover} hover:bg-info-50",
                focus: "{$focus} focus:ring-info-600 focus:bg-info-50",
            ),
            'dark' => new Color(
                base: 'text-slate-600 border border-slate-600 dark:text-slate-500 dark:border-slate-400 dark:text-slate-400',
                hover: "{$hover} hover:bg-slate-200",
                focus: "{$focus} focus:ring-slate-600 focus:bg-slate-200",
            ),
            'white' => new Color(
                base: 'border border-white text-white dark:border-slate-400 dark:text-slate-200',
                hover: "{$hover} hover:bg-slate-100",
                focus: "{$focus} focus:ring-slate-200 dark:focus:ring-slate-600 focus:bg-slate-100",
            ),
            'black' => new Color(
                base: 'border border-black text-black dark:border-slate-400 dark:text-slate-200',
                hover: "{$hover} hover:bg-slate-100",
                focus: "{$focus} focus:ring-black dark:focus:ring-slate-600 focus:bg-slate-100",
            ),
            'slate' => new Color(
                base: 'text-slate-600 border border-slate-600 dark:text-slate-400 dark:border-slate-400',
                hover: "{$hover} hover:bg-slate-100",
                focus: "{$focus} focus:ring-slate-600 focus:bg-slate-100",
            ),
            'gray' => new Color(
                base: 'text-gray-500 border border-gray-500 dark:text-gray-400 dark:border-gray-400',
                hover: "{$hover} hover:bg-gray-100",
                focus: "{$focus} focus:ring-gray-500 focus:bg-gray-100",
            ),
            'zinc' => new Color(
                base: 'text-zinc-500 border border-zinc-500 dark:text-zinc-400 dark:border-zinc-400',
                hover: "{$hover} hover:bg-zinc-100",
                focus: "{$focus} focus:ring-zinc-500 focus:bg-zinc-100",
            ),
            'neutral' => new Color(
                base: 'text-neutral-500 border border-neutral-500 dark:text-neutral-400 dark:border-neutral-400',
                hover: "{$hover} hover:bg-neutral-100",
                focus: "{$focus} focus:ring-neutral-500 focus:bg-neutral-100",
            ),
            'stone' => new Color(
                base: 'text-stone-500 border border-stone-500 dark:text-stone-400 dark:border-stone-400',
                hover: "{$hover} hover:bg-stone-100",
                focus: "{$focus} focus:ring-stone-500 focus:bg-stone-100",
            ),
            'red' => new Color(
                base: 'text-red-500 border border-red-500 dark:text-red-400 dark:border-red-400',
                hover: "{$hover} hover:bg-red-50",
                focus: "{$focus} focus:ring-red-500 focus:bg-red-50",
            ),
            'orange' => new Color(
                base: 'text-orange-500 border border-orange-500 dark:text-orange-400 dark:border-orange-400',
                hover: "{$hover} hover:bg-orange-50",
                focus: "{$focus} focus:ring-orange-500 focus:bg-orange-50",
            ),
            'amber' => new Color(
                base: 'text-amber-600 border border-amber-600 dark:text-amber-400 dark:border-amber-400',
                hover: "{$hover} hover:bg-amber-50",
                focus: "{$focus} focus:ring-amber-600 focus:bg-amber-50",
            ),
            'lime' => new Color(
                base: 'text-lime-500 border border-lime-500 dark:text-lime-400 dark:border-lime-400',
                hover: "{$hover} hover:bg-lime-50",
                focus: "{$focus} focus:ring-lime-500 focus:bg-lime-50",
            ),
            'green' => new Color(
                base: 'text-green-500 border border-green-500 dark:text-green-400 dark:border-green-400',
                hover: "{$hover} hover:bg-green-50",
                focus: "{$focus} focus:ring-green-500 focus:bg-green-50",
            ),
            'emerald' => new Color(
                base: 'text-emerald-500 border border-emerald-500 dark:text-emerald-400 dark:border-emerald-400',
                hover: "{$hover} hover:bg-emerald-50",
                focus: "{$focus} focus:ring-emerald-500 focus:bg-emerald-50",
            ),
            'teal' => new Color(
                base: 'text-teal-500 border border-teal-500 dark:text-teal-400 dark:border-teal-400',
                hover: "{$hover} hover:bg-teal-50",
                focus: "{$focus} focus:ring-teal-500 focus:bg-teal-50",
            ),
            'cyan' => new Color(
                base: 'text-cyan-500 border border-cyan-500 dark:text-cyan-400 dark:border-cyan-400',
                hover: "{$hover} hover:bg-cyan-50",
                focus: "{$focus} focus:ring-cyan-500 focus:bg-cyan-50",
            ),
            'sky' => new Color(
                base: 'text-sky-500 border border-sky-500 dark:text-sky-400 dark:border-sky-400',
                hover: "{$hover} hover:bg-sky-50",
                focus: "{$focus} focus:ring-sky-500 focus:bg-sky-50",
            ),
            'blue' => new Color(
                base: 'text-blue-500 border border-blue-500 dark:text-blue-400 dark:border-blue-400',
                hover: "{$hover} hover:bg-blue-50",
                focus: "{$focus} focus:ring-blue-500 focus:bg-blue-50",
            ),
            'indigo' => new Color(
                base: 'text-indigo-500 border border-indigo-500 dark:text-indigo-400 dark:border-indigo-400',
                hover: "{$hover} hover:bg-indigo-50",
                focus: "{$focus} focus:ring-indigo-500 focus:bg-indigo-50",
            ),
            'violet' => new Color(
                base: 'text-violet-500 border border-violet-500 dark:text-violet-400 dark:border-violet-400',
                hover: "{$hover} hover:bg-violet-50",
                focus: "{$focus} focus:ring-violet-500 focus:bg-violet-50",
            ),
            'purple' => new Color(
                base: 'text-purple-500 border border-purple-500 dark:text-purple-400 dark:border-purple-400',
                hover: "{$hover} hover:bg-purple-50",
                focus: "{$focus} focus:ring-purple-500 focus:bg-purple-50",
            ),
            'fuchsia' => new Color(
                base: 'text-fuchsia-500 border border-fuchsia-500 dark:text-fuchsia-400 dark:border-fuchsia-400',
                hover: "{$hover} hover:bg-fuchsia-50",
                focus: "{$focus} focus:ring-fuchsia-500 focus:bg-fuchsia-50",
            ),
            'pink' => new Color(
                base: 'text-pink-500 border border-pink-500 dark:text-pink-400 dark:border-pink-400',
                hover: "{$hover} hover:bg-pink-50",
                focus: "{$focus} focus:ring-pink-500 focus:bg-pink-50",
            ),
            'rose' => new Color(
                base: 'text-rose-500 border border-rose-500 dark:text-rose-400 dark:border-rose-400',
                hover: "{$hover} hover:bg-rose-50",
                focus: "{$focus} focus:ring-rose-500 focus:bg-rose-50",
            ),
        ];
    }

    protected static function flatColors(): array
    {
        $hover = 'dark:hover:bg-slate-700';
        $focus = 'dark:focus:bg-slate-700 dark:focus:ring-offset-slate-800';

        return [
            'default' => new Color(
                base: 'text-slate-500 dark:text-slate-400',
                hover: "{$hover} hover:bg-slate-100",
                focus: "{$focus} focus:bg-slate-100 focus:ring-slate-200 dark:focus:ring-slate-600",
            ),
            'primary' => new Color(
                base: 'text-primary-600',
                hover: "{$hover} hover:bg-primary-100",
                focus: "{$focus} focus:bg-primary-100 focus:ring-primary-600 dark:focus:ring-primary-700",
            ),
            'secondary' => new Color(
                base: 'text-secondary-600 dark:text-secondary-400',
                hover: "{$hover} hover:bg-secondary-100",
                focus: "{$focus} focus:bg-secondary-100 focus:ring-secondary-600 dark:focus:ring-secondary-700",
            ),
            'positive' => new Color(
                base: 'text-positive-600',
                hover: "{$hover} hover:bg-positive-100",
                focus: "{$focus} focus:bg-positive-100 focus:ring-positive-500 dark:focus:ring-positive-700",
            ),
            'negative' => new Color(
                base: 'text-negative-600',
                hover: "{$hover} hover:bg-negative-100",
                focus: "{$focus} focus:bg-negative-100 focus:ring-negative-600 dark:focus:ring-negative-700",
            ),
            'warning' => new Color(
                base: 'text-warning-600',
                hover: "{$hover} hover:bg-warning-100",
                focus: "{$focus} focus:bg-warning-100 focus:ring-warning-500 dark:focus:ring-warning-700",
            ),
            'info' => new Color(
                base: 'text-info-600',
                hover: "{$hover} hover:bg-info-100",
                focus: "{$focus} focus:bg-info-100 focus:ring-info-600 dark:focus:ring-info-700",
            ),
            'dark' => new Color(
                base: 'text-slate-900 dark:text-slate-400',
                hover: "{$hover} hover:bg-slate-200",
                focus: "{$focus} focus:bg-slate-200 focus:ring-slate-600 dark:focus:ring-dark-700",
            ),
            'white' => new Color(
                base: 'text-white dark:text-slate-300',
                hover: "{$hover} hover:bg-slate-100",
                focus: "{$focus} focus:bg-slate-100 focus:ring-slate-200 dark:focus:ring-slate-600",
            ),
            'black' => new Color(
                base: 'text-black dark:text-slate-300',
                hover: "{$hover} hover:bg-slate-100",
                focus: "{$focus} focus:bg-slate-100 focus:ring-black dark:focus:ring-slate-600",
            ),
            'slate' => new Color(
                base: 'text-slate-600 dark:text-slate-400',
                hover: "{$hover} hover:bg-slate-100",
                focus: "{$focus} focus:bg-slate-100 focus:ring-slate-500 dark:focus:ring-slate-700",
            ),
            'gray' => new Color(
                base: 'text-gray-600 dark:text-gray-400',
                hover: "{$hover} hover:bg-gray-100",
                focus: "{$focus} focus:bg-gray-100 focus:ring-gray-500 dark:focus:ring-gray-600",
            ),
            'zinc' => new Color(
                base: 'text-zinc-600 dark:text-zinc-400',
                hover: "{$hover} hover:bg-zinc-100",
                focus: "{$focus} focus:bg-zinc-100 focus:ring-zinc-500 dark:focus:ring-zinc-600",
            ),
            'neutral' => new Color(
                base: 'text-neutral-600 dark:text-neutral-400',
                hover: "{$hover} hover:bg-neutral-100",
                focus: "{$focus} focus:bg-neutral-100 focus:ring-neutral-500 dark:focus:ring-neutral-600",
            ),
            'stone' => new Color(
                base: 'text-stone-600 dark:text-stone-400',
                hover: "{$hover} hover:bg-stone-100",
                focus: "{$focus} focus:bg-stone-100 focus:ring-stone-500 dark:focus:ring-stone-600",
            ),
            'red' => new Color(
                base: 'text-red-600',
                hover: "{$hover} hover:bg-red-100",
                focus: "{$focus} focus:bg-red-100 focus:ring-red-600 dark:focus:ring-red-700",
            ),
            'orange' => new Color(
                base: 'text-orange-600',
                hover: "{$hover} hover:bg-orange-100",
                focus: "{$focus} focus:bg-orange-100 focus:ring-orange-600 dark:focus:ring-orange-700",
            ),
            'amber' => new Color(
                base: 'text-amber-600',
                hover: "{$hover} hover:bg-amber-100",
                focus: "{$focus} focus:bg-amber-100 focus:ring-amber-500 dark:focus:ring-amber-700",
            ),
            'lime' => new Color(
                base: 'text-lime-600',
                hover: "{$hover} hover:bg-lime-100",
                focus: "{$focus} focus:bg-lime-100 focus:ring-lime-600 dark:focus:ring-lime-700",
            ),
            'green' => new Color(
                base: 'text-green-600',
                hover: "{$hover} hover:bg-green-100",
                focus: "{$focus} focus:bg-green-100 focus:ring-green-600 dark:focus:ring-green-700",
            ),
            'emerald' => new Color(
                base: 'text-emerald-600',
                hover: "{$hover} hover:bg-emerald-100",
                focus: "{$focus} focus:bg-emerald-100 focus:ring-emerald-600 dark:focus:ring-emerald-700",
            ),
            'teal' => new Color(
                base: 'text-teal-600',
                hover: "{$hover} hover:bg-teal-100",
                focus: "{$focus} focus:bg-teal-100 focus:ring-teal-600 dark:focus:ring-teal-700",
            ),
            'cyan' => new Color(
                base: 'text-cyan-600',
                hover: "{$hover} hover:bg-cyan-100",
                focus: "{$focus} focus:bg-cyan-100 focus:ring-cyan-600 dark:focus:ring-cyan-700",
            ),
            'sky' => new Color(
                base: 'text-sky-600',
                hover: "{$hover} hover:bg-sky-100",
                focus: "{$focus} focus:bg-sky-100 focus:ring-sky-600 dark:focus:ring-sky-700",
            ),
            'blue' => new Color(
                base: 'text-blue-600',
                hover: "{$hover} hover:bg-blue-100",
                focus: "{$focus} focus:bg-blue-100 focus:ring-blue-600 dark:focus:ring-blue-700",
            ),
            'indigo' => new Color(
                base: 'text-indigo-600',
                hover: "{$hover} hover:bg-indigo-100",
                focus: "{$focus} focus:bg-indigo-100 focus:ring-indigo-600 dark:focus:ring-indigo-700",
            ),
            'violet' => new Color(
                base: 'text-violet-600',
                hover: "{$hover} hover:bg-violet-100",
                focus: "{$focus} focus:bg-violet-100 focus:ring-violet-600 dark:focus:ring-violet-700",
            ),
            'purple' => new Color(
                base: 'text-purple-600',
                hover: "{$hover} hover:bg-purple-100",
                focus: "{$focus} focus:bg-purple-100 focus:ring-purple-600 dark:focus:ring-purple-700",
            ),
            'fuchsia' => new Color(
                base: 'text-fuchsia-600',
                hover: "{$hover} hover:bg-fuchsia-100",
                focus: "{$focus} focus:bg-fuchsia-100 focus:ring-fuchsia-600 dark:focus:ring-fuchsia-700",
            ),
            'pink' => new Color(
                base: 'text-pink-600',
                hover: "{$hover} hover:bg-pink-100",
                focus: "{$focus} focus:bg-pink-100 focus:ring-pink-600 dark:focus:ring-pink-700",
            ),
            'rose' => new Color(
                base: 'text-rose-600',
                hover: "{$hover} hover:bg-rose-100",
                focus: "{$focus} focus:bg-rose-100 focus:ring-rose-600 dark:focus:ring-rose-700",
            ),
        ];
    }

    protected static function defaultColors(): array
    {
        $focus = 'dark:focus:ring-offset-slate-800';

        return [
            'default' => new Color(
                base: 'border text-slate-500 dark:border-slate-500 dark:text-slate-400',
                hover: 'hover:bg-slate-100 dark:hover:bg-slate-700',
                focus: "{$focus} focus:ring-slate-200 dark:focus:ring-slate-600",
            ),
            'primary' => new Color(
                base: 'text-white bg-primary-500 dark:bg-primary-700',
                hover: 'hover:bg-primary-600 hover:focus:ring-primary-600 dark:hover:bg-primary-600 dark:hover:focus:ring-primary-600',
                focus: "{$focus} focus:ring-primary-500 dark:focus:ring-primary-700",
            ),
            'secondary' => new Color(
                base: 'text-white bg-secondary-500 dark:bg-secondary-700',
                hover: 'hover:bg-secondary-600 hover:focus:ring-secondary-600 dark:hover:bg-secondary-600 dark:hover:focus:ring-secondary-600',
                focus: "{$focus} focus:ring-secondary-500 dark:focus:ring-secondary-700",
            ),
            'positive' => new Color(
                base: 'text-white bg-positive-500 dark:bg-positive-700',
                hover: 'hover:bg-positive-600 hover:focus:ring-positive-600 dark:hover:bg-positive-600 dark:hover:focus:ring-positive-600',
                focus: "{$focus} focus:ring-positive-500 dark:focus:ring-positive-700",
            ),
            'negative' => new Color(
                base: 'text-white bg-negative-500 dark:bg-negative-700',
                hover: 'hover:bg-negative-600 hover:focus:ring-negative-600 dark:hover:bg-negative-600 dark:hover:focus:ring-negative-600',
                focus: "{$focus} focus:ring-negative-500 dark:focus:ring-negative-700",
            ),
            'warning' => new Color(
                base: 'text-white bg-warning-500 dark:bg-warning-700',
                hover: 'hover:bg-warning-600 hover:focus:ring-warning-600 dark:hover:bg-warning-600 dark:hover:focus:ring-warning-600',
                focus: "{$focus} focus:ring-warning-500 dark:focus:ring-warning-700",
            ),
            'info' => new Color(
                base: 'text-white bg-info-500 dark:bg-info-700',
                hover: 'hover:bg-info-600 hover:focus:ring-info-600 dark:hover:bg-info-600 dark:hover:focus:ring-info-600',
                focus: "{$focus} focus:ring-info-500 dark:focus:ring-info-700",
            ),
            'dark' => new Color(
                base: 'text-white bg-gray-700 dark:bg-gray-700',
                hover: 'hover:bg-gray-900 hover:focus:ring-gray-900 dark:hover:bg-gray-600 dark:hover:focus:ring-gray-600',
                focus: "{$focus} focus:ring-gray-700 dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800",
            ),
            'white' => new Color(
                base: 'bg-white border text-slate-500 dark:text-slate-200 dark:border-slate-700 dark:bg-slate-700',
                hover: 'hover:bg-slate-50 dark:hover:bg-slate-600 dark:hover:focus:ring-slate-600',
                focus: "{$focus} focus:ring-slate-200 dark:focus:ring-slate-700",
            ),
            'black' => new Color(
                base: 'bg-black text-slate-100 dark:border-slate-700 dark:bg-slate-700',
                hover: 'hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:focus:ring-slate-600',
                focus: "{$focus} focus:ring-black dark:focus:ring-slate-700",
            ),
            'slate' => new Color(
                base: 'text-white bg-slate-500 dark:bg-slate-700',
                hover: 'hover:bg-slate-600 hover:focus:ring-slate-600 dark:hover:bg-slate-600 dark:hover:focus:ring-slate-600',
                focus: "{$focus} focus:ring-slate-500 dark:focus:ring-slate-700",
            ),
            'gray' => new Color(
                base: 'text-white bg-gray-500 dark:bg-gray-700',
                hover: 'hover:bg-gray-600 hover:focus:ring-gray-600 dark:hover:bg-gray-600 dark:hover:focus:ring-gray-600',
                focus: "{$focus} focus:ring-gray-500 dark:focus:ring-gray-700",
            ),
            'zinc' => new Color(
                base: 'text-white bg-zinc-500 dark:bg-zinc-700',
                hover: 'hover:bg-zinc-600 hover:focus:ring-zinc-600 dark:hover:bg-zinc-600 dark:hover:focus:ring-zinc-600',
                focus: "{$focus} focus:ring-zinc-500 dark:focus:ring-zinc-700",
            ),
            'neutral' => new Color(
                base: 'text-white bg-neutral-500 dark:bg-neutral-700',
                hover: 'hover:bg-neutral-600 hover:focus:ring-neutral-600 dark:hover:bg-neutral-600 dark:hover:focus:ring-neutral-600',
                focus: "{$focus} focus:ring-neutral-500 dark:focus:ring-neutral-700",
            ),
            'stone' => new Color(
                base: 'text-white bg-stone-500 dark:bg-stone-700',
                hover: 'hover:bg-stone-600 hover:focus:ring-stone-600 dark:hover:bg-stone-600 dark:hover:focus:ring-stone-600',
                focus: "{$focus} focus:ring-stone-500 dark:focus:ring-stone-700",
            ),
            'red' => new Color(
                base: 'text-white bg-red-500 dark:bg-red-700',
                hover: 'hover:bg-red-600 hover:focus:ring-red-600 dark:hover:bg-red-600 dark:hover:focus:ring-red-600',
                focus: "{$focus} focus:ring-red-500 dark:focus:ring-red-700",
            ),
            'orange' => new Color(
                base: 'text-white bg-orange-500 dark:bg-orange-700',
                hover: 'hover:bg-orange-600 hover:focus:ring-orange-600 dark:hover:bg-orange-600 dark:hover:focus:ring-orange-600',
                focus: "{$focus} focus:ring-orange-500 dark:focus:ring-orange-700",
            ),
            'amber' => new Color(
                base: 'text-white bg-amber-500 dark:bg-amber-700',
                hover: 'hover:bg-amber-600 hover:focus:ring-amber-600 dark:hover:bg-amber-600 dark:hover:focus:ring-amber-600',
                focus: "{$focus} focus:ring-amber-500 dark:focus:ring-amber-700",
            ),
            'lime' => new Color(
                base: 'text-white bg-lime-500 dark:bg-lime-700',
                hover: 'hover:bg-lime-600 hover:focus:ring-lime-600 dark:hover:bg-lime-600 dark:hover:focus:ring-lime-600',
                focus: "{$focus} focus:ring-lime-500 dark:focus:ring-lime-700",
            ),
            'green' => new Color(
                base: 'text-white bg-green-500 dark:bg-green-700',
                hover: 'hover:bg-green-600 hover:focus:ring-green-600 dark:hover:bg-green-600 dark:hover:focus:ring-green-600',
                focus: "{$focus} focus:ring-green-500 dark:focus:ring-green-700",
            ),
            'emerald' => new Color(
                base: 'text-white bg-emerald-500 dark:bg-emerald-700',
                hover: 'hover:bg-emerald-600 hover:focus:ring-emerald-600 dark:hover:bg-emerald-600 dark:hover:focus:ring-emerald-600',
                focus: "{$focus} focus:ring-emerald-500 dark:focus:ring-emerald-700",
            ),
            'teal' => new Color(
                base: 'text-white bg-teal-500 dark:bg-teal-700',
                hover: 'hover:bg-teal-600 hover:focus:ring-teal-600 dark:hover:bg-teal-600 dark:hover:focus:ring-teal-600',
                focus: "{$focus} focus:ring-teal-500 dark:focus:ring-teal-700",
            ),
            'cyan' => new Color(
                base: 'text-white bg-cyan-500 dark:bg-cyan-700',
                hover: 'hover:bg-cyan-600 hover:focus:ring-cyan-600 dark:hover:bg-cyan-600 dark:hover:focus:ring-cyan-600',
                focus: "{$focus} focus:ring-cyan-500 dark:focus:ring-cyan-700",
            ),
            'sky' => new Color(
                base: 'text-white bg-sky-500 dark:bg-sky-700',
                hover: 'hover:bg-sky-600 hover:focus:ring-sky-600 dark:hover:bg-sky-600 dark:hover:focus:ring-sky-600',
                focus: "{$focus} focus:ring-sky-500 dark:focus:ring-sky-700",
            ),
            'blue' => new Color(
                base: 'text-white bg-blue-500 dark:bg-blue-700',
                hover: 'hover:bg-blue-600 hover:focus:ring-blue-600 dark:hover:bg-blue-600 dark:hover:focus:ring-blue-600',
                focus: "{$focus} focus:ring-blue-500 dark:focus:ring-blue-700",
            ),
            'indigo' => new Color(
                base: 'text-white bg-indigo-500 dark:bg-indigo-700',
                hover: 'hover:bg-indigo-600 hover:focus:ring-indigo-600 dark:hover:bg-indigo-600 dark:hover:focus:ring-indigo-600',
                focus: "{$focus} focus:ring-indigo-500 dark:focus:ring-indigo-700",
            ),
            'violet' => new Color(
                base: 'text-white bg-violet-500 dark:bg-violet-700',
                hover: 'hover:bg-violet-600 hover:focus:ring-violet-600 dark:hover:bg-violet-600 dark:hover:focus:ring-violet-600',
                focus: "{$focus} focus:ring-violet-500 dark:focus:ring-violet-700",
            ),
            'purple' => new Color(
                base: 'text-white bg-purple-500 dark:bg-purple-700',
                hover: 'hover:bg-purple-600 hover:focus:ring-purple-600 dark:hover:bg-purple-600 dark:hover:focus:ring-purple-600',
                focus: "{$focus} focus:ring-purple-500 dark:focus:ring-purple-700",
            ),
            'fuchsia' => new Color(
                base: 'text-white bg-fuchsia-500 dark:bg-fuchsia-700',
                hover: 'hover:bg-fuchsia-600 hover:focus:ring-fuchsia-600 dark:hover:bg-fuchsia-600 dark:hover:focus:ring-fuchsia-600',
                focus: "{$focus} focus:ring-fuchsia-500 dark:focus:ring-fuchsia-700",
            ),
            'pink' => new Color(
                base: 'text-white bg-pink-500 dark:bg-pink-700',
                hover: 'hover:bg-pink-600 hover:focus:ring-pink-600 dark:hover:bg-pink-600 dark:hover:focus:ring-pink-600',
                focus: "{$focus} focus:ring-pink-500 dark:focus:ring-pink-700",
            ),
            'rose' => new Color(
                base: 'text-white bg-rose-500 dark:bg-rose-700',
                hover: 'hover:bg-rose-600 hover:focus:ring-rose-600 dark:hover:bg-rose-600 dark:hover:focus:ring-rose-600',
                focus: "{$focus} focus:ring-rose-500 dark:focus:ring-rose-700",
            ),
        ];
    }

    protected static function sizes(): array
    {
        return [
            '2xs'     => 'gap-x-0.5 text-2xs px-2 py-0.5',
            'xs'      => 'gap-x-1 text-xs px-2.5 py-1.5',
            'sm'      => 'gap-x-2 text-sm leading-4 px-3 py-2',
            'default' => 'gap-x-2 text-sm px-4 py-2',
            'md'      => 'gap-x-2 text-base px-4 py-2',
            'lg'      => 'gap-x-2 text-base px-6 py-3',
            'xl'      => 'gap-x-3 text-base px-7 py-4',
        ];
    }

    protected static function iconSizes(): array
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
