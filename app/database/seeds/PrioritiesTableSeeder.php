<?php

class PrioritiesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('priorities')->truncate();

		$priorities = array(
			array('priority' => 'A', 'level' => 1, 'order' => 1, 'color' => 'ff0000', 'description' => ''),
			array('priority' => 'B', 'level' => 1, 'order' => 2, 'color' => '00ff00', 'description' => ''),
			array('priority' => 'C', 'level' => 1, 'order' => 3, 'color' => '0000ff', 'description' => ''),
			array('priority' => '1', 'level' => 2, 'order' => 1, 'color' => '000000', 'description' => ''),
			array('priority' => '2', 'level' => 2, 'order' => 2, 'color' => '000000', 'description' => ''),
			array('priority' => '3', 'level' => 2, 'order' => 3, 'color' => '000000', 'description' => '')
		);

		DB::table('priorities')->insert($priorities);
	}

}
