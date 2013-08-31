<?php

class Priority extends Eloquent {

	protected $guarded = array();
	public $timestamps = FALSE;

	public $rules = array(
		'name'		=> 'required|size:1',
		'order'		=> 'required|integer',
		'color'		=> 'required|size:6|regex:/^(?:[0-9a-fA-F]{3}){1,2}$/'
	);

	/**
	 * One (priority) has many (todos) relationship. Default order
	 * of todos is by their order.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function todos()
	{
		return $this->hasMany('Todo')
			->orderBy('todos.order');
	}

	/**
	 * Return all the priorities ordered by 'order'.
	 *
	 * @param  array $columns
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public static function all($columns = array())
	{
		return self::select('priorities.*')
			->orderBy('order')
			->get();
	}

	/**
	 * Returns an array of $id => $name
	 *
	 * @return array
	 */
	public static function asOptionsArray()
	{
		$priorities = array(NULL => '--Select--');

		foreach (self::all() as $priority) {
			$priorities[$priority->id] = $priority->name;
		}

		return $priorities;
	}

}
