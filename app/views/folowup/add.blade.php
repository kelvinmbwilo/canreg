@extends('layout.master')

@section('breadcumbs')
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">Patients</li>

@stop

@section('contents')
<h3 style="padding: 10px">{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }} Followup</h3>
{{ Form::open(array("url"=>"patient/add/folowup/{$patient->id}","class"=>"form-horizontal","id"=>"FileUploader")) }}

    <!--Diagnosis Details-->
    <div class="form-group">
        <label for="Date" class="col-md-2 control-label">Date of last contact</label>
        <div class="col-md-4">
            <input type="text" id="last_date" name="last_date" id="last_date" class="form-control" placeholder="Date of last contact" required="">
        </div>
    </div>

    <!--Examination Details-->
    <div class="form-group">
        <label for="Middle_Name" class="col-md-2 control-label">Status at last contact</label>
        <div class="col-md-4">
            <?php
            $statusarr = array("Alive"=>"Alive","Dead"=>"Dead","Not Known"=>"Not Known");
            ?>
        {{ Form::select('last_status',$statusarr,'466',array('class'=>'form-control','required'=>'requiered')) }}

        </div>
    </div>
    <!--Treatment Details-->
    <div class="form-group death">
        <label for="Diagnosis_Done_Before" class="col-md-2 control-label">Cause of death <br>(Leave if not applicable)</label>
        <div class="col-md-4">
            <?php
            $causearr = array("This cancer"=>"This cancer","0ther cause"=>"0ther cause","Not Known"=>"Not Known");
            ?>
            {{ Form::select('death_cause',$causearr,'',array('class'=>'form-control','required'=>'requiered')) }}

        </div>
    </div>


    <div class="form-group">
        <div class="col-md-offset-2 col-md-8 pull-right">
            <button type="reset" class="btn btn-warning" id="loginbtn">Reset</button>
            <button type="submit" class="btn btn-info followbtn" id="followbtn">Done</button>
        </div>
    </div>
    {{ Form::close() }}
<script>
    $(document).ready(function (){
        $("#last_date").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:"yy-mm-dd"
        });

        var death = $(".death").html();
        $(".death").html("")
        $("select[name=last_status").change(function(){
            if($(this).val() == "Dead"){
                $(".death").html(death)
            }else{
                $(".death").html("")
            }
        })
    })
</script>
@stop