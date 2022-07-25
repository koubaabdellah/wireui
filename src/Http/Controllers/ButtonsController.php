<?php

namespace WireUi\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\ComponentAttributeBag;
use WireUi\Http\Requests\ButtonRequest;
use WireUi\Support\BladeCompiler;

class ButtonsController extends Controller
{
    private BladeCompiler $compiler;

    public function __construct(BladeCompiler $compiler)
    {
        $this->compiler = $compiler;
    }

    public function __invoke(ButtonRequest $request): Response
    {
        $html = $this->compiler->compile(<<<EOT
            <x-dynamic-component
                :component="WireUi::component('button')"
                {$this->attributes($request->validated())->toHtml()}
            />
        EOT);

        return response($html)->withHeaders([
            'Content-Type'  => 'text/html; charset=utf-8',
            'Cache-Control' => 'public, only-if-cached, max-age=31536000',
        ]);
    }

    protected function attributes(array $attributes): ComponentAttributeBag
    {
        return (new ComponentAttributeBag($attributes))->whereDoesntStartWith(':');
    }
}
