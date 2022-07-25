<?php

namespace Tests\Browser\Button;

class ATagComponent extends \Livewire\Component
{
    public function render(): string
    {
        return <<<BLADE
        <div>
            <h1>Buttons test</h1>

            <x-button href="#0" label="Label" icon="house" />
            <x-button href="#1" primary label="primary" icon="house" />
            <x-button href="#2" secondary label="secondary" icon="house" />
            <x-button href="#3" disabled positive label="positive" icon="house" />
            <x-button href="#4" disabled negative label="negative" icon="house" />
            <x-button href="#5" warning label="warning" icon="house" />
            <x-button href="#6" info label="info" icon="house" />
            <x-button href="#7" dark label="dark" icon="house" />
        </div>
        BLADE;
    }
}
