<?php

class Todo extends Eloquent {
	protected $guarded = array();

	protected $softDelete = TRUE;

	public $timestamps = TRUE;

	public static $rules = array(
		'todo' => 'required',
		//'notes' => 'required',
		//'to_be_completed_at' => 'required',
		//'completed_at' => 'required'
	);

	public function setToBeCompletedAtAttribute($to_be_completed_at)
	{
		if ( ! $to_be_completed_at) {
			$to_be_completed_at = NULL;
		}

		$this->attributes['to_be_completed_at'] = $to_be_completed_at;
	}
}
