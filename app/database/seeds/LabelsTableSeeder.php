<?php

class LabelsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('labels')->delete();

		$labels = array(
			array('name' => 'Work', 'color' => 'ee3e64', 'description' => '', 'parent_id' => '0'),
			array('name' => 'Errands', 'color' => '4accff', 'description' => '', 'parent_id' => '0'),
			array('name' => 'Freelance', 'color' => 'b7d84b', 'description' => '', 'parent_id' => '0'),
			array('name' => 'Goals', 'color' => 'E2A741', 'description' => '', 'parent_id' => '0'),
		);

		 DB::table('labels')->insert($labels);
	}

}
