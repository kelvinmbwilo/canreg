<?php

class PatientController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('patient.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make("patient.addbasic");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
           $patient = Patient::create(Input::all());
           return View::make("tumor.add",compact("patient"));
	}
        
        /**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storebasic()
	{
           $user = Patient::create(Input::all());
           return View::make("tumor.add",compact("user"));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$patient = Patient::find($id);
        return View::make('patient.followup',compact("patient"));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $patient = Patient::find($id);
        return View::make('patient.edit',compact("patient"));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $patient = Patient::find($id);
        $patient->hosptal_no     = Input::get("hosptal_no");
        $patient->lab_no         = Input::get("lab_no");
        $patient->first_name     = Input::get("first_name");
        $patient->middle_name    = Input::get("middle_name");
        $patient->last_name      = Input::get("last_name");
        $patient->gender         = Input::get("gender");
        $patient->phone          = Input::get("phone");
        $patient->date_of_birth  = Input::get("date_of_birth");
        $patient->occupation     = Input::get("occupation");
        $patient->country        = Input::get("country");
        $patient->region         = Input::get("region");
        $patient->district       = Input::get("district");
        $patient->ward           = Input::get("ward");
        $patient->village        = Input::get("village");
        $patient->ten_cell_leder = Input::get("ten_cell_leder");
        $patient->save();
        return "<h3 class='text-success'>Updated Successful</h3>";
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$patient = Patient::find($id);
        foreach($patient->tumor as $value){
            $value->delete();
        }
        foreach($patient->examination as $value){
            $value->delete();
        }
        foreach($patient->followup as $value){
            $value->delete();
        }
        foreach($patient->hiv as $value){
            $value->delete();
        }
        foreach($patient->treatment as $value){
            $value->delete();
        }

        $patient->delete();

	}

    public function check_region($id){
        if($id == "all"){
            return Form::select('district',array('all'=>'all')+District::lists('district','id'),'',array('class'=>'form-control','required'=>'requiered'));

        }else{
            return Form::select('district',Region::find($id)->district()->lists('district','id'),'',array('class'=>'form-control','required'=>'requiered'));
        }
    }

    public function createFollowup($id){
        $patient = Patient::find($id);
        return View::make("folowup.add",compact("patient"));
    }

    public function storeFollowup($id){
        Followup::create(array(
            "patient_id" => $id,
            "last_contact" => Input::get("last_date"),
            "status" => Input::get("last_status"),
            "cause_of_death" => (Input::has("death_cause"))?Input::get("death_cause"):"",
            "dr_name" => Auth::user()->id
        ));
        return Redirect::to("patients/$id");
    }

    public function deleteFollowup($id){
        $folow = Followup::find($id);
        $folow->delete();
    }

}