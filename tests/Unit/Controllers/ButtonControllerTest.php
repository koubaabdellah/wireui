<?php

use Illuminate\View\ComponentAttributeBag;
use Symfony\Component\HttpFoundation\Response;
use WireUi\Http\Controllers\ButtonController;

it('should render the button with attributes', function () {
    $this->getJson(route('wireui.render.buttons', [
        'type'  => 'primary',
        'label' => 'Click me',
    ]))
        ->assertSee('<button', escape: false)
        ->assertSee('Click me');
});

it('should filter the attributes and exclude malicious attributes', function () {
    $attributes = [
        'color'  => 'primary',
        ':label' => "strtoupper('Click me')",
        ':type'  => "config('app.name')",
    ];

    /** @var ButtonController $controller */
    $controller = resolve(ButtonController::class);

    /** @var ComponentAttributeBag $filteredAttributes */
    $filteredAttributes = $this->invokeMethod($controller, 'attributes', [$attributes]);

    $this->assertSame(
        ['color' => 'primary'],
        $filteredAttributes->getAttributes()
    );
});

it('should validate the button attributes', function (array $attributes, array $errors) {
    $this->getJson(route('wireui.render.buttons', $attributes))
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJsonValidationErrors($errors);
})->with([
    'color' => [
        'attributes' => [
            'color' => 'invalid-color',
        ],
        'errors' => ['color' => 'validation.in'],
    ],
    'size' => [
        'attributes' => [
            'size' => 'invalid-size',
        ],
        'errors' => ['size' => 'validation.in'],
    ],
    'iconSize' => [
        'attributes' => [
            'iconSize' => 'invalid-iconSize',
        ],
        'errors' => ['iconSize' => 'validation.in'],
    ],
    'label' => [
        'attributes' => [
            'label' => ['invalid-type'],
        ],
        'errors' => ['label' => 'string'],
    ],
    'rightIcon' => [
        'attributes' => [
            'rightIcon' => ['invalid-type'],
        ],
        'errors' => ['rightIcon' => 'string'],
    ],
    'icon' => [
        'attributes' => [
            'icon' => ['invalid-type'],
        ],
        'errors' => ['icon' => 'string'],
    ],
    'rounded' => [
        'attributes' => [
            'rounded' => ['invalid-type'],
        ],
        'errors' => ['rounded' => 'boolean'],
    ],
    'squared' => [
        'attributes' => [
            'squared' => ['invalid-type'],
        ],
        'errors' => ['squared' => 'boolean'],
    ],
    'bordered' => [
        'attributes' => [
            'bordered' => ['invalid-type'],
        ],
        'errors' => ['bordered' => 'boolean'],
    ],
    'flat' => [
        'attributes' => [
            'flat' => ['invalid-type'],
        ],
        'errors' => ['flat' => 'boolean'],
    ],
]);
