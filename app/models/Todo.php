<?php

use Carbon\Carbon;

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

	public function labels()
	{
		return $this->belongsToMany('Label');
	}

	public function priorities()
	{
		return $this->belongsToMany('Priority');
	}

	/**
	 * Return a human readable difference between the current date
	 * and the deadline.
	 */
	public function getDaysTillCompletionDate()
	{
		if ( ! $this->to_be_completed_at) {
			return 'unknown';
		}

		$now = Carbon::now();

		return $now->diffForHumans($this->to_be_completed_at);
	}

	/**
	 * @return Priority | NULL
	 */
	public function topPriority()
	{
		// @todo does not work
		return $this->priorities()->orderBy('level')->first();
	}

	/**
	 *
	 * @return bool
	 */
	public function isDone()
	{
		return (bool) $this->to_be_completed_at;
	}
}
