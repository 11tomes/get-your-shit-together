<?php

class PrioritiesController extends AuthorizedController {

	/**
	 * Priority Repository
	 *
	 * @var Priority
	 */
	protected $priority;

	/**
	 * Color Repository
	 *
	 * @var Color
	 */
	protected $color;

	public function __construct(Priority $priority, Color $color)
	{
		parent::__construct();

		$this->priority = $priority;
		$this->color = $color;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$priorities = $this->priority->all();

		return $this->view->make('priorities.index', compact('priorities'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$colors = $this->color->all();

		return $this->view->make('priorities.create', compact('colors'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = $this->request->all();
		$validation = $this->validator->make($input, $this->priority->rules);

		if ($validation->passes()) {
			$this->priority->create($input);

			return $this->redirect->route('settings.priorities.index');
		}

		return $this->redirect->route('settings.priorities.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function show($id)
	{
		$priority = $this->priority->findOrFail($id);

		return $this->view->make('priorities.show', compact('priority'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function edit($id)
	{
		$priority = $this->priority->find($id);
		if (is_null($priority)) {
			return $this->redirect->route('settings.priorities.index');
		}

		$colors = $this->color->all();

		return $this->view->make('priorities.edit', compact('priority', 'colors'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function update($id)
	{
		$priority = $this->priority->find($id);
		if (is_null($priority)) {
			return $this->redirect->route('settings.priorities.index');
		}

		$input = array_except($this->request->all(), '_method');
		$validation = $this->validator->make($input, $this->priority->rules);

		if ($validation->passes()) {
			$priority->update($input);

			return $this->redirect->route('settings.priorities.index');
		}

		return $this->redirect->route('settings.priorities.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$priority = $this->priority->find($id);
		if ($priority) {
			$priority->delete();
		}

		return $this->redirect->route('settings.priorities.index');
	}

}
