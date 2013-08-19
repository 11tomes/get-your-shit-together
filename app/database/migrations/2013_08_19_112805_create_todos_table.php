<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTodosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('todos', function(Blueprint $table) {
			$table->increments('id');
			$table->string('todo', 144);
			$table->string('notes', 144)->nullable();
			$table->timestamp('deadline')->nullable();
			$table->timestamp('done_on')->nullable();
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
		Schema::drop('todos');
	}

}
