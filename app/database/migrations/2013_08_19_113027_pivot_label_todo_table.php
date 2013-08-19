<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotLabelTodoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('label_todo', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('label_id')->unsigned()->index();
			$table->integer('todo_id')->unsigned()->index();
			$table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade');
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
		Schema::drop('label_todo');
	}

}
