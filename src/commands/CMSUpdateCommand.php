<?php namespace Laravella\CMS;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Config;

class CMSUpdateCommand extends Command {

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

                $this->call('config:publish',array('package'=>'laravella/cms'));
                $this->call('asset:publish',array('package'=>'laravella/cms'));
                $this->call('db:seed',array('--class'=>'CMSDatabaseSeeder'));
                
		$this->info('Successfully updated CMS');
	}


}