<?php

class ExaminationController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
     * @param  int  $id
	 * @return Response
	 */
	public function create($id)
	{
        $patient = Patient::find($id);
        return View::make("examination.add",compact("patient"));
	}
/**
	 * Show the form for creating a new resource.
	 *
     * @param  int  $id
	 * @return Response
	 */
	public function create1($id)
	{
        $patient = Patient::find($id);
        return View::make("examination.followup",compact("patient"));
	}

	/**
	 * Store a newly created resource in storage.
	 *
     * @param  int  $id
	 * @return Response
	 */
	public function store($id)
	{
		Examination::create(array(
            "patient_id" => $id,
            "biopsy_number" => Input::get('Biops_Number'),
            "collected_from" => Input::get('Biops_collected'),
            "examination_details" => Input::get('Examination_Details'),
            "treatment_details" => Input::get('Treatment_Details'),
        ));
        return "<h3 class='text-success'>Submitted Successful</h3>";
	}
    /**
	 * Store a newly created resource in storage.
	 *
     * @param  int  $id
	 * @return Response
	 */
	public function store1($id)
	{
		Examination::create(array(
            "patient_id" => $id,
            "biopsy_number" => Input::get('Biops_Number'),
            "collected_from" => Input::get('Biops_collected'),
            "examination_details" => Input::get('Examination_Details'),
            "treatment_details" => Input::get('Treatment_Details'),
        ));
        return View::make('patient.list');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$exam = Examination::find($id);
        $exam->delete();
	}

}