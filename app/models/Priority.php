<?php

class Priority extends Eloquent {
	protected $guarded = array();

	public $timestamps = FALSE;

	public static $rules = array(
		'name'		=> 'required',
		'order'		=> 'required',
		'color'		=> 'required'
	);

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
