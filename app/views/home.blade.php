@extends("layout.master")

@section('breadcumbs')

<li class="active">Dashboard</li>

@stop

@section('contents')
<div class="row" style="padding: 15px">

    <div class="col-sm-6">
        <div class="panel panel-default bootstrap-admin-no-table-panel stat">
            <div class="panel-heading">
                <div class="text-muted bootstrap-admin-box-title">Statistics</div>
            </div>
            <div class="bootstrap-admin-panel-content bootstrap-admin-no-table-panel-content collapse in">

                <h4>Patients Registered:{{ Patient::all()->count() }}</h4>
                    <h4>Deaths : {{ Followup::where('status','Dead')->count() }}</h4>
                        <h4>System Users: {{ User::where('status','active')->count() }}</h4>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-default bootstrap-admin-no-table-panel welcome">
            <div class="panel-heading">
                <div class="text-muted bootstrap-admin-box-title">Welcome Note</div>
            </div>
            <div class="bootstrap-admin-panel-content bootstrap-admin-no-table-panel-content collapse in">
                <p class="lead">{{ Dashboard::first()->welcome_note }}</p>
            </div>
        </div>
    </div>

    {{ Form::open(array("url"=>url("reports/process/"),"class"=>"form-horizontal","id"=>'formms')) }}
    {{ Form::close() }}
    <h3 class="text-center title"></h3>
    <div class="col-xs-6 pull-right btn-group" style="margin-top: 25px">
        <div class="col-md-3 btn btn-primary" id="table">Table</div>
        <div class="col-md-3 btn btn-primary" id="bar">Bar</div>
        <div class="col-md-3 btn btn-primary" id="line">Line</div>
        <div class="col-md-3 btn btn-primary" id="pie">Pie</div>
    </div>

    <div id="chartarea" class="col-xs-12" style="margin-top: 25px"></div>
        <script>
            $(document).ready(function (){

                var fheight = $(".stat").height();
                var sheight = $(".welcome").height();
                if(fheight > sheight){
                    $(".welcome").height(fheight);
                }else{
                    $(".stat").height(sheight)
                }

                //managing chats buttons
                $("#table").unbind("click").click(function(){
                    $(".btn").removeClass("btn-info")
                    $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
                    $(this).addClass("btn-info")
                    $.post("<?php echo url("getjason/".Dashboard::first()->report) ?>",function(data){
                        $("#formms").html(data)
                        $("#formms").ajaxSubmit({
                            url:"<?php echo url('report/table') ?>",
                            target: '#chartarea',
                            success:  afterSuccess
                        });
                    })

                });


                $("#pie").unbind("click").click(function(){
                    $(".btn").removeClass("btn-info")
                    $(this).addClass("btn-info")
                    $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
                    $.post("<?php echo url("getjason/".Dashboard::first()->report) ?>",function(data){
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
                    $.post("<?php echo url("getjason/".Dashboard::first()->report) ?>",function(data){
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
                    $.post("<?php echo url("getjason/".Dashboard::first()->report) ?>",function(data){
                        $("#formms").html(data)
                        $("#formms").ajaxSubmit({
                            url:"<?php echo url('report/line') ?>",
                            target: '#chartarea',
                            success:  afterSuccess
                        });
                    })
                });
                $("#bar").trigger("click");
            });

            function afterSuccess(){

            }

        </script>

</div>

@stop