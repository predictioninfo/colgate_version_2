<?php

namespace Aizhar777\NumToWord;

use Illuminate\Support\ServiceProvider;

class NumToWordServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    //protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->regBladeDer();

        $this->app->singleton('NumbersToWords', function () {
            return new NumbersToWords(config('numbers'));
        });

        $this->publishes([
            __DIR__.'/config' => config_path(),
        ],'config');
    }

    /**
     * @return void
     */
    public function regBladeDer()
    {
        \Blade::directive('numToWords', function($expression) {
            return '<?php echo \NumbersToWords::getStr(' . $expression . '); ?>';
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['NumbersToWords'];
    }
}