@extends('layout.master')

@section('breadcumbs')
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">Patients</li>

@stop

@section('contents')
<h4>Report Generation</h4>
{{ Form::open(array("url"=>url("reports/process/"),"class"=>"form-horizontal","id"=>'formms')) }}
<div class='form-group' style="margin-bottom: 10px">

    <div class='col-sm-3'>
        Region<br>{{ Form::select('region',array('all'=>'all')+Region::all()->lists('region','id'),'',array('class'=>'form-control','required'=>'requiered')) }}
    </div>
    <div class='col-sm-3'>
        District<br><span id="district-area">{{ Form::select('district',array('all'=>'all')+District::lists('district','id'),'',array('class'=>'form-control','required'=>'requiered')) }}</span>
    </div>
    <div class='col-sm-2'>
        Sex<br>{{ Form::select('gender',array('all'=>"All","Female"=>"Female","Male"=>"Male"),'',array('class'=>'form-control','required'=>'requiered')) }}
    </div>
    <div class='col-sm-2'>
        From:{{ Form::text('from','',array('class'=>'form-control','placeholder'=>'Start Date','required'=>'required','id'=>'from')) }}
    </div>
    <div class='col-sm-2'>
        To:{{ Form::text('to','',array('class'=>'form-control','placeholder'=>'End Date','required'=>'required','id'=>'to')) }}
    </div>
</div>

<div class='form-group'>
    <div class='col-sm-4'>
        Show<br>{{ Form::select('show',array("Registration"=>"Registration","Death"=>"Death","all"=>"Registration And Death",),'',array('class'=>'form-control','required'=>'requiered')) }}
    </div>
    <div class='col-sm-4'>
        Horizontal<br>{{ Form::select('horizontal',array("Year"=>"Year","Years"=>"Years","Age Range"=>"Age Range"),'',array('class'=>'form-control','required'=>'requiered')) }}
    </div>

    <div class='col-sm-4 year'>
        Year <br>{{ Form::select('year',array_combine(range(date('Y'),1970), range(date('Y'),1970)),date('Y'),array('class'=>'form-control')) }}
    </div>
    <div class='col-sm-4 age'>
        Age Range <br>{{ Form::select('age',array_combine(range(3,10), range(3,10)),'',array('class'=>'form-control')) }}
    </div>
    <div class='col-sm-4 years'>
        <div class='col-sm-6'>
            Start <br>{{ Form::select('start',array_combine(range(date('Y'),1970), range(date('Y'),1970)),date('Y')-7,array('class'=>'form-control')) }}
        </div>
        <div class='col-sm-6'>
            End<br>{{ Form::select('end',array_combine(range(date('Y'),1970), range(date('Y'),1970)),date('Y'),array('class'=>'form-control')) }}
        </div>
    </div>
</div>

<button type="button" class="btn btn-info btn-sm tog" style="margin: 10px" id="toggleadv">Advanced Filters</button>
<div class="col-md-2 btn btn-primary pull-right" id="savechat"><i class="fa fa-save"></i> Save</div>
<div  id="advfilters">
    <div class="col-xs-12">
        <div class="col-sm-3">
            Basis Of Diagnosis<br>{{ Form::select('Basis_Diagnosis',array('all'=>'All')+BasisDiagnosis::all()->lists("value","id"),'',array('class'=>'form-control','required'=>'requiered')) }}
        </div>
        <div class="col-sm-3">
            Topography<br>{{ Form::select('topography',array('all'=>'All')+SiteOfTumor::all()->lists("value","id"),'',array('class'=>'form-control','required'=>'requiered')) }}
        </div>
        <div class="col-sm-3">
            Morphology<br>{{ Form::select('morphology',array('all'=>'All')+Table18::select('COL_3', 'COL_4')->distinct()->get()->lists("COL_4","COL_3"),'',array('class'=>'form-control','required'=>'requiered')) }}
        </div>
        <div class="col-sm-3">
            Behavior<br><span id="behaviorarea">{{ Form::select('behavior',array('all'=>'All')+Table18::where('COL_3',Table18::first()->COL_3)->get()->lists("COL_6","COL_5"),'',array('class'=>'form-control','required'=>'requiered')) }}
        </span></div>

    </div>
    <div class="container" style="padding-top: 10px">
        <div class="col-sm-4">
            Stage<br>{{ Form::select('Stage',array('all'=>'All')+Stage::all()->lists("stage","id"),'',array('class'=>'form-control','required'=>'requiered')) }}
        </div>
        <div class="col-sm-4">
            <?php $treat = array("all"=>"All","Surgery"=>"Surgery","Radiotherapy"=>"Radiotherapy","Chemotherapy"=>"Chemotherapy","Hormone therapy"=>"Hormone therapy","Other"=>"Other"); ?>
            Treatment<br>{{ Form::select('Treatment',$treat,'',array('class'=>'form-control','required'=>'requiered')) }}
        </div>
        <div class="col-sm-4">
            HIV Status<br>{{ Form::select('hiv_status',array('all'=>'All','Unknown'=>'Unknown','Negative'=>'Negative','Positive'=>'Positive'),'',array('class'=>'form-control','required'=>'requiered')) }}
        <script>
            $(document).ready(function(){

            })
        </script>
    </div>

</div>
</div>
{{ Form::close() }}
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

</div>
<script>
    $(document).ready(function (){

        var year = $('.year').html();
        var years = $('.years').html();
        var age = $('.age').html();
        $(".years,.age").html("")
        $( "#from" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:"yy-mm-dd",
            onClose: function( selectedDate ) {
                $( "#to" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( "#to" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:"yy-mm-dd",
            onClose: function( selectedDate ) {
                $( "#from" ).datepicker( "option", "maxDate", selectedDate );
                if($("#from").val() != ""){
                    $("select[name=horizontal]").val("Age Range");
                    $('.year').html("");
                    $(".years").html("");
                    $('.age').html(age);
                }
            }
        });

        //hiding and showing advance filters
        $("div#advfilters").hide()
        $(".tog").click(function(){
            $("div#advfilters").toggle("slow")
        })

        $("select[name=region]").change(function(){
            $("#district-area").html("<i class='fa fa-spinner fa-spin'></i> Wait... ")
            $.post("<?php echo url('patient/region_check') ?>/"+$(this).val(),function(dat){
                $("#district-area").html(dat);
            })
        })


        $("select[name=horizontal]").change(function(){
            if($(this).val() == "Year"){
                $('.year').html(year);
                $(".years,.age").html("")
                $( "#from,#to").val("").datepicker( "refresh" );
            }else if($(this).val() == "Years"){
                $('.year,.age').html("");
                $(".years").html(years);
                $( "#from,#to").val("").datepicker( "refresh" );
            }else if($(this).val() == "Age Range"){
                $('.year,.years').html("");
                $('.age').html(age);
            }
        });

        //managing chats buttons
        $("#table").unbind("click").click(function(){
            $(".btn").removeClass("btn-info")
            $(this).addClass("btn-info")
            $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
            $("#formms").ajaxSubmit({
                url:"<?php echo url('report/table') ?>",
                target: '#chartarea',
                data: {chat:'table'},
                success:  afterSuccess
            });
        });
        $("#table").trigger("click");

        $("#pie").unbind("click").click(function(){
            $(".btn").removeClass("btn-info")
            $(this).addClass("btn-info")
            $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
            $("#formms").ajaxSubmit({
                url:"<?php echo url('report/pie') ?>",
                target: '#chartarea',
                data: {chat:'table'},
                success:  afterSuccess
            });
        });

        $("#bar").unbind("click").click(function(){
            $(".btn").removeClass("btn-info")
            $(this).addClass("btn-info")
            $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
            $("#formms").ajaxSubmit({
                url:"<?php echo url('report/bar') ?>",
                target: '#chartarea',
                data: {chat:'table'},
                success:  afterSuccess
            });
        });

        $("#line").unbind("click").click(function(){
            $(".btn").removeClass("btn-info")
            $(this).addClass("btn-info")
            $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
            $("#formms").ajaxSubmit({
                url:"<?php echo url('report/line') ?>",
                target: '#chartarea',
                data: {chat:'table'},
                success:  afterSuccess
            });
        });

        //saving a chart
       $("#savechat").click(function(){
           var id = $(this).attr("id");
           var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
           modal+= '<div class="modal-dialog">';
           modal+= '<div class="modal-content">';
           modal+= '<div class="modal-header">';
           modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
           modal+= '<h4 class="modal-title" id="myModalLabel">Save Report Variables</h4>';
           modal+= '</div>';
           modal+= '<div class="modal-body">';
           modal+='Name Of Report<input type="text" name="report"  required="" class="form-control">';
           modal+='<div id="outpp" ></div>';
           modal+= ' </div>';
           modal+= '<div class="modal-footer">';
           modal+= '<button type="button" class="btn btn-primary" id="submitreport">Save</button> ';
           modal+= '</div>';
           modal+= '</div>';
           modal+= '</div>';

           $("body").append(modal);
           $("#myModal").modal("show");
           $("#submitreport").click(function(){
               if($("input[name=report]").val() == ""){
                   $("input[name=report]").attr("placeholder","Write Name First").focus();
               }else{
                   $("#outpp").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Saving Report...</span><h3>");
                   $("#formms").ajaxSubmit({
                       url:"<?php echo url('report/save') ?>",
                       target: '#outpp',
                       data: {name:$("input[name=report]").val()},
                       success:  function(){
                           $("#outpp").html("<h3><i class='fa fa-check text-success'></i><span>Report Saved</span><h3>");
                           setTimeout(function() {
                               $("#myModal").modal("hide");
                           }, 2000);
                       }
                   });
               }
           })
           $("#myModal").on('hidden.bs.modal',function(){
               $("#myModal").remove();
           })
       });

//        $("select").change(function(){
//            $("#table").trigger("click");
//        });
    });

    function afterSuccess(){

    }

</script>
@stop