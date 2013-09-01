<?php

use Carbon\Carbon;

class Todo extends Eloquent {

	protected $guarded = array();
	protected $softDelete = TRUE;
	public $timestamps = TRUE;

	public $rules = array(
		'todo'			=> 'required|max:144',
		'notes'			=> 'max:144',
		'order'			=> 'required|integer',
		'priority_id'		=> 'required|exists:priorities,id',
		'labels'		=> 'required|exists_array:labels,id',
		'to_be_completed_at'	=> 'datetime',
		'user_id'		=> 'required|exists:users,id'
	);

	/**
	 * One (user) has many (todos) relationship
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

	/**
	 * One (todo) has many (labels) relationship
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function labels()
	{
		return $this->belongsToMany('Label')->orderBy('name');
	}

	/**
	 * One (todo) has one (priority) relationship
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function priority()
	{
		return $this->belongsTo('Priority');
	}

	/**
	 *
	 * @return Carbon | NULL
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
	 * @return Carbon | NULL
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
	 * Return the static property $rules
	 *
	 * @return array
	 */
	public function getRulesAttribute()
	{
		return self::$rules;
	}

	/**
	 * Value can be a NULL which means this todo has no completion date.
	 * Formats supported by DateTime are accepted.
	 *
	 * @param  string $to_be_completed_at
	 * @return self
	 */
	public function setToBeCompletedAtAttribute($to_be_completed_at)
	{
		if ( ! $to_be_completed_at) {
			$to_be_completed_at = NULL;
		}
		else {
			$tz = Config::get('app.timezone');
			try {
				$to_be_completed_at = Carbon::parse($to_be_completed_at, $tz);
			} catch (Exception $e) {
				throw new InvalidArgumentException("Invalid to_be_completed_at format: {$to_be_completed_at}");
			}
		}

		$this->attributes['to_be_completed_at'] = $to_be_completed_at;

		return $this;
	}

	/**
	 * Same as setToBeCompletedAtAttribute.
	 *
	 * @param  string $to_be_completed_at
	 * @return self
	 */
	public function setCompletedAtAttribute($completed_at)
	{
		if ( ! $completed_at) {
			$completed_at = NULL;
		}
		else {
			$tz = Config::get('app.timezone');
			try {
				$completed_at = Carbon::parse($completed_at, $tz);
			} catch (Exception $e) {
				throw new InvalidArgumentException("Invalid completed_at format: {$completed_at}");
			}
		}

		$this->attributes['completed_at'] = $completed_at;

		return $this;
	}

	/**
	 * Override the function to include processing of labels relationship
	 * if set in the arguments.
	 *
	 * @param array $attributes
	 */
	public function update(array $attributes = array())
	{
		if (isset($attributes['labels'])) {
			$labels = $attributes['labels'];
			unset($attributes['labels']);

			$this->labels()->sync($labels);
		}

		parent::update($attributes);
	}

	/**
	 * Return a human readable difference between the current date
	 * and the completion date or NULL when completion date is not set.
	 *
	 * @return string
	 */
	public function getDaysTillCompletionDate()
	{
		if ( ! $this->to_be_completed_at) {
			return NULL;
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
	 * Return all todos that needs to be completed at a given date.
	 * NULL value is accepted for todos that do not have a completion date.
	 *
	 * @param  Carbon $completion_date
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
			->orderBy('todos.to_be_completed_at')
			->get();
	}

}
