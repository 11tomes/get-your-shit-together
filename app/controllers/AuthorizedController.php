<?php

class AuthorizedController extends BaseController {

	/**
	 * Whitelisted auth routes.
	 *
	 * @var array
	 */
	protected $whitelist = array();

	/**
	 * Current logged in user
	 *
	 * @var User
	 */
	protected $user;

	/**
	 * Initializer.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// Apply the auth filter
		$this->beforeFilter('auth', array('except' => $this->whitelist));
		$this->user = Sentry::getUser();

		parent::__construct();
	}

}
