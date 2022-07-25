<?php

namespace WireUi;

use Illuminate\Foundation\{AliasLoader, Application};
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\{ServiceProvider, Str};
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\ComponentAttributeBag;
use Livewire\WireDirective;
use WireUi\Facades\{WireUi, WireUiDirectives};
use WireUi\View\Compilers\WireUiTagCompiler;

/** @property Application $app */
class WireUiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig()
            ->disablePhosphorIconComponent()
            ->registerWireUI();
    }

    public function boot(): void
    {
        $this->registerBladeDirectives()
            ->registerBladeComponents()
            ->registerTagCompiler()
            ->registerMacros();
    }

    protected function registerTagCompiler(): self
    {
        Blade::precompiler(static function (string $string): string {
            return app(WireUiTagCompiler::class)->compile($string);
        });

        return $this;
    }

    protected function registerConfig(): self
    {
        $this->loadViewsFrom($this->rootDir('resources/views'), 'wireui');
        $this->loadTranslationsFrom($this->rootDir('lang'), 'wireui');
        $this->mergeConfigFrom($this->rootDir('config.php'), 'wireui');
        $this->loadRoutesFrom($this->rootDir('routes.php'));

        $this->publishes(
            [$this->rootDir('config.php') => $this->app->configPath('wireui.php')],
            'wireui.config'
        );
        $this->publishes(
            [$this->rootDir('resources/views') => $this->app->resourcePath('views/vendor/wireui')],
            'wireui.views'
        );
        $this->publishes(
            [$this->rootDir('lang') => $this->app->langPath('vendor/wireui')],
            'wireui.lang'
        );

        return $this;
    }

    public function registerWireUI(): self
    {
        $this->app->singleton('WireUi', WireUi::class);
        $loader = AliasLoader::getInstance();
        $loader->alias('WireUi', WireUi::class);

        return $this;
    }

    private function disablePhosphorIconComponent(): self
    {
        config()->set('wireui.phosphoricons.alias', 'icons.phosphoricons');
        config()->set('wireui.heroicons.alias', 'icons.heroicons');

        return $this;
    }

    private function rootDir(string $path): string
    {
        return __DIR__ . "/{$path}";
    }

    protected function registerBladeDirectives(): self
    {
        Blade::directive('confirmAction', static function (string $expression): string {
            return WireUiDirectives::confirmAction($expression);
        });

        Blade::directive('notify', static function (string $expression): string {
            return WireUiDirectives::notify($expression);
        });

        Blade::directive('wireUiScripts', static function (?string $attributes = ''): string {
            if (!$attributes) {
                $attributes = '[]';
            }

            return "{!! WireUi::directives()->scripts(attributes: {$attributes}) !!}";
        });

        Blade::directive('wireUiStyles', static function (): string {
            return WireUiDirectives::styles();
        });

        Blade::directive('boolean', static function ($value): string {
            return WireUiDirectives::boolean($value);
        });

        return $this;
    }

    protected function registerBladeComponents(): self
    {
        $this->callAfterResolving(BladeCompiler::class, static function (BladeCompiler $blade): void {
            foreach (config('wireui.components') as $component) {
                $blade->component($component['class'], $component['alias']);
            }
        });

        return $this;
    }

    protected function registerMacros(): self
    {
        ComponentAttributeBag::macro('wireModifiers', function () {
            /** @var ComponentAttributeBag $this */

            /** @var WireDirective $model */
            $model = $this->wire('model');

            return [
                'defer'    => $model->modifiers()->contains('defer'),
                'lazy'     => $model->modifiers()->contains('lazy'),
                'debounce' => [
                    'exists' => $model->modifiers()->contains('debounce'),
                    'delay'  => (string) Str::of($model->modifiers()->get(1, '750'))->replace('ms', ''),
                ],
            ];
        });

        return $this;
    }
}
