<?php

class TumorController extends \BaseController {

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
		return View::make("tumor.add",compact("patient"));
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
		return View::make("tumor.folowup",compact("patient"));
	}

	/**
	 * Store a newly created resource in storage.
	 *
     * @param  int  $id
	 * @return Response
	 */
	public function store($id)
	{
        $tumor = Tumor::create(array(
            "patient_id" => $id,
            "topograph" => Input::get("topography"),
            "morphology" => Input::get("morphology"),
            "behavior" => Input::get("behavior"),
            "incidance_date" => Input::get("Incidence_Date"),
            "basis_diagnosis" => Input::get("Basis_Diagnosis"),
            "stage" => Input::get("Stage")
        ));

        Source::create(array(
           "patient_id" => $id,
           "tumor_id" => $tumor->id,
           "hosptal" => Input::get("hospital"),
           "path_lab_no" => Input::get("Path_lab_no"),
           "unit" => Input::get("Unit"),
           "case_no" => Input::get("case_no"),
        ));
        $treat = Input::get('treat');
        If(is_array($treat)){
        foreach($treat as $treatment)
        {
            Treatment::create(array(
                "patient_id" => $id,
                "tumor_id" => $tumor->id,
                "treatment" => $treatment
            ));
        }}

        //adding HIV status
        HivStatus::create(array(
            "patient_id"                => $id,
            "tumor_id" => $tumor->id,
            "status"                    =>(Input::has("hiv_status"))?Input::get("hiv_status"):"",
            "years_since_first_diagnosis"            =>(Input::has("year_since_diagnosis"))?Input::get("year_since_diagnosis"):"",
            "year_of_last_test"         =>(Input::has("last_test"))?Input::get("last_test"):"",
            "art_status"                =>(Input::has("art_status"))?Input::get("art_status"):"",
            "prev_cd4_count"            =>(Input::has("prev_cd4"))?Input::get("prev_cd4"):"",
        ));
        return "<h3 class='text-success'>Tumor Record Added Successful</h3>";
	}

    public function store1($id)
    {
        $tumor = Tumor::create(array(
            "patient_id" => $id,
            "topograph" => Input::get("topography"),
            "morphology" => Input::get("morphology"),
            "behavior" => Input::get("behavior"),
            "incidance_date" => Input::get("Incidence_Date"),
            "basis_diagnosis" => Input::get("Basis_Diagnosis"),
            "stage" => Input::get("Stage")
        ));

        Source::create(array(
            "patient_id" => $id,
            "tumor_id" => $tumor->id,
            "hosptal" => Input::get("hospital"),
            "path_lab_no" => Input::get("Path_lab_no"),
            "unit" => Input::get("Unit"),
            "case_no" => Input::get("case_no"),
        ));
        $treat = Input::get('treat');
        If(is_array($treat)){
            foreach($treat as $treatment)
            {
                Treatment::create(array(
                    "patient_id" => $id,
                    "tumor_id" => $tumor->id,
                    "treatment" => $treatment
                ));
            }}
        //adding HIV status
        HivStatus::create(array(
            "patient_id"                => $id,
            "tumor_id" => $tumor->id,
            "status"                    =>(Input::has("hiv_status"))?Input::get("hiv_status"):"",
            "years_since_first_diagnosis"            =>(Input::has("year_since_diagnosis"))?Input::get("year_since_diagnosis"):"",
            "year_of_last_test"         =>(Input::has("last_test"))?Input::get("last_test"):"",
            "art_status"                =>(Input::has("art_status"))?Input::get("art_status"):"",
            "prev_cd4_count"            =>(Input::has("prev_cd4"))?Input::get("prev_cd4"):"",
        ));
        $patient = Patient::find($id);
        return View::make("examination.add",compact("patient"));
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

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
		$tumor = Tumor::find($id);
        foreach($tumor->source as $value){
            $value->delete();
        }
        foreach($tumor->hiv as $value){
            $value->delete();
        }

        $tumor->delete();
	}

}