<?php

namespace Mark86092\Recaptcha;

use ReCaptcha\ReCaptcha as GoogleReCaptcha;
use Illuminate\Support\ServiceProvider;

/**
 * Service provider for the Recaptcha class.
 *
 * @author     Greg Gilbert
 *
 * @link       https://github.com/greggilbert
 */
class RecaptchaServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->setupConfig();

        $this->addValidator();
    }

    /**
     * Extends Validator to include a recaptcha type.
     */
    public function addValidator()
    {
        $this->app->validator->extendImplicit('recaptcha', function ($attribute, $value, $parameters) {
            return app('recaptcha.checker')->verify($value)->check();
        }, 'Please ensure that you are a human!');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerAliases();
        $this->registerProvider();
        $this->registerChecker();
    }

    /**
     * Bind some aliases.
     */
    protected function registerAliases()
    {
        $this->app->alias('recaptcha.provider', GoogleReCaptcha::class);
        $this->app->alias('recaptcha.checker', Recaptcha::class);
    }

    protected function registerProvider()
    {
        $this->app->singleton('recaptcha.provider', function ($app) {
            return new GoogleReCaptcha(value($app['config']->get('recaptcha.private_key'));
        });
    }

    protected function registerChecker()
    {
        $this->app->bind('recaptcha.checker', function ($app) {
            return new Recaptcha($this->app['recaptcha.provider']);
        });
    }

    /**
     * Setup the config.
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/recaptcha.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([$source => config_path('recaptcha.php')]);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'recaptcha.provider',
            'recaptcha.checker',
        ];
    }
}
