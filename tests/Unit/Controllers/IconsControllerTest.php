<?php

use Tests\Unit\TestCase;

it('should assert house icon can render', function () {
    /** @var TestCase $this */

    $this->getJson(route('wireui.render.icons', ['variant' => 'regular', 'icon' => 'house']))
        ->assertStatus(200)
        ->assertHeader('Content-Type', 'image/svg+xml; charset=utf-8')
        ->assertHeader('Cache-Control', 'max-age=31536000, only-if-cached, public')
        ->assertSee('<svg', escape: false);
});

it('should assert house icon can render with the default variant', function () {
    /** @var TestCase $this */

    $this->getJson(route('wireui.render.icons', ['icon' => 'house']))
        ->assertStatus(200)
        ->assertHeader('Content-Type', 'image/svg+xml; charset=utf-8')
        ->assertHeader('Cache-Control', 'max-age=31536000, only-if-cached, public')
        ->assertSee('<svg', escape: false);
});

it('should assert icon is not found', function () {
    /** @var TestCase $this */

    $this->getJson(route('wireui.render.icons', ['variant' => 'regular', 'icon' => 'invalid-icon-name']))
        ->assertStatus(404)
        ->assertHeader('Content-Type', 'application/json')
        ->assertHeader('Cache-Control', 'no-cache, private')
        ->assertExactJson([
            'message' => 'Icon "invalid-icon-name" for variant "regular" was not found.',
        ]);
});
