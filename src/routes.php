<?php

use Illuminate\Support\Facades\Route;
use WireUi\Http\Controllers\{
    ButtonController,
    IconsController,
    WireUiAssetsController
};

Route::name('wireui.')->prefix('/wireui')->group(function () {
    Route::get('icons/{icon}/{variant?}', IconsController::class)->name('render.icons');
    Route::get('button', ButtonController::class)->name('render.buttons');
    Route::get('assets/scripts', [WireUiAssetsController::class, 'scripts'])->name('assets.scripts');
    Route::get('assets/styles', [WireUiAssetsController::class, 'styles'])->name('assets.styles');
});
