<?php

class CMSDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call('CMSAdminUserSeeder');
		$this->call('CMSSeedMenus');
	}

}