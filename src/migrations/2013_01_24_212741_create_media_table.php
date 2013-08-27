<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medias', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('media_type'); // IMAGE FILE | VIDEO FILE | YOUTUBE
			$table->string('path')->nullable();
			$table->string('caption')->default(null)->nullable();
			$table->string('author')->default(null)->nullable();
			$table->boolean('publish')->default(false)->nullable();
			$table->boolean('approved')->default(false)->nullable();
			$table->text('filedata')->nullable();
			$table->integer('gallery_id')->unsigned()->nullable();
			$table->string('keywords')->default(null)->nullable();
			$table->string('mediascol')->default(null)->nullable();
			$table->string('external_link')->default(null)->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('medias');
	}

}