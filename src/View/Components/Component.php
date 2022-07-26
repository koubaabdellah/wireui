<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;
use Illuminate\View;

abstract class Component extends View\Component
{
    protected function classes(array $classList): string
    {
        return Arr::toCssClasses($classList);
    }

    /**
     * This function will find the correct modifier for the given attributes
     * The default value is "default" if no matches are found
     * e.g. The sizes modifiers are: $sizes ['xs' => '...', ...]
     *      <x-button xs ... />  return "xs"
     *      <x-button ... />     return "default"
     */
    protected function findModifier(array $classes): string
    {
        unset($classes['default']);

        $modifiers = array_keys($classes);
        $matches   = $this->attributes->only($modifiers)->getAttributes();
        $modifier  = array_key_first($matches) ?? 'default';

        if ($modifier !== 'default') {
            $this->attributes->offsetUnset($modifier);
        }

        return $modifier;
    }

    protected function modifierClasses(?string $modifier, array $classes): ?string
    {
        $modifier ??= $this->findModifier($classes);

        return data_get($classes, $modifier);
    }
}
