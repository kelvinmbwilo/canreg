<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    public function processRegion($patientquery,$value,$title=""){
        if($value != "all"){
            $title .= " From ". Region::find($value)->region. " Region ";
            $patientquery->where('region',$value);
        }
        return array($patientquery,$title);
    }
    public function processDistrict($patientquery,$value,$title=""){
        if($value != "all"){
            $title .= District::find($value)->district. " District ";
            $patientquery->where('district',$value);
        }
        return array($patientquery,$title);
    }
    public function processDaterange($patientquery,$title=""){
        if(Input::get('from') == "" || Input::get('to') == ""){

        }else{
            $title .= " Between ". date("M j, Y",strtotime(Input::get('from'))) ." And ". date("M j, Y",strtotime(Input::get('to')));
            $patientquery->whereBetween('created_at',array(Input::get('from'), Input::get('to')));
        }
        return array($patientquery,$title);
    }
    public function processGender($patientquery,$value,$title=""){
        if($value != "all"){
            $title .= $value;
            $patientquery->where('gender',$value);
        }
        return array($patientquery,$title);
    }

    public function processBehavior($patientquery,$value,$title=""){
        if($value != "all"){
            $title .= " With ". Table18::where('COL_5',$value)->first()->COL_6. " Behavior ";
            $patientquery->whereIn('id', Tumor::where('behavior',$value)->get()->lists('patient_id')+array('0'));
        }
        return array($patientquery,$title);
    }

    public function processMorphology($patientquery,$value,$title=""){
        if($value != "all"){
            $title .= " With ". Table18::where('COL_3',$value)->first()->COL_4. " Morphology ";
            $patientquery->whereIn('id', Tumor::where('morphology',$value)->get()->lists('patient_id')+array('0'));
        }
        return array($patientquery,$title);
    }

    public function processTopography($patientquery,$value,$title=""){
        if($value != "all"){
            $title .= " with ". SiteOfTumor::find($value)->value. " Topography ";
            $patientquery->whereIn('id', Tumor::where('topograph',$value)->get()->lists('patient_id')+array('0'));
        }
        return array($patientquery,$title);
    }

    public function processDiagnosis($patientquery,$value,$title=""){
        if($value != "all"){
            $title .= " Diagnosed Based on ". BasisDiagnosis::find($value)->value;
            $patientquery->whereIn('id', Tumor::where('basis_diagnosis',$value)->get()->lists('patient_id')+array('0'));
        }
        return array($patientquery,$title);
    }

    public function processStage($patientquery,$value,$title=""){
        if($value != "all"){
            $title .= " With ". $value ." Cancer Stage ";
            $patientquery->whereIn('id', Tumor::where('stage',$value)->get()->lists('patient_id')+array('0'));
        }
        return array($patientquery,$title);
    }

    public function processTratment($patientquery,$value,$title=""){
        if($value != "all"){
            $title .= " Using ". $value. " Treatment ";
            $patientquery->whereIn('id', Treatment::where('treatment',$value)->get()->lists('patient_id')+array('0'));
        }
        return array($patientquery,$title);
    }

    public function processHiv($patientquery,$value,$title=""){
        if($value != "all"){
            $title .= " With ". $value. " HIV Status ";
            $patientquery->whereIn('id', HivStatus::where('status',$value)->get()->lists('patient_id')+array('0'));
        }
        return array($patientquery,$title);
    }




    public function maxAge(){
        $query = Patient::all();
        $datearr = array();
        foreach($query as $patient) {
            $dat = strtotime($patient->date_of_birth);
            $dat1 = date("Y", $dat);
            $datearr[] = $dat1;
        }
        $len = count($datearr)-1;
        rsort($datearr,SORT_NUMERIC);
        $age  = date("Y")-$datearr[$len];
        return $age;
    }

    public function minAge(){
        $query = Patient::all();
        $datearr = array();
        foreach($query as $patient) {
            $dat = strtotime($patient->date_of_birth);
            $dat1 = date("Y", $dat);
            $datearr[] = $dat1;
        }
        $len = count($datearr)-1;
        sort($datearr,SORT_NUMERIC);
        $age  = date("Y")-$datearr[$len];
        return $age;
    }

}