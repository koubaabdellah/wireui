<?php

namespace Tests\Browser\Button;

class ButtonComponent extends \Livewire\Component
{
    public function render(): string
    {
        return <<<BLADE
        <div>
            <h1>Buttons test</h1>

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
        </div>
        BLADE;
    }
}
