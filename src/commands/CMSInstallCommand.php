<?php

namespace Laravella\CMS;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;
use Config;

class CMSInstallCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'cms:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install CMS including migrations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        // $app = $this->getLaravel();
        // $env = $app->environment();
        $this->call('migrate', array('--package' => 'laravella/cms'));
        $this->info('Successfully seeded CMS');
        $this->setupUploadDirectory();
        $this->info('Successfully Completed Installation of CMS');
    }

    public function checkifWorkBench()
    {
        $path = __FILE__;
        return str_contains(strtolower($path), '/workbench/laravella/cms/');
    }

    public function setupUploadDirectory()
    {
        $publicPath = app()->make('path.public');
        $ConfigUploadPath = app('config')->get('ravel::media.media_storage_path');
        $uploadPath = $publicPath . '/' . $ConfigUploadPath;

        if (!app('files')->isDirectory($uploadPath))
        {
            $dirs = explode('/', $ConfigUploadPath);
            $findPath = $publicPath;
            $realpath = '/public';
            $filesCreated = false;
            foreach ($dirs as $dir)
            {
                if (!is_null($dir))
                {
                    $findPath = $findPath . '/' . $dir;
                    $realpath = $realpath . '/' . $dir;
                    if (!app('files')->isDirectory($findPath))
                    {
                        //create path
                        app('files')->makeDirectory($findPath);
                        $filesCreated = true;
                    }
                }
            }

            if ($filesCreated)
            {
                $this->info('Created media upload directory : ' . $realpath);
            }
        }
    }

}
