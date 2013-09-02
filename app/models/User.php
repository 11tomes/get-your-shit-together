<?php

use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;

class User extends SentryUserModel {

	/**
	 * Indicates if the model should soft delete.
	 *
	 * @var bool
	 */
	protected $softDelete = true;

	/**
	 * One (user) is to many (todos) relationship. Default order is by
	 * completion date
	 *
	 * @return Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function todos()
	{
		return $this->hasMany('Todo')
			->select('todos.*')
			->join('priorities', 'priorities.id', '=', 'todos.priority_id')
			->orderBy('priorities.order')
			->orderBy('todos.order')
			->orderBy('todos.to_be_completed_at');
	}

	/**
	 * Returns the user full name, it simply concatenates
	 * the user first and last name.
	 *
	 * @return string
	 */
	public function fullName()
	{
		return "{$this->first_name} {$this->last_name}";
	}

	/**
	 * Returns the user Gravatar image url.
	 *
	 * @return string
	 */
	public function gravatar()
	{
		// Generate the Gravatar hash
		$gravatar = md5(strtolower(trim($this->gravatar)));

		// Return the Gravatar url
		return "//gravatar.org/avatar/{$gravatar}";
	}

}
