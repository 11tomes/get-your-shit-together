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
			$table->integer('order');
			$table->integer('priority_id')->unsigned()->index();
			$table->timestamp('to_be_completed_at')->nullable();
			$table->timestamp('completed_at')->nullable();
			$table->foreign('priority_id')->references('id')->on('priorities')->onDelete('cascade');
			$table->timestamps(); // created_at, deleted_at
			$table->softDeletes();
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
