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
	 * The string to use as key when setting the redirect value
	 * in Session
	 *
	 * @var string
	 */
	protected $redirect_key;

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

		$this->redirect_key = 'addRedirect';

		// @todo: move this to config, start or global
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->messageBag = new Illuminate\Support\MessageBag;
	}

	/**
	 * This redirects to the previous page set using setAsPreviousPage()
	 * In other words, this "redirect to the previous page".
	 *
	 * @return Illuminate\Http\RedirectResponse 
	 */
	protected function back()
	{
		$redirect = $this->session->get($this->redirect_key);
		$this->session->forget($this->redirect_key);

		return $this->redirect->to($redirect);
	}

	/**
	 * Remember the current URL as the previous page. 
	 * Used in conjunction with back()
	 *
	 * @return self
	 */
	protected function setAsPreviousPage()
	{
		$this->session->put($this->redirect_key, $this->request->url());

		return $this;
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
