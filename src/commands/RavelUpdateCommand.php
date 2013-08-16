<?php namespace Laravella\Cms;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Config;

class RavelCmsCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'cms:update';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update Cms including migrations and assets';

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
	

		if($this->checkifWorkBench())
		{
			$this->call('asset:publish',array('--bench'=>'laravella/cms'));
			$this->call('migrate',array('--bench'=>'laravella/cms'));
		}
		else
		{	
			$this->call('config:publish',array('package'=>'laravella/cms'));
			$this->call('asset:publish',array('package'=>'laravella/cms'));
			$this->call('migrate',array('--package'=>'laravella/cms'));
		}

		$this->setupUploadDirectory();
	
		$this->info('Successfully updated Cms');
	}


	public function checkifWorkBench()
	{
		$path = __FILE__;
		return str_contains(strtolower($path),'/workbench/laravella/cms/');
	}


	public function setupUploadDirectory()
	{
		$publicPath = app()->make('path.public');
		$ConfigUploadPath = app('config')->get('cms::media.media_storage_path');
		$uploadPath = $publicPath .'/'. $ConfigUploadPath;

		if ( ! app('files')->isDirectory($uploadPath))
		{
			$dirs = explode('/', $ConfigUploadPath);
			$findPath = $publicPath;
			$realpath = '/public';
			$filesCreated = false;
			foreach($dirs as $dir)
			{
				if(!is_null($dir))
				{
					$findPath = $findPath . '/' . $dir;
					$realpath = $realpath . '/' . $dir;
					if( ! app('files')->isDirectory($findPath))
					{
						//create path
						app('files')->makeDirectory($findPath);
						$filesCreated = true;
					} 
				}
				
			}

			if($filesCreated)
			{
				$this->info('Created media upload directory : '.$realpath);
			}
		}

	}

}