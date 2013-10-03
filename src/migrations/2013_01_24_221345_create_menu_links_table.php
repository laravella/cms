<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuLinksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('links', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('menu_id')->unsigned();
			$table->string('label');
			$table->string('content_type'); // URL | PAGE | POST | CATEGORY | ATTACHMENT
			$table->integer('content_id')->unsigned();
			$table->integer('weight')->default(0);
			$table->integer('parent_id')->default(0)->unsigned();
			$table->boolean('publish')->default(false);
                        $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                        $table->timestamp('updated_at')->default('0000-00-00 00:00:00');

//			$table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('links');
	}

}