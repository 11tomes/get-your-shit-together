<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotPriorityTodoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('priority_todo', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('priority_id')->unsigned()->index();
			$table->integer('todo_id')->unsigned()->index();
			$table->foreign('priority_id')->references('id')->on('priorities')->onDelete('cascade');
			$table->foreign('todo_id')->references('id')->on('todos')->onDelete('cascade');
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('priority_todo');
	}

}
