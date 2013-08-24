<?php

class Label extends Eloquent {
	protected $guarded = array();

	public $timestamps = FALSE;

	public static $rules = array(
		'label'		=> 'required|min:1|max:72',
		'color'		=> 'required|size:6|regex:^(?:[0-9a-fA-F]{3}){1,2}$',
		'description'	=> 'max:144',
		'parent_id'	=> 'required|integer' // @todo can either be 0 or exists:labels,id
	);

	public function todos()
	{
		return $this->belongsToMany('Todo');
	}

	/**
	 * Return the parent label or NULL if it doesn't have.
	 *
	 * @return self | NULL
	 */
	public function getParentAttribute()
	{
		if ($this->parent_id) {
			return self::find($this->parent_id);
		}

		return NULL;
	}

	/**
	 * Get the label's complete name which includes parent label name
	 * if it has one.
	 *
	 * @return string
	 */
	public function getCompleteNameAttribute()
	{
		$parent_name = "";
		if ($this->parent) {
			$parent_name = $this->parent->complete_name;
		}

		return $parent_name ? "{$parent_name}/{$this->name}" : $this->name;
	}

	/**
	 * Returns an array of $id => $complete_label
	 *
	 * @return array
	 */
	public static function asOptionsArray()
	{
		$labels = array();

		foreach (self::all() as $label) {
			$labels[$label->id] = $label->complete_name;
		}

		return $labels;
	}
}
