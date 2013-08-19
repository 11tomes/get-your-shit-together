<?php

class Priority extends Eloquent {
	protected $guarded = array();

	public $timestamps = FALSE;

	public static $rules = array(
		'priority' => 'required',
		'level' => 'required',
		'order' => 'required',
		'color' => 'required',
		'description' => 'required'
	);
}
