<?php

use Illuminate\View\ComponentAttributeBag;

it('should parse the wire modifiers', function (string $attribute, $expected) {
    $bag = new ComponentAttributeBag([$attribute => 'name']);

    $this->assertSame($bag->wireModifiers(), $expected);
})->with([
    [
        'attribute' => 'wire:model.defer',
        'expected'  => [
            'defer'    => true,
            'lazy'     => false,
            'debounce' => [
                'exists' => false,
                'delay'  => '750',
            ],
        ],
    ],
    [
        'attribute' => 'wire:model.lazy',
        'expected'  => [
            'defer'    => false,
            'lazy'     => true,
            'debounce' => [
                'exists' => false,
                'delay'  => '750',
            ],
        ],
    ],
    [
        'attribute' => 'wire:model.debounce',
        'expected'  => [
            'defer'    => false,
            'lazy'     => false,
            'debounce' => [
                'exists' => true,
                'delay'  => '750',
            ],
        ],
    ],
    [
        'attribute' => 'wire:model.debounce.700',
        'expected'  => [
            'defer'    => false,
            'lazy'     => false,
            'debounce' => [
                'exists' => true,
                'delay'  => '700',
            ],
        ],
    ],
    [
        'attribute' => 'wire:model.debounce.700ms',
        'expected'  => [
            'defer'    => false,
            'lazy'     => false,
            'debounce' => [
                'exists' => true,
                'delay'  => '700',
            ],
        ],
    ],
]);
