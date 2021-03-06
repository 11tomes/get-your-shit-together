<?php

class Label extends Eloquent {

	protected $guarded = array();
	public $timestamps = FALSE;

	/**
	 * Value for parent_id with no parent
	 *
	 * @var integer
	 */
	const NO_PARENT_ID = 0;

	public $rules = array(
		'name'		=> 'required|max:72', // @todo |unique:labels needs to work with update
		'color'		=> 'required|size:6|regex:/^(?:[0-9a-fA-F]{3}){1,2}$/',
		'description'	=> 'max:144',
		'parent_id'	=> 'required|integer' // @todo can either be 0 or exists:labels,id
	);

	/**
	 * The parent label.
	 *
	 * @var self
	 */
	protected $parent;

	/**
	 * One (todo) has many (todos) relationship. Default order is by
	 * priority.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsToMany.
	 */
	public function todos()
	{
		return $this->belongsToMany('Todo')
			->select('todos.*')
			->join('priorities', 'priorities.id', '=', 'todos.priority_id')
			->orderBy('priorities.order')
			->orderBy('todos.order');
	}

	/**
	 * Setter for parent_id, which is the id of the label
	 * where this is a child. If there is no parent, 0
	 * is set.
	 *
	 * @param  integer $parent_id
	 * @return self
	 */
	public function setParentIdAttribute($parent_id)
	{
		if ($parent_id == $this->id) {
			$parent_id = self::NO_PARENT_ID;
		}

		$this->attributes['parent_id'] = $parent_id;

		return $this;
	}

	/**
	 * Return the parent label or NULL if it doesn't have.
	 *
	 * @return self | NULL
	 */
	public function getParentAttribute()
	{
		if ($this->parent_id == self::NO_PARENT_ID) {
			return NULL;
		}

		if ( ! $this->parent) {
			$this->parent = self::find($this->parent_id);
		}

		return $this->parent;
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

		if ($parent = $this->parent) {
			$parent_name = $parent->complete_name;
		}

		return $parent_name ? "{$parent_name} | {$this->name}" : $this->name;
	}

	/**
	 * Checks if $label is parent of this, either direct parent or not.
	 *
	 * @return bool
	 */
	public function isParent(Label $label)
	{
		if ( ! $this->parent) {
			return FALSE;
		}

		if ($this->parent->id === $label->id) {
			return TRUE;
		}

		return $this->parent->isParent($label);
	}

	/**
	 * Called by isOptionsArray to check if $label can be included
	 * in the options
	 *
	 * @param  Label $label
	 * @param  Label $exclude_label
	 * @return bool
	 */
	protected static function isValidOption($label, $exclude_label)
	{
		if (is_null($exclude_label)) {
			return TRUE;
		}

		if ($label->id == $exclude_label->id || $label->isParent($exclude_label)) {
			return FALSE;
		}

		return TRUE;
	}

	/**
	 * Returns an array of $id => $complete_label. Accepts an array of label ids
	 * to exclude in the list. Also, this adds a default option '--None--'
	 * for no parent labels.
	 *
	 * @param  array $exclude
	 * @return array
	 */
	public static function asOptionsArray(Label $exclude_label = NULL)
	{
		$labels = array();

		foreach (self::all() as $label) {
			if (self::isValidOption($label, $exclude_label)) {
				$labels[$label->id] = $label->complete_name;
			}
		}

		natsort($labels);

		return $labels;
	}

	/**
	 *
	 * @return array
	 */
	public static function asParentOptionsArray($exclude_label = NULL)
	{
		$labels = self::asOptionsArray($exclude_label);

		return array(self::NO_PARENT_ID => '--None--') + $labels;
	}

	/**
	 * Override to return all labels ordered by name.
	 *
	 * @param  array $columns
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public static function all($columns = array())
	{
		if ( ! $columns) {
			$columns = 'labels.*';
		}

		return self::select($columns)
			->orderBy('name')
			->get();
	}
}
