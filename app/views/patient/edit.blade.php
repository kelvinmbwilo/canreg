@extends('layout.master')

@section('breadcumbs')
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li>
    <a href="{{ url('home') }}">Patients</a>
</li>
<li>
    <a href='{{ url("patients/{$patient->id}") }}'>{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}</a>
</li>
<li class="active">Update Information</li>

@stop

@section('contents')
@section('contents')

    {{ Form::open(array("url"=>"patient/edit/{$patient->id}","class"=>"form-horizontal","id"=>"FileUploader")) }}
    <h3>Update Patient Basic Information</h3>
    <div class='form-group'>
        <div class='col-sm-3'>Hospital Number<br>{{ Form::text('hosptal_no',$patient->hosptal_no,array('class'=>'form-control','placeholder'=>'Hospital Number')) }} </div>
        <div class='col-sm-3'>Lab_no<br>{{ Form::text('lab_no',$patient->lab_no,array('class'=>'form-control','placeholder'=>'Path Lab_no')) }} </div>
        <div class='col-sm-3'>First Name<br>{{ Form::text('first_name',$patient->first_name,array('class'=>'form-control','placeholder'=>'First Name','required'=>'requiered')) }} </div>
        <div class='col-sm-3'>Middle Name<br>{{ Form::text('middle_name',$patient->middle_name,array('class'=>'form-control','placeholder'=>'Middle Name')) }} </div>
    </div>



    <div class='form-group'>
        <div class='col-sm-3'>Last Name<br>{{ Form::text('last_name',$patient->last_name,array('class'=>'form-control','placeholder'=>'Last Name','required'=>'requiered')) }} </div>
        <div class='col-sm-3'>Gender<br>{{ Form::select('gender',array('Male'=>'Male','Female'=>'Female'),$patient->gender,array('class'=>'form-control','required'=>'requiered')) }}  </div>
        <div class='col-sm-3'>Birth Date<br>{{ Form::text('date_of_birth',$patient->date_of_birth,array('class'=>'form-control','placeholder'=>'Birth Date','required'=>'requiered','id'=>'Birth_Date')) }} </div>
        <div class='col-sm-3'>Phone Number<br>{{ Form::text('phone',$patient->phone,array('class'=>'form-control','placeholder'=>'Phone Number')) }} </div>
    </div>


    <div class='form-group'>
        <div class='col-sm-3'>Occupation<br>{{ Form::text('occupation',$patient->occupation,array('class'=>'form-control','placeholder'=>'Occupation')) }} </div>
        <div class='col-sm-3'>Country<br>{{ Form::select('country',Country::all()->lists("name","id"),$patient->country,array('class'=>'form-control','required'=>'requiered')) }}  </div>
        <div class='col-sm-3'>Region<br>{{ Form::select('region',Region::all()->lists("region","id"),$patient->region,array('class'=>'form-control','required'=>'requiered')) }} </div>
        <div class='col-sm-3'>District<br><span id="district-area">{{ Form::select('district',District::all()->lists('district','id'),$patient->district,array('class'=>'form-control','required'=>'requiered')) }} </span> </div>
    </div>

    <div class='form-group'>
        <div class='col-sm-3'>Ward<br>{{ Form::text('ward',$patient->ward,array('class'=>'form-control','placeholder'=>'Ward')) }} </div>
        <div class='col-sm-3'>Village<br>{{ Form::text('village',$patient->village,array('class'=>'form-control','placeholder'=>'Village')) }} </div>
        <div class='col-sm-3'>Ten Cell Leder<br>{{ Form::text('ten_cell_leder',$patient->ten_cell_leder,array('class'=>'form-control','placeholder'=>'Ten Cell Leder')) }} </div>

    </div>
<div id="output"></div>
    <div class='form-group text-center'>
        {{ Form::submit('Update',array('class'=>'btn btn-primary')) }}

    </div>

    {{ Form::close() }}

<script>
    $(document).ready(function (){
        $("#Birth_Date").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:<?php date("Y") ?>",
            dateFormat:"yy-mm-dd"
        });
        $('#FileUploader').on('submit', function(e) {
            e.preventDefault();
            $("#output").html("<h3><i class='fa fa-spin fa-spinner fa-3x'></i><span>Submiting Patient Information please wait...</span><h3>");
            $(this).ajaxSubmit({
                target: '#output',
                success:  afterSuccess
            });

        });

        $("select[name=region]").change(function(){
            $("#district-area").html("<i class='fa fa-spinner fa-spin'></i> Wait... ")
            $.post("<?php echo url('patient/region_check') ?>/"+$(this).val(),function(dat){
                $("#district-area").html(dat);
            })
        })

        function afterSuccess(){
            setTimeout(function() {
                window.location.assign("<?php echo url("patients/$patient->id") ?>")
            }, 2000);

        }
    });

</script>
@stop