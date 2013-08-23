<?php

use Carbon\Carbon;

class Todo extends Eloquent {
	protected $guarded = array();

	protected $softDelete = TRUE;

	public $timestamps = TRUE;

	public static $rules = array(
		'todo'		=> 'required',
		'priority_id'	=> 'required',
		'order'		=> 'required'
	);

	/**
	 *
	 * @return DateTime | NULL
	 */
	public function getToBeCompletedAtAttribute()
	{
		if ( ! $this->attributes['to_be_completed_at']) {
			return NULL;
		}

		return $this->asDateTime($this->attributes['to_be_completed_at']);
	}

	/**
	 *
	 * @return DateTime | NULL
	 */
	public function getCompletedAtAttribute()
	{
		if ( ! $this->attributes['completed_at']) {
			return NULL;
		}

		return $this->asDateTime($this->attributes['completed_at']);
	}

	/**
	 * @todo explain what this does
	 *
	 * @param string $to_be_completed_at
	 * @return self
	 */
	public function setToBeCompletedAtAttribute($to_be_completed_at)
	{
		if ( ! $to_be_completed_at) {
			$to_be_completed_at = NULL;
		}

		$this->attributes['to_be_completed_at'] = $to_be_completed_at;

		return $this;
	}

	/**
	 *
	 * @param string $to_be_completed_at
	 * @return self
	 */
	public function setCompletedAtAttribute($completed_at)
	{
		if ( ! $completed_at) {
			$completed_at = NULL;
		}

		$this->attributes['completed_at'] = $completed_at;

		return $this;
	}

	public function labels()
	{
		return $this->belongsToMany('Label');
	}

	public function priority()
	{
		return $this->belongsTo('Priority');
	}

	/**
	 * Return a human readable difference between the current date
	 * and the completed at date. If completed at date is not set,
	 * this will return 'someday'.
	 *
	 * @return string
	 */
	public function getDaysTillCompletionDate()
	{
		if ( ! $this->to_be_completed_at) {
			return 'someday';
		}

		$now = Carbon::now();

		return $now->diffForHumans($this->to_be_completed_at);
	}

	/**
	 *
	 * @return bool
	 */
	public function isDone()
	{
		return (bool) $this->completed_at;
	}
}
