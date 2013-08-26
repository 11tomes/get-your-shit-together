<?php

class PrioritiesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('priorities')->delete();

		$priorities = array(
			array('name' => 'A', 'order' => 1, 'color' => 'ff0000', 'description' => ''),
			array('name' => 'B', 'order' => 2, 'color' => '00ff00', 'description' => ''),
			array('name' => 'C', 'order' => 3, 'color' => '0000ff', 'description' => '')
		);

		DB::table('priorities')->insert($priorities);
	}

}
