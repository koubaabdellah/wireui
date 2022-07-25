<?php

namespace WireUi\Http\Controllers;

use Illuminate\Http\Response;
use Throwable;
use WireUi\View\Components\Icon;

class IconsController extends Controller
{
    public function __invoke(string $icon, ?string $variant = null): Response
    {
        try {
            $component = new Icon(name: $icon, variant: $variant);

            return response()
                ->view($component->render()->name(), ['attributes' => null])
                ->withHeaders([
                    'Content-Type'  => 'image/svg+xml; charset=utf-8',
                    'Cache-Control' => 'public, only-if-cached, max-age=31536000',
                ]);
        } catch (Throwable $exception) {
            if (
                !str_starts_with($exception->getMessage(), 'View')
                && !str_ends_with($exception->getMessage(), 'not found.')
            ) {
                report($exception);
            }

            abort(Response::HTTP_NOT_FOUND, "Icon \"{$icon}\" for variant \"{$variant}\" was not found.");
        }
    }
}
