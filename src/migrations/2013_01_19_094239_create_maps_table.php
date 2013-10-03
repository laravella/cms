<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('maps', function(Blueprint $table) {
                        $table->increments('id');
                        $table->string('latitude', 7,5);
                        $table->string('longitude', 7,5);
                        $table->string('title');
                        $table->string('lang', 3)->nullable();
                        $table->integer('author_id')->unsigned()->nullable();
                        $table->string('status')->default('draft')->nullable(); //draft, submitted, published,
                        $table->datetime('publish_date')->nullable();
                        $table->datetime('deleted_at')->nullable();
                        $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                        $table->timestamp('updated_at')->default('0000-00-00 00:00:00');

//					$table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
				});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('maps');
	}

}