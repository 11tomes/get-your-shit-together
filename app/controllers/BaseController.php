<?php

class BaseController extends Controller {

	/**
	 * Message bag.
	 *
	 * @var Illuminate\Support\MessageBag
	 */
	protected $messageBag = null;

	/**
	 *
	 * @var Session
	 */
	protected $session; 

	/**
	 *
	 * @var Session
	 */
	protected $redirect;

	/**
	 *
	 * @var View
	 */
	protected $view;

	/**
	 *
	 * @var Request
	 */
	protected $request;

	/**
	 *
	 * @var Validator
	 */
	protected $validator;

	/**
	 * Initializer.
	 *
	 */
	public function __construct()
	{
		$this->session = App::make('session');
		$this->redirect = App::make('redirect');
		$this->view = App::make('view');
		$this->request = App::make('request');
		$this->validator = App::make('validator');

		// @todo: move this to config, start or global
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->messageBag = new Illuminate\Support\MessageBag;
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = $this->view->make($this->layout);
		}
	}

}
