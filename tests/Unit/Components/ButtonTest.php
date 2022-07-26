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

it('should render the icon "house"', function () {
    $html = Blade::render('<x-button label="primary" icon="house" />');

    expect($html)->toContain('<svg');
});

it('should render the icon "alien" on right side', function () {
    $html = Blade::render('<x-button right-icon="alien" />');

    expect($html)->toContain('<svg');
});

it('should render the icon "house" on left side and the icon "alien" on right side', function () {
    $html = Blade::render('<x-button icon="house" right-icon="alien" />');

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

it('should render all components style variations', function () {
    $html = Blade::render(<<<BLADE
        <x-button label="Label" />
        <x-button primary label="primary" />
        <x-button secondary label="secondary" />
        <x-button positive label="positive" />
        <x-button negative label="negative" />
        <x-button warning label="warning" />
        <x-button info label="info" />
        <x-button dark label="dark" />

        <x-button rounded label="Label" />
        <x-button rounded primary label="primary" />
        <x-button rounded secondary label="secondary" />
        <x-button rounded positive label="positive" />
        <x-button rounded negative label="negative" />
        <x-button rounded warning label="warning" />
        <x-button rounded info label="info" />
        <x-button rounded dark label="dark" />

        <x-button squared label="Label" />
        <x-button squared primary label="primary" />
        <x-button squared secondary label="secondary" />
        <x-button squared positive label="positive" />
        <x-button squared negative label="negative" />
        <x-button squared warning label="warning" />
        <x-button squared info label="info" />
        <x-button squared dark label="dark" />

        <x-button flat label="Label" icon="house" />
        <x-button flat primary label="primary" icon="house" />
        <x-button flat secondary label="secondary" icon="house" />
        <x-button flat positive label="positive" icon="house" />
        <x-button flat negative label="negative" icon="house" />
        <x-button flat warning label="warning" icon="house" />
        <x-button flat info label="info" icon="house" />
        <x-button flat dark label="dark" icon="house" />

        <x-button outline label="Label" right-icon="house" />
        <x-button outline primary label="primary" right-icon="house" />
        <x-button outline secondary label="secondary" right-icon="house" />
        <x-button outline disabled positive label="positive" right-icon="house" />
        <x-button outline disabled negative label="negative" right-icon="house" />
        <x-button outline warning label="warning" right-icon="house" />
        <x-button outline info label="info" right-icon="house" />
        <x-button outline dark label="dark" right-icon="house" />
    BLADE);

    expect($html)->toContain('button', '<button', '</button>');
});
