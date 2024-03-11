<?php

namespace Modules\Certificate\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Certificate\Events\Handlers\RegisterCertificateSidebar;

class CertificateServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterCertificateSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('documents', Arr::dot(trans('certificate::documents')));
            $event->load('configs', Arr::dot(trans('certificate::configs')));
            // append translations


        });
    }

    public function boot()
    {
        $this->publishConfig('certificate', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Certificate\Repositories\DocumentRepository',
            function () {
                $repository = new \Modules\Certificate\Repositories\Eloquent\EloquentDocumentRepository(new \Modules\Certificate\Entities\Document());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Certificate\Repositories\Cache\CacheDocumentDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Certificate\Repositories\ConfigRepository',
            function () {
                $repository = new \Modules\Certificate\Repositories\Eloquent\EloquentConfigRepository(new \Modules\Certificate\Entities\Config());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Certificate\Repositories\Cache\CacheConfigDecorator($repository);
            }
        );
// add bindings


    }
}
