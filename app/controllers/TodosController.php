<?php

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

	// @todo: who passes $todo?
	public function __construct(Todo $todo)
	{
		$this->todo = $todo;
		// @todo: refactor
		$this->priorities = Priority::all();
		$this->labels = Label::all();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// @todo: order by level, order, and add labels and priorities
		$todos = $this->todo->all();

		return View::make('todos.index', compact('todos'));
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

		$labels = array();
		foreach ($this->labels as $label) {
			$labels[$label->id] = $label->label;
		}

		return View::make('todos.create', compact('priorities', 'labels'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$todo_input = array_except(Input::all(), array('priorities', 'labels'));
		$priorities_input = Input::get('priorities');
		$labels_input = Input::get('labels');

		$validation = Validator::make($todo_input, Todo::$rules);
		if ($validation->passes())
		{
			$todo = $this->todo->create($todo_input);

			$todo->priorities()->sync($priorities_input);
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

		$labels = array();
		foreach ($this->labels as $label) {
			$labels[$label->id] = $label->label;
		}

		if (is_null($todo))
		{
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
		$todo_input = array_except(Input::all(), array('_method', 'priorities', 'labels'));
		$priorities_input = Input::get('priorities');
		$labels_input = Input::get('labels');

		$validation = Validator::make($todo_input, Todo::$rules);
		if ($validation->passes())
		{
			$todo = $this->todo->find($id);
			$todo->update($todo_input);

			$todo->priorities()->sync($priorities_input);
			$todo->labels()->sync($labels_input);

			return Redirect::route('todos.index');
		}

		return Redirect::route('todos.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('alert', array('danger', 'There were validation errors.'));
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
