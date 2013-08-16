<?php

namespace Laravella\CMS;

use Illuminate\Support\ServiceProvider;

class CMSServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('laravella/cms');

        include __DIR__ . '/../../routes.php';

        $this->registerCommands();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Register 'underlyingclass' instance container to our UnderlyingClass object
        $this->app['cmsgopher'] = $this->app->share(function($app)
                {
                    return new DbGopher;
                });

        $this->app->booting(function()
                {
                    $loader = \Illuminate\Foundation\AliasLoader::getInstance();
                    $loader->alias('CMSGopher', 'Laravella\CMS\Facades\CMSGopher');
                });
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

    /** register the custom commands * */
    public function registerCommands()
    {
//            Artisan::add(new InstallCommand);
//            Artisan::add(new UpdateCommand);

        $commands = array('CMSInstall', 'CMSUpdate');

        foreach ($commands as $command)
        {
            $this->{'register' . $command . 'Command'}();
        }

        $this->commands(
                'command.cms.install', 'command.cms.update'
        );
    }

    public function registerCMSInstallCommand()
    {
        $this->app['command.cms.install'] = $this->app->share(function($app)
                {
                    return new CMSInstallCommand();
                });
    }

    public function registerCMSUpdateCommand()
    {
        $this->app['command.cms.update'] = $this->app->share(function($app)
                {
                    return new CMSUpdateCommand();
                });
    }

}