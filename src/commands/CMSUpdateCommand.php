<?php namespace Laravella\Cms;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Config;

class CmsUpdateCommand extends Command {

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

		$this->call('db:seed',array('--class'=>'CMSDatabaseSeeder'));
                
		$this->info('Successfully updated CMS');
	}


}