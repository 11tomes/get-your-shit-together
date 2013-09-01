<?php

class PrioritiesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('priorities')->delete();

		$priorities = array(
			array('id' => 1, 'name' => 'A', 'order' => 1, 'color' => 'ff0000', 'description' => ''),
			array('id' => 2, 'name' => 'B', 'order' => 2, 'color' => '00ff00', 'description' => ''),
			array('id' => 3, 'name' => 'C', 'order' => 3, 'color' => '0000ff', 'description' => '')
		);

		DB::table('priorities')->insert($priorities);
	}

}
