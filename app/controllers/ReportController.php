<?php

class ReportController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make("reports.show");
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make("reports.index");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        Report::create(array(
            "name" => Input::get("name"),
            "value" => json_encode(Input::all()),
        ));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
$value = json_decode(Report::find($id)->value);
        foreach($value as $key=>$val){
            ?>
            <input type="hidden" name="<?php echo $key ?>" value="<?php echo $val ?>">
            <?php
        }
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
		//
	}


    public function processQuery($patientquery){

        $quer = parent::processRegion($patientquery,Input::get('region'),"");
        $query = parent::processDistrict($quer[0],Input::get('district'),$quer[1]);
        $query1 = parent::processGender($query[0],Input::get('gender'),$query[1]);
        $query2 = parent::processTopography($query1[0],Input::get('topography'),$query1[1]);
        $query3 = parent::processMorphology($query2[0],Input::get('morphology'),$query2[1]);
        $query4 = parent::processBehavior($query3[0],Input::get('behavior'),$query3[1]);
        $query5 = parent::processTratment($query4[0],Input::get('Treatment'),$query4[1]);
        $query6 = parent::processHiv($query5[0],Input::get('hiv_status'),$query5[1]);
        $query7 = parent::processStage($query6[0],Input::get('Stage'),$query6[1]);
        $query8 = parent::processDiagnosis($query7[0],Input::get('Basis_Diagnosis'),$query7[1]);
        $query9 = parent::processDaterange($query8[0],$query8[1]);

        return $query9;
    }

    public function makeTable(){
        $title = "";
        $row = array();
        $column = array();
        if(Input::get("show") == "all"){
            $columntype = Array("Registration","Death");
        }else{
            if(Input::get("gender") == "all"){
                $columntype = Array("all","Male","Female");

            }elseif(Input::get("gender") == "Male"){
                $columntype = Array("Male");
            }elseif(Input::get("gender") == "Female"){
                $columntype = Array("Female");
            }
        }

        if(Input::get("horizontal") == "Year"){
            $row = array("01"=>"jan","02"=>"feb","03"=>"mar","04"=>"apr","05"=>"may","06"=>"jun","07"=>"jul","08"=>"aug","09"=>"sep","10"=>"oct","11"=>"nov","12"=>"dec");
            foreach($row as $key => $value){
                $from = Input::get('year')."-".$key."-01";
                $to = Input::get('year')."-".$key."-31";
                if(Input::get("show") == "Registration"){
                    foreach($columntype as $value1){
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "all" )?
                            $que = $query[0]->whereBetween('created_at',array($from,$to)):
                            $que = $query[0]->where("gender",$value1)->whereBetween('created_at',array($from,$to));
                        $column[$value1][] = $que->count();
                    }
                    $title = "Patient ". Input::get('show')." ". $query[1]." ".Input::get('year');;
                }elseif(Input::get("show") == "Death"){
                    foreach($columntype as $value1){
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "all" )?
                            $que = $query[0]->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to)):
                            $que = $query[0]->where("gender",$value1)->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column[$value1][] = $que->count();

                    }
                    $title ="Patient ". Input::get('show')." ". $query[1]." ".Input::get('year');
                }
                elseif(Input::get("show") == "all"){
                    foreach($columntype as $value1){
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "Registration" )?
                            $que = $query[0]->whereBetween('created_at',array($from,$to)):
                            $que = $query[0]->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column[$value1][] = $que->count();
                    }
                    $title = " Patient ". $query[1]." ".Input::get('year');
                }

            }
        }
        elseif(Input::get("horizontal") == "Years"){
            $row = range(Input::get('start'),Input::get('end'));

            foreach($row as $value){
                $from = $value."-01-01";
                $to = $value."-12-31";
                if(Input::get("show") == "Registration"){
                    foreach($columntype as $value1){
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "all" )?
                            $que = $query[0]->whereBetween('created_at',array($from,$to)):
                            $que = $query[0]->where("gender",$value1)->whereBetween('created_at',array($from,$to));
                        $column[$value1][] = $que->count();
                    }
                    $title = "Patient ".Input::get('show')." ". $query[1]." ".Input::get('start')." - ".Input::get("end");
                }elseif(Input::get("show") == "Death"){
                    foreach($columntype as $value1){
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "all" )?
                            $que = $query[0]->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to)):
                            $que = $query[0]->where("gender",$value1)->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column[$value1][] = $que->count();

                    }
                    $title = "Patient ".Input::get('show')." ". $query[1]." ".Input::get('start')." - ".Input::get("end");
                }
                elseif(Input::get("show") == "all"){
                    foreach($columntype as $value1){
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "Registration" )?
                            $que = $query[0]->whereBetween('created_at',array($from,$to)):
                            $que = $query[0]->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column[$value1][] = $que->count();
                    }
                    $title = " Patient ". $query[1]." ".Input::get('start')." ".Input::get("end");
                }

            }
        }
        elseif(Input::get("horizontal") == "Age Range"){
            //setting the limits
            if((parent::maxAge()%Input::get('age')) == 0){
                $limit = parent::maxAge();
            } else{
                $limit = (parent::maxAge()-(parent::maxAge()%Input::get('age')))+Input::get('age');
            }
            //making a loop for values
            //year iterator
            $k = parent::minAge();
            //getting age
            $range = Input::get('age');
            $yeardate = date("Y")+1;
            $yaerdate1 = $yeardate."-01-01";

            //creating title
            $data = array();
            for($i=$range+$k;$i<=$limit;$i+=$range){
                $row[] = $k ." - ". $i;
                //start year
                $time = $k*365*24*3600;
                $today = date("Y-m-d");
                $timerange = strtotime($today) - $time;
                $start  = (date("Y",$timerange)+1)."-01-01";
                //end year
                $time1 = $i*365*24*3600;
                $timerange1 = strtotime($today) - $time1;
                $end = date("Y",$timerange1)."-01-01";
                if(Input::get("show") == "Registration"){
                    foreach($columntype as $value1){
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "all" )?
                            $que = $query[0]->whereBetween('date_of_birth',array($end,$start)):
                            $que = $query[0]->where("gender",$value1)->whereBetween('date_of_birth',array($end,$start));
                        $column[$value1][] = $que->count();
                    }
                    $title = "Patient ".Input::get('show')." ". $query[1]." Age Range";;
                }elseif(Input::get("show") == "Death"){
                    foreach($columntype as $value1){
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "all" )?
                            $que = $query[0]->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('date_of_birth',array($end,$start)):
                            $que = $query[0]->where("gender",$value1)->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('date_of_birth',array($end,$start));
                        $column[$value1][] = $que->count();

                    }
                    $title = "Patient ". Input::get('show')." ". $query[1]." Age Range ";
                }
                elseif(Input::get("show") == "all"){
                    foreach($columntype as $value1){
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "Registration" )?
                            $que = $query[0]->whereBetween('date_of_birth',array($end,$start)):
                            $que = $query[0]->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('date_of_birth',array($end,$start));
                        $column[$value1][] = $que->count();
                    }
                    $title = " Patient ". $query[1]."  Age Range";
                }

                $k=$i;
            }
        }


        ?>
        <h4 class="text-center"><?php echo $title ?></h4>
        <table class="table table-responsive table-bordered">
            <tr>
                <th><?php echo Input::get("show") ?></th>
                <?php
                foreach($row as $header){
                    echo "<th>$header</th>";
                }
                ?>
            </tr>
            <?php foreach($column as $keys => $cols){ ?>
                <tr>
                    <td><?php echo $keys ?></td>
                    <?php
                    foreach($cols as $colsval){
                        echo "<td>$colsval</td>";
                    }
                    ?>
                </tr>
            <?php } ?>
        </table>

    <?php

    }

    public function makeBar(){
        $title = "";
        $row = "categories: [";
        $column = "";
        if(Input::get("show") == "all"){
            $columntype = Array("Registration","Death");
        }else{
            if(Input::get("gender") == "all"){
                $columntype = Array("all","Male","Female");

            }elseif(Input::get("gender") == "Male"){
                $columntype = Array("Male");
            }elseif(Input::get("gender") == "Female"){
                $columntype = Array("Female");
            }
        }

        if(Input::get("horizontal") == "Year"){
            $row1 = array("01"=>"jan","02"=>"feb","03"=>"mar","04"=>"apr","05"=>"may","06"=>"jun","07"=>"jul","08"=>"aug","09"=>"sep","10"=>"oct","11"=>"nov","12"=>"dec");
            $j = 1;
            foreach($row1 as $value){
                $row .= ($j < count($row1))?"'".$value."',":"'".$value."'";
                $j++;
            }
            $col = 1;
            if(Input::get("show") == "Registration"){
                foreach($columntype as $value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = Input::get('year')."-".$key."-01";
                        $to = Input::get('year')."-".$key."-31";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "all" )?
                            $que = $query[0]->whereBetween('created_at',array($from,$to)):
                            $que = $query[0]->where("gender",$value1)->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }elseif(Input::get("show") == "Death"){
                foreach($columntype as $value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = Input::get('year')."-".$key."-01";
                        $to = Input::get('year')."-".$key."-31";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "all" )?
                            $que = $query[0]->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to)):
                            $que = $query[0]->where("gender",$value1)->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();

                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }elseif(Input::get("show") == "all"){
                foreach($columntype as $value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = Input::get('year')."-".$key."-01";
                        $to = Input::get('year')."-".$key."-31";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "Registration" )?
                            $que = $query[0]->whereBetween('created_at',array($from,$to)):
                            $que = $query[0]->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();

                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }
            $title = (Input::get('show')=='all')?" Patient ".$query[1]." ".Input::get('Year'):"Patient ".Input::get('show')." ". $query[1]." ".Input::get('Year');
        }
        elseif(Input::get("horizontal") == "Years"){
            $row1 = range(Input::get('start'),Input::get('end'));
            $j = 1;
            foreach($row1 as $value){
                $row .= ($j < count($row1))?"'".$value."',":"'".$value."'";
                $j++;
            }
            $col = 1;
            if(Input::get("show") == "Registration"){
                foreach($columntype as $value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = $value."-01-01";
                        $to = $value."-12-31";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "all" )?
                            $que = $query[0]->whereBetween('created_at',array($from,$to)):
                            $que = $query[0]->where("gender",$value1)->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }elseif(Input::get("show") == "Death"){
                foreach($columntype as $value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = $value."-01-01";
                        $to = $value."-12-31";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "all" )?
                            $que = $query[0]->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to)):
                            $que = $query[0]->where("gender",$value1)->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();

                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }elseif(Input::get("show") == "all"){
                foreach($columntype as $value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = $value."-01-01";
                        $to = $value."-12-31";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "Registration" )?
                            $que = $query[0]->whereBetween('created_at',array($from,$to)):
                            $que = $query[0]->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();

                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }
            $title = (Input::get('show')=='all')?"Patient". $query[1]." ".Input::get('start')." - ".Input::get('end') :"Patient ".Input::get('show')." ". $query[1]." ".Input::get('start')." - ".Input::get('end') ;
        }
        elseif(Input::get("horizontal") == "Age Range"){
            //setting the limits
            if((parent::maxAge()%Input::get('age')) == 0){
                $limit = parent::maxAge();
            } else{
                $limit = (parent::maxAge()-(parent::maxAge()%Input::get('age')))+Input::get('age');
            }
            //making a loop for values
            //year iterator
            $k = parent::minAge();
            //getting age
            $range = Input::get('age') + $k;
            $yeardate = date("Y")+1;
            $yaerdate1 = $yeardate."-01-01";

            //creating title

            for($i=$range;$i<=$limit;$i+=$range){
                $row .= ($i < $limit)?"'".$k ." - ". $i."',":"'".$k ." - ". $i."'";
                $k=$i;
            }
            $col = 1;
            if(Input::get("show") == "Registration"){
                foreach($columntype as $value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    for($i=$range;$i<=$limit;$i+=$range){
                        //start year
                        $time = $k*365*24*3600;
                        $today = date("Y-m-d");
                        $timerange = strtotime($today) - $time;
                        $start  = (date("Y",$timerange)+1)."-01-01";
                        //end year
                        $time1 = $i*365*24*3600;
                        $timerange1 = strtotime($today) - $time1;
                        $end = date("Y",$timerange1)."-01-01";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "all" )?
                            $que = $query[0]->whereBetween('date_of_birth',array($end,$start)):
                            $que = $query[0]->where("gender",$value1)->whereBetween('date_of_birth',array($end,$start));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }
            elseif(Input::get("show") == "Death"){
                foreach($columntype as $value1){
                    $column.= "{ name: '".$value1."', data: [ ";

                    for($i=$range;$i<=$limit;$i+=$range){
                        //start year
                        $time = $k*365*24*3600;
                        $today = date("Y-m-d");
                        $timerange = strtotime($today) - $time;
                        $start  = (date("Y",$timerange)+1)."-01-01";
                        //end year
                        $time1 = $i*365*24*3600;
                        $timerange1 = strtotime($today) - $time1;
                        $end = date("Y",$timerange1)."-01-01";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "all" )?
                            $que = $query[0]->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('date_of_birth',array($end,$start)):
                            $que = $query[0]->where("gender",$value1)->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('date_of_birth',array($end,$start));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }elseif(Input::get("show") == "all"){
                foreach($columntype as $value1){
                    $column.= "{ name: '".$value1."', data: [ ";

                    for($i=$range;$i<=$limit;$i+=$range){
                        //start year
                        $time = $k*365*24*3600;
                        $today = date("Y-m-d");
                        $timerange = strtotime($today) - $time;
                        $start  = (date("Y",$timerange)+1)."-01-01";
                        //end year
                        $time1 = $i*365*24*3600;
                        $timerange1 = strtotime($today) - $time1;
                        $end = date("Y",$timerange1)."-01-01";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "Registration" )?
                            $que = $query[0]->whereBetween('date_of_birth',array($end,$start)):
                            $que = $query[0]->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('date_of_birth',array($end,$start));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }

            $title = (Input::get('show')== 'all')?"Patient". $query[1]." Age Range":"Patient ".Input::get('show'). $query[1]." Age Range ";

        }
        $row .= "]";

        echo $row;
        ?>
        <script type="text/javascript">
            $(function () {
                $('#chartarea').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: '<?php echo $title ?>'
                    },
                    xAxis: {
                        <?php echo $row  ?>
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: '<?php echo (Input::get('show')=='all')?"Patients ":" Patients ".Input::get('show') ?>'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:12px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0"> {series.name} :   </td> ' +
                            '<td style="padding:0"><b>{point.y}  </b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [<?php echo $column ?>]
                });
            });


        </script>
    <?php

    }

    public function makeLine(){
        $title = "";
        $row = "categories: [";
        $column = "";
        if(Input::get("show") == "all"){
            $columntype = Array("Registration","Death");
        }else{
            if(Input::get("gender") == "all"){
                $columntype = Array("all","Male","Female");

            }elseif(Input::get("gender") == "Male"){
                $columntype = Array("Male");
            }elseif(Input::get("gender") == "Female"){
                $columntype = Array("Female");
            }
        }

        if(Input::get("horizontal") == "Year"){
            $row1 = array("01"=>"jan","02"=>"feb","03"=>"mar","04"=>"apr","05"=>"may","06"=>"jun","07"=>"jul","08"=>"aug","09"=>"sep","10"=>"oct","11"=>"nov","12"=>"dec");
            $j = 1;
            foreach($row1 as $value){
                $row .= ($j < count($row1))?"'".$value."',":"'".$value."'";
                $j++;
            }
            $col = 1;
            if(Input::get("show") == "Registration"){
                foreach($columntype as $value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = Input::get('year')."-".$key."-01";
                        $to = Input::get('year')."-".$key."-31";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "all" )?
                            $que = $query[0]->whereBetween('created_at',array($from,$to)):
                            $que = $query[0]->where("gender",$value1)->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }elseif(Input::get("show") == "Death"){
                foreach($columntype as $value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = Input::get('year')."-".$key."-01";
                        $to = Input::get('year')."-".$key."-31";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "all" )?
                            $que = $query[0]->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to)):
                            $que = $query[0]->where("gender",$value1)->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();

                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }elseif(Input::get("show") == "all"){
                foreach($columntype as $value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = Input::get('year')."-".$key."-01";
                        $to = Input::get('year')."-".$key."-31";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "Registration" )?
                            $que = $query[0]->whereBetween('created_at',array($from,$to)):
                            $que = $query[0]->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();

                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }
            $title = (Input::get('show')=='all')?" Patient ".$query[1]." ".Input::get('Year'):"Patient ".Input::get('show')." ". $query[1]." ".Input::get('Year');
        }
        elseif(Input::get("horizontal") == "Years"){
            $row1 = range(Input::get('start'),Input::get('end'));
            $j = 1;
            foreach($row1 as $value){
                $row .= ($j < count($row1))?"'".$value."',":"'".$value."'";
                $j++;
            }
            $col = 1;
            if(Input::get("show") == "Registration"){
                foreach($columntype as $value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = $value."-01-01";
                        $to = $value."-12-31";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "all" )?
                            $que = $query[0]->whereBetween('created_at',array($from,$to)):
                            $que = $query[0]->where("gender",$value1)->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }elseif(Input::get("show") == "Death"){
                foreach($columntype as $value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = $value."-01-01";
                        $to = $value."-12-31";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "all" )?
                            $que = $query[0]->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to)):
                            $que = $query[0]->where("gender",$value1)->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();

                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }elseif(Input::get("show") == "all"){
                foreach($columntype as $value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = $value."-01-01";
                        $to = $value."-12-31";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "Registration" )?
                            $que = $query[0]->whereBetween('created_at',array($from,$to)):
                            $que = $query[0]->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();

                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }
            $title = (Input::get('show')=='all')?"Patient". $query[1]." ".Input::get('start')." - ".Input::get('end') :"Patient ".Input::get('show')." ". $query[1]." ".Input::get('start')." - ".Input::get('end') ;
        }
        elseif(Input::get("horizontal") == "Age Range"){
            //setting the limits
            if((parent::maxAge()%Input::get('age')) == 0){
                $limit = parent::maxAge();
            } else{
                $limit = (parent::maxAge()-(parent::maxAge()%Input::get('age')))+Input::get('age');
            }
            //making a loop for values
            //year iterator
            $k = parent::minAge();
            //getting age
            $range = Input::get('age') + $k;
            $yeardate = date("Y")+1;
            $yaerdate1 = $yeardate."-01-01";

            //creating title

            for($i=$range;$i<=$limit;$i+=$range){
                $row .= ($i < $limit)?"'".$k ." - ". $i."',":"'".$k ." - ". $i."'";
                $k=$i;
            }
            $col = 1;
            if(Input::get("show") == "Registration"){
                foreach($columntype as $value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    for($i=$range;$i<=$limit;$i+=$range){
                        //start year
                        $time = $k*365*24*3600;
                        $today = date("Y-m-d");
                        $timerange = strtotime($today) - $time;
                        $start  = (date("Y",$timerange)+1)."-01-01";
                        //end year
                        $time1 = $i*365*24*3600;
                        $timerange1 = strtotime($today) - $time1;
                        $end = date("Y",$timerange1)."-01-01";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "all" )?
                            $que = $query[0]->whereBetween('date_of_birth',array($end,$start)):
                            $que = $query[0]->where("gender",$value1)->whereBetween('date_of_birth',array($end,$start));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }
            elseif(Input::get("show") == "Death"){
                foreach($columntype as $value1){
                    $column.= "{ name: '".$value1."', data: [ ";

                    for($i=$range;$i<=$limit;$i+=$range){
                        //start year
                        $time = $k*365*24*3600;
                        $today = date("Y-m-d");
                        $timerange = strtotime($today) - $time;
                        $start  = (date("Y",$timerange)+1)."-01-01";
                        //end year
                        $time1 = $i*365*24*3600;
                        $timerange1 = strtotime($today) - $time1;
                        $end = date("Y",$timerange1)."-01-01";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "all" )?
                            $que = $query[0]->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('date_of_birth',array($end,$start)):
                            $que = $query[0]->where("gender",$value1)->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('date_of_birth',array($end,$start));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }elseif(Input::get("show") == "all"){
                foreach($columntype as $value1){
                    $column.= "{ name: '".$value1."', data: [ ";

                    for($i=$range;$i<=$limit;$i+=$range){
                        //start year
                        $time = $k*365*24*3600;
                        $today = date("Y-m-d");
                        $timerange = strtotime($today) - $time;
                        $start  = (date("Y",$timerange)+1)."-01-01";
                        //end year
                        $time1 = $i*365*24*3600;
                        $timerange1 = strtotime($today) - $time1;
                        $end = date("Y",$timerange1)."-01-01";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        ($value1 == "Registration" )?
                            $que = $query[0]->whereBetween('date_of_birth',array($end,$start)):
                            $que = $query[0]->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('date_of_birth',array($end,$start));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }

            $title = (Input::get('show')== 'all')?"Patient". $query[1]." Age Range":"Patient ".Input::get('show'). $query[1]." Age Range";

        }

        $row .= "]";

        echo $row;
        ?>
        <script type="text/javascript">
            $(function () {
                $('#chartarea').highcharts({
                    title: {
                        text: '<?php echo $title ?>'
                    },
                    xAxis: {
                        <?php echo $row  ?>
                    },
                    yAxis: {
                        title: {
                            text: '<?php echo (Input::get('show')=='all')?"Patients ":" Patients ".Input::get('show') ?>'
                        },
                        plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                    },
                    tooltip: {
                        valueSuffix: '<?php  Input::get('vertical') ?>'
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle',
                        borderWidth: 0
                    },
                    series: [<?php echo $column ?>]
                });
            });
        </script>
    <?php

    }
    public function makePie(){
        $title = "";
        $data = "[";
        $row = "categories: [";
        if(Input::get("horizontal") == "Year"){
            $row1 = array("01"=>"jan","02"=>"feb","03"=>"mar","04"=>"apr","05"=>"may","06"=>"jun","07"=>"jul","08"=>"aug","09"=>"sep","10"=>"oct","11"=>"nov","12"=>"dec");
            $j = 1;
            $i=1;
            foreach($row1 as $value){
                $row .= ($j < count($row1))?"'".$value."',":"'".$value."'";
                $j++;
            }
            if(Input::get("show") == "Registration"){
                foreach($row1 as $key => $value){
                    $from = Input::get('year')."-".$key."-01";
                    $to = Input::get('year')."-".$key."-31";
                    $patientquery = DB::table('patients');
                    $query = $this->processQuery($patientquery);
                    $que = $query[0]->whereBetween('created_at',array($from,$to));
                    $data .= ($i < count($row1))?"['$value',{$que->count()}],":"['$value',{$que->count()}]";
                    $i++;
                }

            }elseif(Input::get("show") == "Death"){

                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = Input::get('year')."-".$key."-01";
                        $to = Input::get('year')."-".$key."-31";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        $que = $query[0]->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $data .= ($i < count($row1))?"['$value',{$que->count()}],":"['$value',{$que->count()}]";
                        $i++;
                }
            }elseif(Input::get("show") == "all"){
                foreach($row1 as $key => $value){
                    $from = Input::get('year')."-".$key."-01";
                    $to = Input::get('year')."-".$key."-31";
                    $patientquery = DB::table('patients');
                    $query = $this->processQuery($patientquery);
                    $que = $query[0]->whereBetween('created_at',array($from,$to));
                    $data .= ($i < count($row1))?"['$value',{$que->count()}],":"['$value',{$que->count()}]";
                    $i++;
                }

            }
            $title = (Input::get('show')=='all')?" Patient ".$query[1]." ".Input::get('Year'):"Patient ".Input::get('show')." ". $query[1]." ".Input::get('Year');
        }
        elseif(Input::get("horizontal") == "Years"){
            $row1 = range(Input::get('start'),Input::get('end'));

            if(Input::get("show") == "Registration"){
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = $value."-01-01";
                        $to = $value."-12-31";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        $que = $query[0]->whereBetween('created_at',array($from,$to));
                        $data .= ($i < count($row1))?"['$value',{$que->count()}],":"['$value',{$que->count()}]";
                        $i++;

                }
            }elseif(Input::get("show") == "Death"){
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = $value."-01-01";
                        $to = $value."-12-31";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        $que = $query[0]->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $data .= ($i < count($row1))?"['$value',{$que->count()}],":"['$value',{$que->count()}]";
                        $i++;

                }
            }elseif(Input::get("show") == "all"){
                $i = 1;
                foreach($row1 as $key => $value){
                    $from = $value."-01-01";
                    $to = $value."-12-31";
                    $patientquery = DB::table('patients');
                    $query = $this->processQuery($patientquery);
                    $que = $query[0]->whereBetween('created_at',array($from,$to));
                    $data .= ($i < count($row1))?"['$value',{$que->count()}],":"['$value',{$que->count()}]";
                    $i++;

                }
            $title = (Input::get('show')=='all')?"Patient". $query[1]." ".Input::get('start')." - ".Input::get('end') :"Patient ".Input::get('show')." ". $query[1]." ".Input::get('start')." - ".Input::get('end') ;
        }

        }
        elseif(Input::get("horizontal") == "Age Range"){
            //setting the limits
            if((parent::maxAge()%Input::get('age')) == 0){
                $limit = parent::maxAge();
            } else{
                $limit = (parent::maxAge()-(parent::maxAge()%Input::get('age')))+Input::get('age');
            }
            //making a loop for values
            //year iterator
            $k = parent::minAge();
            //getting age
            $range = Input::get('age') + $k;
            $yeardate = date("Y")+1;
            $yaerdate1 = $yeardate."-01-01";

            //creating title

            if(Input::get("show") == "Registration"){

                    for($i=$range;$i<=$limit;$i+=$range){
                        //start year
                        $time = $k*365*24*3600;
                        $today = date("Y-m-d");
                        $timerange = strtotime($today) - $time;
                        $start  = (date("Y",$timerange)+1)."-01-01";
                        //end year
                        $time1 = $i*365*24*3600;
                        $timerange1 = strtotime($today) - $time1;
                        $end = date("Y",$timerange1)."-01-01";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        $que = $query[0]->whereBetween('date_of_birth',array($end,$start));
                        $data .= ($i < $limit)?"['".$k ." - ". $i."',{$que->count()}],":"['".$k ." - ". $i."',{$que->count()}]";
                        $k=$i;

                }
            }
            elseif(Input::get("show") == "Death"){
                    for($i=$range;$i<=$limit;$i+=$range){
                        //start year
                        $time = $k*365*24*3600;
                        $today = date("Y-m-d");
                        $timerange = strtotime($today) - $time;
                        $start  = (date("Y",$timerange)+1)."-01-01";
                        //end year
                        $time1 = $i*365*24*3600;
                        $timerange1 = strtotime($today) - $time1;
                        $end = date("Y",$timerange1)."-01-01";
                        $patientquery = DB::table('patients');
                        $query = $this->processQuery($patientquery);
                        $que = $query[0]->whereIn('id', Followup::where('status','Dead')->get()->lists('patient_id')+array('0'))->whereBetween('date_of_birth',array($end,$start));
                        $data .= ($i < $limit)?"['".$k ." - ". $i."',{$que->count()}],":"['".$k ." - ". $i."',{$que->count()}]";
                        $k=$i;

                }
            }elseif(Input::get("show") == "all"){
                for($i=$range;$i<=$limit;$i+=$range){
                    //start year
                    $time = $k*365*24*3600;
                    $today = date("Y-m-d");
                    $timerange = strtotime($today) - $time;
                    $start  = (date("Y",$timerange)+1)."-01-01";
                    //end year
                    $time1 = $i*365*24*3600;
                    $timerange1 = strtotime($today) - $time1;
                    $end = date("Y",$timerange1)."-01-01";
                    $patientquery = DB::table('patients');
                    $query = $this->processQuery($patientquery);
                    $que = $query[0]->whereBetween('date_of_birth',array($end,$start));
                    $data .= ($i < $limit)?"['".$k ." - ". $i."',{$que->count()}],":"['".$k ." - ". $i."',{$que->count()}]";
                    $k=$i;

                }
            }

            $title = (Input::get('show')== 'all')?"Patient". $query[1]." Age Range":"Patient ".Input::get('show'). $query[1]." Age Range";

        }

        $data .= "]";
        ?>
        <script type="text/javascript">
            $(function () {
                var chart;

                $(document).ready(function () {

                    // Build the chart
                    $('#chartarea').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false
                        },
                        title: {
                            text: '<?php echo $title ?>'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.y}</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        series: [{
                            type: 'pie',
                            name: '<?php echo (Input::get('show')=='all')?"Patients ":" Patients ".Input::get('show') ?>',
                            data: <?php echo $data ?>
                        }]
                    });
                });

            });
        </script>
    <?php

    }
}