<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUserIdToTodosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$first_user = DB::table('users')->orderBy('id')->first();
		var_dump($first_user);
		$first_user = $first_user->id;

		Schema::table('todos', function(Blueprint $table) use ($first_user) {
			$table->integer('user_id')->unsigned()->default($first_user);
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});

		DB::statement('ALTER TABLE todos ALTER COLUMN user_id DROP DEFAULT');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('todos', function(Blueprint $table) {
			$table->dropColumn('user_id');
		});
	}

}
