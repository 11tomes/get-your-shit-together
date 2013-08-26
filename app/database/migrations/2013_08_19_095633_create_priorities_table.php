<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrioritiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('priorities', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 1);
			$table->integer('order');
			$table->string('color', 6);
			$table->string('description', 144)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('priorities');
	}

}
