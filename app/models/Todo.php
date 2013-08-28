<?php

use Carbon\Carbon;

class Todo extends Eloquent {
	protected $guarded = array();

	protected $softDelete = TRUE;

	public $timestamps = TRUE;

	public static $rules = array(
		'todo'		=> 'required|max:144',
		'notes'		=> 'max:144',
		'order'		=> 'required|integer',
		'priority_id'	=> 'required|integer',
		'labels'	=> 'required',
		'to_be_completed_at'	=> 'datetime'
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
	 * Return the IDs of the labels this todo belongs to.
	 *
	 * @return array
	 */
	public function getSelectedLabelsIdsAttribute()
	{
		$ids = array();
		foreach ($this->labels as $label) {
			$ids[] = $label->id;
		}

		return $ids;
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

		if (is_string($to_be_completed_at)) {
			if (strtolower($to_be_completed_at) === 'someday') {
				$to_be_completed_at = NULL;
			}
			else {
				// @todo timezone please?
				try {
					$to_be_completed_at = Carbon::parse($to_be_completed_at, 'America/Vancouver');
				} catch (\Exception $e) {
					throw new \Exception("Invalid to_be_completed_at format: {$to_be_completed_at}");
				}
			}
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

	/**
	 * Return the top priority uncompleted todo. Returns NULL if none is found.
	 *
	 * @return self | NULL
	 */
	public static function getTopPriority()
	{
		return self::select('todos.*')
			->join('priorities', 'priorities.id', '=', 'todos.priority_id')
			->orderBy('priorities.order')
			->orderBy('todos.order')
			->whereNull('completed_at')
			->first();
	}

	/**
	 * Return all the dates with todos that need to be completed.
	 * Returns a collection of Carbon\Carbon.
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public static function getCompletionDates()
	{
		$completion_dates = array();
		$todos = self::select(DB::raw('date(to_be_completed_at) AS to_be_completed_at'))
			->distinct()
			->orderBy('to_be_completed_at')
			->get();

		foreach ($todos as $todo) {
			$completion_dates[] = $todo->to_be_completed_at;
		}

		return $completion_dates;
	}

	/**
	 * Return all todos that needs to be completed at a given date
	 *
	 * @param string $completion_date
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public static function findByCompletionDate($completion_date)
	{
		if ( ! $completion_date) {
			$completion_date = NULL;
		}
		else if ($completion_date instanceOf Carbon) {
			$completion_date = $completion_date->toDateString();
		}

		return self::select('todos.*')
			->where(DB::raw('to_be_completed_at::date'), '=', $completion_date)
			->orderBy('to_be_completed_at')
			->get();
	}

	/**
	 * Return all todos ordered by priority
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public static function all($columns = array())
	{
		$columns = $columns ?: 'todos.*';

		return self::select($columns)
			->join('priorities', 'priorities.id', '=', 'todos.priority_id')
			->orderBy('priorities.order')
			->orderBy('todos.order')
			->get();
	}

}
