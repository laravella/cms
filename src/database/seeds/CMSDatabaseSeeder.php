<?php

class CMSDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call('CMSSeedContentTypes');
		$this->call('CMSSeedMediaTypes');
	}

}