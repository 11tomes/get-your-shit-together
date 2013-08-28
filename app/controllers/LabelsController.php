<?php

class LabelsController extends BaseController {

	/**
	 * Label Repository
	 *
	 * @var Label
	 */
	protected $label;

	public function __construct(Label $label)
	{
		$this->label = $label;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$labels = $this->label->all();

		return View::make('labels.index', compact('labels'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$labels = $this->label->asOptionsArray();
		$colors = Color::all();

		return View::make('labels.create', compact('labels', 'colors'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Label::$rules);

		if ($validation->passes())
		{
			$this->label->create($input);

			return Redirect::route('settings.labels.index');
		}

		return Redirect::route('settings.labels.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$label = $this->label->find($id);
		$labels = $this->label->asOptionsArray();
		unset($labels[$label->id]);

		if (is_null($label))
		{
			return Redirect::route('settings.labels.index');
		}

		return View::make('labels.edit', compact('label', 'labels'));
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
		$validation = Validator::make($input, Label::$rules);

		if ($validation->passes())
		{
			$label = $this->label->find($id);
			$label->update($input);

			return Redirect::route('settings.labels.index');
		}

		return Redirect::route('settings.labels.edit', $id)
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
		$this->label->find($id)->delete();

		return Redirect::route('settings.labels.index');
	}

}
