<?php

class LabelsController extends AuthorizedController {

	/**
	 * Label Repository
	 *
	 * @var Label
	 */
	protected $label;

	/**
	 * Color repository.
	 *
	 * @var color
	 */
	protected $color;

	/**
	 *
	 * @param Label $label
	 */
	public function __construct(Label $label, Color $color)
	{
		parent::__construct();

		$this->label = $label;
		$this->color = $color;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$labels = $this->label->all();

		return $this->view->make('labels.index', compact('labels'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$labels = $this->label->asParentOptionsArray();
		$colors = $this->color->all();

		return $this->view->make('labels.create', compact('labels', 'colors'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = $this->request->all();
		$validation = $this->validator->make($input, $this->label->rules);

		if ($validation->passes()) {
			$this->label->create($input);

			return $this->redirect->route('settings.labels.index');
		}

		return $this->redirect->route('settings.labels.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  integer $id
	 * @return Response
	 */
	public function edit($id)
	{
		$label = $this->label->find($id);
		if (is_null($label)) {
			return $this->redirect->route('settings.labels.index');
		}

		$labels = $this->label->asParentOptionsArray($label);
		$colors = $this->color->all();

		return $this->view->make('labels.edit', compact('label', 'labels', 'colors'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  integer $id
	 * @return Response
	 */
	public function update($id)
	{
		$label = $this->label->find($id);
		if (is_null($label)) {
			return $this->redirect->route('settings.labels.index');
		}

		$input = array_except($this->request->all(), '_method');
		$validation = $this->validator->make($input, $this->label->rules);

		if ($validation->passes()) {
			$label = $this->label->find($id);
			$label->update($input);

			return $this->redirect->route('settings.labels.index');
		}

		return $this->redirect->route('settings.labels.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  integer $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$label = $this->label->find($id);
		if ($label) {
			$label->delete();
		}

		return $this->redirect->route('settings.labels.index');
	}

}
