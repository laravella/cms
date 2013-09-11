<?php namespace Laravella\CMS;

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

        $commands = array('CMSInstall'=>'command.cms.install', 
            'CMSUpdate'=>'command.cms.update',
            'CMSBackup'=>'command.cms.backup',
            'CMSRestore'=>'command.cms.restore');

        $cmd = array();
        foreach ($commands as $command=>$name)
        {
            $className = $command . 'Command';
//            $this->registerCommand($name, $className); //CMSInstallCommand
            $this->{'register' . $className}();
            $cmd[] = $name;
        }
        $this->commands($cmd);
    }

    public function registerCommand($name, $class)
    {
        $this->app[$name] = $this->app->share(function($app)
                {
                    return new $class();
                });
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

    public function registerCMSBackupCommand()
    {
        $this->app['command.cms.backup'] = $this->app->share(function($app)
                {
                    return new CMSBackupCommand($app['db']);
                });
    }

    public function registerCMSRestoreCommand()
    {
        $this->app['command.cms.restore'] = $this->app->share(function($app)
                {
                    return new CMSRestoreCommand($app['db']);
                });
    }

}