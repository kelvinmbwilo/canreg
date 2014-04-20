@extends('layout.master')

@section('breadcumbs')
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">Patients</li>

@stop

@section('contents')

{{ Form::open(array("url"=>"patient/register/exam/{$patient->id}","class"=>"form-horizontal","id"=>"FileUploader")) }}
<div class="col-xs-12">
    <legend>Patient Examination</legend>
    <div class="col-sm-3">
        <div class='col-sm-12'>Biops Number<br>{{ Form::text('Biops_Number','',array('class'=>'form-control','placeholder'=>'Biops_Number')) }} </div>
        <div class='col-sm-12'>Biops Collected From<br>{{ Form::text('Biops_collected','',array('class'=>'form-control','placeholder'=>'Biops Collected From')) }} </div>
    </div>
    <div class="col-sm-4">
        <textarea rows="5" name="Treatment_Details" id="Treatment_Details" class="form-control"  placeholder="Treatment Details"></textarea>
    </div>
    <div class="col-sm-4">
        <textarea rows="5" name="Examination_Details" id="Examination_Details" class="form-control"  placeholder="Examination Details"></textarea>
    </div>
</div>

<div id="output1" style="padding:10px"></div>

<div class="form-group" style="margin-top: 20px">
    <div class="col-md-offset-2 col-md-8 pull-right">
        <button type="button" class="btn btn-primary" id="submitbtn">Submit</button>
    </div>
</div>
{{ Form::close() }}
<script>
    $(document).ready(function (){


        $("#submitbtn").click(function(){
            $("#output1").html("<h3><i class='fa fa-spin fa-spinner fa-3x'></i><span>Submiting Patient Information please wait...</span><h3>");
            $("#FileUploader").ajaxSubmit({
                url:"<?php echo url("patient/register/exam/{$patient->id}") ?>",
                target: '#output1',
                success:  afterSuccess
            });
        });


    });

    function afterSuccess(){
        setTimeout(function() {
            window.location.assign("<?php echo url("patients/$patient->id") ?>")
        }, 2000);

    }


</script>
@stop