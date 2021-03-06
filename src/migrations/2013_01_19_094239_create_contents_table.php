<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contents', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('lang',3)->nullable();
			$table->integer('author_id')->unsigned()->nullable();
			$table->string('author_name')->nullable(); //name to overide actual username
			//$table->string('content_type'); //post, page, attachement // deprecated
			$table->integer('content_type_id')->nullable()->unsigned();; //post, page, attachement
			$table->string('content_mime_type')->nullable(); //for attachments only
			$table->string('title');
			$table->text('content')->nullable();
			$table->text('excerpt')->nullable();
			$table->string('status')->default('draft')->nullable(); //draft, submitted, published,
			$table->boolean('allow_comments')->default(true)->nullable();
			$table->integer('comment_end')->nullable(); //ending from number of days from published date

			$table->boolean('content_locked')->default(false);
			$table->string('content_password',64)->nullable();
			$table->integer('parent_id')->default(0)->unsigned();
			$table->integer('comment_count')->default(0)->nullable();
			$table->datetime('publish_date')->nullable();
                        $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                        $table->timestamp('updated_at')->default('0000-00-00 00:00:00');

			//$table->unique(array('slug'),'slug_unique');

//			$table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');


		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('contents');
	}

}