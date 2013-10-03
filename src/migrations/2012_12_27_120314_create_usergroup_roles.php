<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsergroupRoles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('usergroup_id')->unsigned();
			$table->integer('module_id')->unsigned();
			$table->text('permissions');
                        $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                        $table->timestamp('updated_at')->default('0000-00-00 00:00:00');

			$table->unique(array('usergroup_id','module_id'),'roles_unique');

//			$table->foreign('usergroup_id')->references('id')->on('usergroups')->onDelete('cascade')->onUpdate('cascade');
//			$table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('roles');
	}

}