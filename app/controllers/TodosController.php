<?php

use Carbon\Carbon;

class TodosController extends AuthorizedController {

	/**
	 * Todo Repository
	 *
	 * @var Todo
	 */
	protected $todo;

	/**
	 * Label Repository
	 *
	 * @var Label
	 */
	protected $label;

	/**
	 * Priority Repository
	 *
	 * @var Priority
	 */
	protected $priority;

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
		parent::__construct();

		$this->todo = $todo;
		$this->priority = $priority;
		$this->label = $label;

		$this->now = $carbon->now();

		$this->redirect_key = 'addRedirect';
	}

	/**
	 * This redirects to the previous page set by setting the value of
	 * $this->redirect_key in session
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
	 * Display the todos grouped by labels
	 *
	 * @return Response
	 */
	public function labels()
	{
		$labels = $this->label->all();
		$this->session->put($this->redirect_key, $this->request->url());

		return $this->view->make('todos.labels', compact('labels'));
	}

	/**
	 * Display the todos grouped by priorities
	 *
	 * @return Response
	 */
	public function priorities()
	{
		$priorities = $this->priority->all();
		$this->session->put($this->redirect_key, $this->request->url());

		return $this->view->make('todos.priorities', compact('priorities'));
	}

	/**
	 * Display the todos grouped and ordered by completion date
	 *
	 * @return Response
	 */
	public function agenda()
	{
		$completion_dates = $this->todo->getCompletionDates();
		$this->session->put($this->redirect_key, $this->request->url());

		return $this->view->make('todos.agenda', compact('completion_dates'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$todos = $this->user->todos;
		$now = $this->now;

		$this->session->put($this->redirect_key, $this->request->url());

		return $this->view->make('todos.index', compact('todos', 'now'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$priorities = $this->priority->asOptionsArray();

		$todos = array();
		foreach ($this->priority->all() as $priority) {
			$todos[$priority->id][0] = "--At the top of Priority {$priority->name}--";

			foreach ($priority->todos as $todo) {
				$todos[$priority->id][$todo->id] = $todo->todo;
			}
		}

		$selected_labels = $this->request->old('labels') ?: array();

		$labels = $this->label->asOptionsArray();

		$user = $this->user;

		return $this->view->make('todos.create', compact('priorities', 'labels', 'todos', 'selected_labels', 'user'));
	}

	/**
	 * Redirect to create with old input. Used for quick add.
	 *
	 * @return Response
	 */
	public function add()
	{
		return $this->redirect->route('todos.create')
			->withInput();
	}

	/**
	 * Store a newly created todo to database.
	 *
	 * @return Response
	 */
	public function store()
	{
		$todo_input = array_except($this->request->all(), array('_token'));
		$labels_input = $this->request->input('labels');

		$validation = $this->validator->make($todo_input, $this->todo->rules);
		if ($validation->passes()) {
			unset($todo_input['labels']);
			$todo = $this->todo->create($todo_input);

			$todo->labels()->sync($labels_input);

			return $this->back()
				->with('alert', array('info', 'Added.'));
		}

		return $this->redirect->route('todos.create')
			->withInput()
			->withErrors($validation)
			->with('alert', array('danger', 'There were validation errors.'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  integer $id
	 * @return Response
	 */
	public function edit($id)
	{
		$todo = $this->todo->find($id);
		if (is_null($todo)) {
			return $this->redirect->route('todos.index');
		}

		$priorities = $this->priority->asOptionsArray();

		$todos = array();
		foreach ($this->priority->all() as $priority) {
			$todos[$priority->id][0] = "--At the top of Priority {$priority->name}--";

			// pt = priority_todo
			foreach ($priority->todos as $pt) {
				if ($pt->id != $todo->id) {
					$todos[$priority->id][$pt->id] = $pt->todo;
				}
			}
		}

		$labels = $this->label->asOptionsArray();

		return $this->view->make('todos.edit', compact('todo', 'priorities', 'labels', 'todos'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  integer $id
	 * @return Response
	 */
	public function update($id)
	{
		$todo = $this->todo->find($id);
		if (is_null($todo)) {
			return $this->redirect->route('todos.index');
		}

		$input = array_except($this->request->all(), array('_method', '_token'));

		// whether completed_at is empty string or has a value,
		// then this submission is for updating that column only
		$completed_at = $this->request->input('completed_at');
		$for_completion = isset($completed_at);

		if ($for_completion) {
			return $completed_at ? $this->accomplish($id) : $this->todo($id);
		}

		$validation = $this->validator->make($input, $this->todo->rules);
		if ($validation->passes()) {
			$todo->update($input);

			return $this->back()
				->with('alert', array('info', 'Todo up-to-date.'));
		}

		return $this->redirect->route('todos.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('alert', array('danger', 'There were validation errors.'));
	}

	/**
	 * Mark a todo as completed, today.
	 *
	 * @param  integer $id
	 * @return Response
	 */
	public function accomplish($id)
	{
		$todo = $this->todo->find($id);
		$top_todo = $this->todo->getTopPriority();

		if ($top_todo->id != $todo->id) {
			return $this->redirect->route('todos.index')
				->with('alert', array('danger', 'Nope, not that. You still have more important task to do.'));
		}

		$input = array('completed_at' => $this->now);
		$todo->update($input);

		return $this->redirect->route('todos.index')
			->with('alert', array('success', 'One down.'));
	}

	/**
	 * Mark a todo as not yet completed, again.
	 *
	 * @param  integer $id
	 * @return Response
	 */
	public function todo($id)
	{
		$todo = $this->todo->find($id);
		$input = array('completed_at' => NULL);
		$todo->update($input);

		return $this->redirect->route('todos.index')
			->with('alert', array('info', 'One more, again.'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  integer $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$todo = $this->todo->find($id);
		if ($todo) {
			$todo->delete();

			return $this->back()
				->with('alert', array('info', 'Todo discarded.'));
		}

		return $this->back();
	}

}
