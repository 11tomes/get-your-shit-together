<?php

class TodosTableSeeder extends Seeder {

	public function run()
	{
		// @todo: verify that this do hard delete
		DB::table('todos')->delete();

		$todos = array(
			array(
				'todo' => 'get this done tom',
				'notes' => 'deadline tom',
				'to_be_completed_at' => '2013-08-21 10:23:54',
				'completed_at' => NULL,
				'created_at' => '2013-07-01',
				'updated_at' => '2013-07-01',
				'order'	=> 1,
				'priority_id' => 1,
				'user_id' => 1
			),
			array(
				'todo' => 'this is done yesterday',
				'notes' => 'no deadlines',
				'to_be_completed_at' => NULL,
				'completed_at' => '2013-08-19 10:23:54',
				'created_at' => '2013-07-01',
				'updated_at' => '2013-07-01',
				'order'	=> 1,
				'priority_id' => 1,
				'user_id' => 1
			),
			array(
				'todo' => 'this is done a month ago',
				'notes' => NULL,
				'to_be_completed_at' => '2013-07-31 10:23:54',
				'completed_at' => '2013-07-20 10:23:54',
				'created_at' => '2013-07-01',
				'updated_at' => '2013-07-01',
				'order'	=> 1,
				'priority_id' => 1,
				'user_id' => 1
			),
			array(
				'todo' => 'to be done someday',
				'notes' => 'no deadlines',
				'to_be_completed_at' => NULL,
				'completed_at' => NULL,
				'created_at' => '2013-07-01',
				'updated_at' => '2013-07-01',
				'order'	=> 1,
				'priority_id' => 1,
				'user_id' => 1
			)
		);

		DB::table('todos')->insert($todos);
	}

}
