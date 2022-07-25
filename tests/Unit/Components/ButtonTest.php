<?php

use Illuminate\Support\Facades\Blade;

it('should render the button slot', function () {
    $html = Blade::render('<x-button><b>Label From Slot</b></x-button>');

    expect($html)
        ->toContain('<b>Label From Slot</b>')
        ->toContain('<button')
        ->toContain('</button>')
        ->not()->toContain('svg');
});

it('should render the button label', function () {
    $html = Blade::render('<x-button label="Save Info" />');

    expect($html)->toContain('Save Info');
});

it('should render the spinner', function () {
    $html = Blade::render('<x-button primary label="primary" spinner />');

    expect($html)->toContain('<svg class="animate-spin');
});

it('should render the spinner with a method', function () {
    $html = Blade::render('<x-button primary label="primary" spinner="save" />');

    expect($html)
        ->toContain('<svg class="animate-spin')
        ->toContain('wire:target="save"');
});

it('should render the spinner with a method and a custom loading delay', function () {
    $html = Blade::render('<x-button primary label="primary" spinner.long="save" />');

    expect($html)
        ->toContain('<svg class="animate-spin')
        ->toContain('wire:target="save"')
        ->toContain('wire:loading.delay.long');
});

it('should render the icon house', function () {
    $html = Blade::render('<x-button label="primary" icon="house" />');

    expect($html)->toContain('<svg');
});

it('should render as tag "a" with href', function () {
    $html = Blade::render('<x-button href="https://livewire-wireui.com" />');

    expect($html)
        ->toContain('<a')
        ->toContain('</a>')
        ->not()->toContain('<button')
        ->not()->toContain('</button>')
        ->toContain('href="https://livewire-wireui.com"');
});

it('should render all default attributes', function () {
    $html = Blade::render('<x-button label="primary" />');

    expect($html)
        ->toContain('wire:loading.attr="disabled"')
        ->toContain('wire:loading.class="!cursor-wait"')
        ->not()->toContain('wire:target');
});
