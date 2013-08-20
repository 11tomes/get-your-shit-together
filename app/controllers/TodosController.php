<?php

class TodosController extends BaseController {

	/**
	 * Todo Repository
	 *
	 * @var Todo
	 */
	protected $todo;

	public function __construct(Todo $todo)
	{
		$this->todo = $todo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// @todo: order by level, order
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
		return View::make('todos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Todo::$rules);

		if ($validation->passes())
		{
			$this->todo->create($input);

			return Redirect::route('todos.index');
		}

		return Redirect::route('todos.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$todo = $this->todo->findOrFail($id);

		return View::make('todos.show', compact('todo'));
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

		if (is_null($todo))
		{
			return Redirect::route('todos.index');
		}

		return View::make('todos.edit', compact('todo'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Todo::$rules);

		if ($validation->passes())
		{
			$todo = $this->todo->find($id);
			$todo->update($input);

			return Redirect::route('todos.show', $id);
		}

		return Redirect::route('todos.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
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

		return Redirect::route('todos.index');
	}

}
