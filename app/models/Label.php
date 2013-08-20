<?php

class Label extends Eloquent {
	protected $guarded = array();

	public $timestamps = FALSE;

	public static $rules = array(
		'label' => 'required',
		'color' => 'required',
		//'description' => 'required',
		'parent_id' => 'required'
	);

	public function todos()
	{
		return $this->belongsToMany('Todo');
	}
}
