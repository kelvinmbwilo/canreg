@extends('layout.master')

@section('breadcumbs')
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">Patients</li>

@stop

@section('contents')
@if(Report::all()->count() == 0)
  <h3 class="text-center"> There Are No Saved Reports </h3>
@else
{{ Form::open(array("url"=>url("reports/process/"),"class"=>"form-horizontal","id"=>'formms')) }}
{{ Form::close() }}
<div class='col-sm-9' style="padding:15px">{{ Form::select('reports',Report::all()->lists("name","id"),'',array('class'=>'form-control','required'=>'requiered')) }} </div>
<h3 class="text-center title"></h3>
<div class="col-xs-12" style="margin-top: 25px">
    <div class="col-md-2 btn btn-primary" id="table">Table</div>
    <div class="col-md-1"></div>
    <div class="col-md-2 btn btn-primary" id="bar">Bar</div>
    <div class="col-md-1"></div>
    <div class="col-md-2 btn btn-primary" id="line">Line</div>
    <div class="col-md-1"></div>
    <div class="col-md-2 btn btn-primary" id="pie">Pie</div>

</div>

<div id="chartarea" class="col-xs-12" style="margin-top: 25px">
    <script>
        $(document).ready(function (){

            //managing chats buttons
            $("#table").unbind("click").click(function(){
                $(".btn").removeClass("btn-info")
                $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
                $(this).addClass("btn-info")
                $.post("<?php echo url("getjason") ?>/"+$("select[name=reports]").val(),function(data){
                   $("#formms").html(data)
                    $("#formms").ajaxSubmit({
                        url:"<?php echo url('report/table') ?>",
                        target: '#chartarea',
                        success:  afterSuccess
                    });
                })

            });
            $("#table").trigger("click");

            $("#pie").unbind("click").click(function(){
                $(".btn").removeClass("btn-info")
                $(this).addClass("btn-info")
                $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
                $.post("<?php echo url("getjason") ?>/"+$("select[name=reports]").val(),function(data){
                    $("#formms").html(data)
                    $("#formms").ajaxSubmit({
                        url:"<?php echo url('report/pie') ?>",
                        target: '#chartarea',
                        success:  afterSuccess
                    });
                })
            });

            $("#bar").unbind("click").click(function(){
                $(".btn").removeClass("btn-info")
                $(this).addClass("btn-info")
                $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
                $.post("<?php echo url("getjason") ?>/"+$("select[name=reports]").val(),function(data){
                    $("#formms").html(data)
                    $("#formms").ajaxSubmit({
                        url:"<?php echo url('report/bar') ?>",
                        target: '#chartarea',
                        success:  afterSuccess
                    });
                })
            });

            $("#line").unbind("click").click(function(){
                $(".btn").removeClass("btn-info")
                $(this).addClass("btn-info")
                $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
                $.post("<?php echo url("getjason") ?>/"+$("select[name=reports]").val(),function(data){
                    $("#formms").html(data)
                    $("#formms").ajaxSubmit({
                        url:"<?php echo url('report/line') ?>",
                        target: '#chartarea',
                        success:  afterSuccess
                    });
                })
            });

        });

        function afterSuccess(){

        }

    </script>
@endif
@stop