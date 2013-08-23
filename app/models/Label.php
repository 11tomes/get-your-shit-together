<?php

class Label extends Eloquent {
	protected $guarded = array();

	public $timestamps = FALSE;

	public static $rules = array(
		'label'		=> 'required',
		'color'		=> 'required',
		'parent_id'	=> 'required'
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
	public function getCompleteLabelAttribute()
	{
		$parent_label = "";
		if ($this->parent) {
			$parent_label = $this->parent->complete_label;
		}

		return $parent_label ? "{$parent_label}/{$this->label}" : $this->label;
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
			$labels[$label->id] = $label->complete_label;
		}

		return $labels;
	}
}
