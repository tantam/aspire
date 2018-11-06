<?php

namespace Modules\Loan\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Loan\Repositories\Eloquent\EloquentLoanRepository;
use Modules\Loan\Repositories\Eloquent\EloquentRepaymentRepository;
use Modules\Loan\Repositories\LoanRepository;
use Modules\Loan\Repositories\RepaymentRepository;

class LoanServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LoanRepository::class,EloquentLoanRepository::class);
        $this->app->bind(RepaymentRepository::class,EloquentRepaymentRepository::class);

        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('loan.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'loan'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/loan');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/loan';
        }, \Config::get('view.paths')), [$sourcePath]), 'loan');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/loan');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'loan');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'loan');
        }
    }

    /**
     * Register an additional directory of factories.
     * 
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
