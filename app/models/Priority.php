<?php

class Priority extends Eloquent {
	protected $guarded = array();

	public $timestamps = FALSE;

	public static $rules = array(
		'priority'	=> 'required',
		'order'		=> 'required',
		'color'		=> 'required'
	);

	public function todos()
	{
		return $this->hasMany('Todo');
	}
}
