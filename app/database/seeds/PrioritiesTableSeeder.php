<?php

class PrioritiesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('priorities')->delete();

		$priorities = array(
			array('priority' => 'A', 'order' => 1, 'color' => 'ff0000', 'description' => ''),
			array('priority' => 'B', 'order' => 2, 'color' => '00ff00', 'description' => ''),
			array('priority' => 'C', 'order' => 3, 'color' => '0000ff', 'description' => '')
		);

		DB::table('priorities')->insert($priorities);
	}

}
