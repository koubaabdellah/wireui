<?php

use Tests\Unit\TestCase;

it('should get all messages of all languages and assert if it is not null', function (string $langFolderPath) {
    /** @var TestCase $this */
    $messages = require "{$langFolderPath}/messages.php";

    expect($messages)
        ->toBeArray()
        ->toHaveKeys([
            'select_time',
            'search_here',
            'empty_options',
            'loading',
            'date_picker.months',
            'date_picker.days',
            'date_picker.tomorrow',
            'date_picker.today',
            'date_picker.yesterday',
            'errors.title',
        ]);

    expect(data_get($messages, 'select_time'))->toBeString();
    expect(data_get($messages, 'search_here'))->toBeString();
    expect(data_get($messages, 'empty_options'))->toBeString();
    expect(data_get($messages, 'loading'))->toBeString();
    expect(data_get($messages, 'date_picker.months'))->toBeArray()->toHaveCount(12);
    expect(data_get($messages, 'date_picker.days'))->toBeArray()->toHaveCount(7);
    expect(data_get($messages, 'date_picker.tomorrow'))->toBeString();
    expect(data_get($messages, 'date_picker.today'))->toBeString();
    expect(data_get($messages, 'date_picker.yesterday'))->toBeString();
    expect(data_get($messages, 'errors.title'))->toBeString();
})->with(function () {
    return array_map(
        fn (string $directory) => $directory,
        glob(__DIR__ . '/../../../src/lang/*', GLOB_ONLYDIR)
    );
});
