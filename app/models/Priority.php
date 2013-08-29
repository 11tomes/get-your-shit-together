<?php

class Priority extends Eloquent {
	protected $guarded = array();

	public $timestamps = FALSE;

	public static $rules = array(
		'name'		=> 'required|size:1',
		'order'		=> 'required|integer',
		'color'		=> 'required|size:6|regex:/^(?:[0-9a-fA-F]{3}){1,2}$/'
	);

	/**
	 * Returns an array of $id => $name
	 *
	 * @return array
	 */
	public static function asOptionsArray()
	{
		$priorities = array();

		foreach (self::all() as $priority) {
			$priorities[$priority->id] = $priority->name;
		}

		return $priorities;
	}

	public function todos()
	{
		return $this->hasMany('Todo');
	}

	/**
	 * Return all the priorities ordered by 'order'.
	 *
	 * @param array $columns
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public static function all($columns = array())
	{
		return self::select('priorities.*')
			->orderBy('order')
			->get();
	}
}
