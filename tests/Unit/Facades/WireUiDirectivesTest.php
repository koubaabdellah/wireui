<?php

use Illuminate\Support\Facades\Blade;

it('should create the confirm action expression without livewire', function () {
    $html = <<<HTML
        <button @confirmAction({
            title: 'Sure to Delete?',
            icon: 'warning',
        })>
            Action
        </button>
    HTML;

    $rendered = Blade::render($html);

    expect($rendered)->toBe(<<<HTML
    <button onclick="\$wireui.confirmAction({
            title: 'Sure to Delete?',
            icon: 'warning',
        }, null)">
            Action
        </button>
    HTML);
});

it('should create the confirm action expression with livewire', function () {
    $html = <<<HTML
        <button @confirmAction({
            title: 'Sure to Delete?',
            icon: 'warning',
        })>
            Action
        </button>
    HTML;

    $rendered = Blade::render($html, [
        '_instance' => new class()
        {
            public string $id = 'livewire-id';
        },
    ]);

    expect($rendered)->toBe(<<<HTML
    <button onclick="\$wireui.confirmAction({
            title: 'Sure to Delete?',
            icon: 'warning',
        }, 'livewire-id')">
            Action
        </button>
    HTML);
});

it('should create the notify expression without livewire', function () {
    $html = <<<HTML
        <button @notify({
            title: 'Sure to Delete?',
            icon: 'warning',
        })>
            Notify
        </button>
    HTML;

    $rendered = Blade::render($html);

    expect($rendered)->toBe(<<<HTML
    <button onclick="\$wireui.notify({
            title: 'Sure to Delete?',
            icon: 'warning',
        }, null)">
            Notify
        </button>
    HTML);
});

it('should create the notify expression with livewire', function () {
    $html = <<<HTML
        <button @notify({
            title: 'Sure to Delete?',
            icon: 'warning',
        })>
            Notify
        </button>
    HTML;

    $rendered = Blade::render($html, [
        '_instance' => new class()
        {
            public string $id = 'livewire-id';
        },
    ]);

    expect($rendered)->toBe(<<<HTML
    <button onclick="\$wireui.notify({
            title: 'Sure to Delete?',
            icon: 'warning',
        }, 'livewire-id')">
            Notify
        </button>
    HTML);
});

it('should get a boolean value of any php variable', function (mixed $prop, string $expected) {
    $html = <<<HTML
        <button x-data="{ open: @boolean(\$prop) }">
            Click
        </button>
    HTML;

    $rendered = Blade::render($html, ['prop' => $prop]);

    expect($rendered)->toBe(<<<HTML
    <button x-data="{ open: {$expected} }">
            Click
        </button>
    HTML);
})->with([
    [true, 'true'],
    [false, 'false'],
    [null, 'false'],
    [[], 'false'],
    [1, 'true'],
    [0, 'false'],
    ['', 'false'],
]);
