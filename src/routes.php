<?php

use Illuminate\Support\Facades\Route;
use WireUi\Http\Controllers\{
    ButtonsController,
    IconsController,
    WireUiAssetsController
};

Route::name('wireui.')->prefix('/wireui')->group(function () {
    Route::get('icons/{icon}/{variant?}', IconsController::class)->name('render.icons');
    Route::get('buttons', ButtonsController::class)->name('render.buttons');
    Route::get('assets/scripts', [WireUiAssetsController::class, 'scripts'])->name('assets.scripts');
    Route::get('assets/styles', [WireUiAssetsController::class, 'styles'])->name('assets.styles');
});
