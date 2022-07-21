<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\{Artisan, File, Route};
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench;
use ReflectionClass;
use WireUi\PhosphorIcons\PhosphorIconsServiceProvider;
use WireUi\WireUiServiceProvider;

class TestCase extends Testbench\TestCase
{
    protected function setUp(): void
    {
        $this->afterApplicationCreated(function () {
            $this->makeACleanSlate();
        });

        $this->beforeApplicationDestroyed(function () {
            $this->makeACleanSlate();
        });

        parent::setUp();

        Route::middleware('web')->group(base_path('src/routes.php'));
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app->setBasePath(__DIR__ . '/../..');
    }

    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            WireUiServiceProvider::class,
            PhosphorIconsServiceProvider::class,
        ];
    }

    public function makeACleanSlate(): void
    {
        Artisan::call('view:clear');
    }

    /** Call protected/private method of a class */
    public function invokeMethod(mixed $object, string $method, array $parameters = [])
    {
        $reflection = new ReflectionClass(get_class($object));
        $method     = $reflection->getMethod($method);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    /** Get protected/private property value of a class */
    public function invokeProperty(mixed $object, string $property)
    {
        $reflection = new ReflectionClass(get_class($object));
        $property   = $reflection->getProperty($property);
        $property->setAccessible(true);

        return $property->getValue($object);
    }
}
