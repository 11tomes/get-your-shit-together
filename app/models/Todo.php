<?php

class Todo extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'todo' => 'required',
		'notes' => 'required',
		'deadline' => 'required',
		'done_on' => 'required'
	);
}