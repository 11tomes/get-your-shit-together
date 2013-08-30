<?php

use Carbon\Carbon;

class TodosController extends BaseController {

	/**
	 * Todo Repository
	 *
	 * @var Todo
	 */
	protected $todo;

	/**
	 * List of priorities
	 *
	 * @var Illuminate\Database\Eloquent\Collection
	 */
	protected $priorities;

	/**
	 * List of labels
	 *
	 * @var Illuminate\Database\Eloquent\Collection
	 */
	protected $labels;

	/**
	 * The string to use as key when setting the redirect value
	 * in Session
	 *
	 * @var string
	 */
	protected $redirect_key;

	/**
	 * Represents the current timestamp
	 *
	 * @var Carbon
	 */
	protected $now;

	/**
	 *
	 * @param     Todo $todo
	 * @param Priority $priority
	 * @param    Label $label
	 * @param   Carbon $carbon
	 */
	public function __construct(Todo $todo, Priority $priority, Label $label, Carbon $carbon)
	{
		$this->todo = $todo;
		$this->priority = $priority;
		$this->label = $label;

		$this->priorities = $priority->all();
		$this->labels = $label->all();
		$this->now = $carbon->now();

		$this->redirect_key = 'addRedirect';

		// @todo refactor this
		Validator::extend('datetime', function($attribute, $value, $parameters) {
			try {
				// @todo use laravel tz
				Carbon::parse($value, 'America/Vancouver');
				return TRUE;
			}
			catch (\Exception $e) {
				return FALSE;
			}
		});
	}

	protected function back()
	{
		$redirect = Session::get($this->redirect_key);
		Session::forget($this->redirect_key);

		return Redirect::to($redirect);
	}

	/**
	 * Display the todos grouped by labels
	 *
	 * @return Response
	 */
	public function labels()
	{
		$labels = $this->labels;
		Session::put($this->redirect_key, Request::url());

		return View::make('todos.labels', compact('labels'));
	}

	/**
	 * Display the todos grouped by priorities
	 *
	 * @return Response
	 */
	public function priorities()
	{
		$priorities = $this->priorities;
		Session::put($this->redirect_key, Request::url());

		return View::make('todos.priorities', compact('priorities'));
	}

	/**
	 * Display the todos grouped and ordered by completion date
	 *
	 * @return Response
	 */
	public function agenda()
	{
		$completion_dates = Todo::getCompletionDates();
		Session::put($this->redirect_key, Request::url());

		return View::make('todos.agenda', compact('completion_dates'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$todos = $this->todo->all();
		$now = $this->now;

		Session::put($this->redirect_key, Request::url());

		return View::make('todos.index', compact('todos', 'now'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$priorities = $this->priority->asOptionsArray();

		$todos = array(0 => '--At the top of selected priority--');
		foreach ($this->todo->all() as $todo) {
			$todos['--Place after--'][$todo->id] = $todo->todo;
		}

		$selected_labels = Input::old('labels') ?: array();

		$labels = $this->label->asOptionsArray();

		return View::make('todos.create', compact('priorities', 'labels', 'todos', 'selected_labels'));
	}

	/**
	 * Redirect to create with old input.
	 *
	 * @return Response
	 */
	public function add()
	{
		return Redirect::route('todos.create')
			->withInput();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$todo_input = array_except(Input::all(), array('_token'));
		$labels_input = Input::get('labels');

		$validation = Validator::make($todo_input, Todo::$rules);
		if ($validation->passes()) {
			unset($todo_input['labels']);
			$todo = $this->todo->create($todo_input);

			$todo->labels()->sync($labels_input);

			return $this->back()
				->with('alert', array('info', 'Added.'));
		}

		return Redirect::route('todos.create')
			->withInput()
			->withErrors($validation)
			->with('alert', array('danger', 'There were validation errors.'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$todo = $this->todo->find($id);
		if (is_null($todo)) {
			return Redirect::route('todos.index');
		}

		$priorities = $this->priority->asOptionsArray();

		$todos = array(0 => '--At the top of selected priority--');
		foreach ($this->todo->all() as $a_todo) {
			if ($a_todo->id == $id) {
				continue;
			}

			$todos['--Place after--'][$a_todo->id] = $a_todo->todo;
		}

		$labels = $this->label->asOptionsArray();

		return View::make('todos.edit', compact('todo', 'priorities', 'labels', 'todos'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$todo_input = array_except(Input::all(), array('_method', '_token'));
		$labels_input = Input::get('labels');

		// @todo work around for Input::has
		$completed_at = Input::get('completed_at');
		$for_completion = isset($completed_at);

		if ($for_completion) {
			return $completed_at ? $this->accomplish($id) : $this->todo($id);
		}

		$validation = Validator::make($todo_input, Todo::$rules);
		if ($validation->passes()) {
			unset($todo_input['labels']);

			$todo = $this->todo->find($id);
			$todo->update($todo_input);

			$todo->labels()->sync($labels_input);

			return $this->back()
				->with('alert', array('info', 'Todo up-to-date.'));
		}

		return Redirect::route('todos.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('alert', array('danger', 'There were validation errors.'));
	}

	/**
	 * Mark a todo as completed, today.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function accomplish($id)
	{
		$todo = $this->todo->find($id);
		$top_todo = $this->todo->getTopPriority();

		if ($top_todo->id != $todo->id) {
			return Redirect::route('todos.index')
				->with('alert', array('danger', 'Nope, not that. You still have more important task to do.'));
		}

		$input = array('completed_at' => $this->now);
		$todo->update($input);

		return Redirect::route('todos.index')
			->with('alert', array('success', 'One down.'));
	}

	/**
	 * Mark a todo as not yet completed, again.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function todo($id)
	{
		$todo = $this->todo->find($id);
		$input = array('completed_at' => NULL);
		$todo->update($input);

		return Redirect::route('todos.index')
			->with('alert', array('info', 'One more, again.'));
	}

	/**
	 * Mark a todo as completed today.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function done($id)
	{
		$todo = $this->todo->find($id);
		$input = array(
			'completed_at' => $this->carbon->now()
		);
		$todo->update($input);

		return Redirect::route('todos.index', $id)
			->with('alert', array('success', 'One down.'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->todo->find($id)->delete();

		return $this->back()
			->with('alert', array('info', 'Todo discarded.'));
	}

}
