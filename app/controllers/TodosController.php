<?php

use Carbon\Carbon;

class TodosController extends BaseController {

	/**
	 * Todo Repository
	 *
	 * @var Todo
	 */
	protected $todo;

	// @todo add doc
	protected $priorities;

	protected $labels;

	/**
	 * Represents the current timestamp
	 *
	 * @var Carbon
	 */
	protected $now;

	// @todo: who passes $todo?
	public function __construct(Todo $todo)
	{
		$this->todo = $todo;
		// @todo: refactor
		$this->priorities = Priority::all();
		$this->labels = Label::all();
		$this->now = Carbon::now();
	}

	/**
	 * Display the todos grouped by label
	 *
	 * @return Response
	 */
	public function labels()
	{
		// @todo refactor, only include labels with todos?
		$labels = Label::all();

		return View::make('todos.labels', compact('labels'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$todos = $this->todo
			// where completeed at is null or completed at = today
			->orderBy('priority_id')->orderBy('order')
			->get();

		$now = $this->now;

		return View::make('todos.index', compact('todos', 'now'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// @todo: duplicate code, where will we put this?
		$priorities = array();
		foreach ($this->priorities as $priority) {
			$priorities[$priority->id] = $priority->priority;
		}

		$todo = Input::get('todo') ?: '';

		// @todo: static call?
		$labels = Label::asOptionsArray();

		return View::make('todos.create', compact('priorities', 'labels', 'todo'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$todo_input = array_except(Input::all(), array('_token', 'labels'));
		$labels_input = Input::get('labels');

		$validation = Validator::make($todo_input, Todo::$rules);
		if ($validation->passes())
		{
			$todo = $this->todo->create($todo_input);

			$todo->labels()->sync($labels_input);

			return Redirect::route('todos.index');
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

		$priorities = array();
		foreach ($this->priorities as $priority) {
			$priorities[$priority->id] = $priority->priority;
		}

		// @todo: static call
		$labels = Label::asOptionsArray();

		if (is_null($todo)) {
			return Redirect::route('todos.index');
		}

		return View::make('todos.edit', compact('todo', 'priorities', 'labels'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$todo_input = array_except(Input::all(), array('_method', '_token', 'labels'));
		$labels_input = Input::get('labels'); // @todo add validation to labels

		// @todo work around for Input::has
		$completed_at = Input::get('completed_at');
		$for_completion = isset($completed_at);

		if ($for_completion) {
			return $completed_at ? $this->accomplish($id) : $this->todo($id);
		}

		$validation = Validator::make($todo_input, Todo::$rules);
		if ($validation->passes()) {
			$todo = $this->todo->find($id);
			$todo->update($todo_input);

			$todo->labels()->sync($labels_input);

			return Redirect::route('todos.index')
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
			'completed_at' => Carbon::now()
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

		return Redirect::route('todos.index')
			->with('alert', array('success', 'One todo deleted.'));
	}

}
