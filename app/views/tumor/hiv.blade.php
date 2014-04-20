<div class="col-md-12" style="padding-left: 5px;padding-right: 0px">
    <div class="panel panel-default">
        <div class="panel-body">

            <div class='form-group'>

                <div class='col-sm-4'>
                    HIV Status<br>{{ Form::select('hiv_status',array('Unknown'=>'Unknown','Negative'=>'Negative','Positive'=>'Positive'),'',array('class'=>'form-control','required'=>'requiered')) }}
                </div>
                <div class='col-sm-4'>

                    <span id="last_test">Last Test Done In(year)<br> {{ Form::select('last_test',array_combine(range(date('Y'),1970), range(date('Y'),1970)),'',array('class'=>'form-control')) }}</span>
                </div>

            </div>

            <div class='form-group' id="positive">
                <div class='col-sm-4'>
                    Year of First diagnosis <br> {{ Form::select('year_since_diagnosis',array_combine(range(date('Y'),1970), range(date('Y'),1970)),'',array('class'=>'form-control')) }}
                </div>
                <div class='col-sm-4'>
                    Is the client on ART? <br> {{ Form::select('art_status',array('no'=>'No','yes'=>'Yes'),'',array('class'=>'form-control','required'=>'requiered')) }}
                </div>
                <div class='col-sm-4'>
                    What is the latest CD4 count(cells/mm3)<br> {{ Form::select('prev_cd4',array_combine(range(0,1500), range(0,1500)),'500',array('class'=>'form-control')) }}
                </div>
            </div>

        </div>
        <script>
            $(document).ready(function (){

                var last_test = $("#last_test").html();
                var hivstat = $("#hivstat").html();
                var positive = $("#positive").html();
                var negative = $("#negative").html();
                var current_cd4 = $("#current_cd4").html();
                var current_art = $("#current_art").html();
                var current_test_result = $("#current_test_result").html();
                $("#last_test,#positive,#negative").html("");
                $("#negative").html(negative);
                $("#current_cd4").html("");
                $("#current_art").html("");
                $("#current_test_result").html("");
                $("select[name=test_again]").change(function(){
                    if($(this).val() == "yes"){
                        $("#hivstat").html("");
                        $("#current_test_result").html(current_test_result)
                        $("select[name=current_test_result]").change(function(){
                            if($(this).val() == "Positive"){
                                $("#current_cd4").html(current_cd4)
                                $("#current_art").html(current_art)
                            }else{
                                $("#current_cd4").html("");
                                $("#current_art").html("");
                            }
                        });
                    }else{
                        $("#current_cd4").html("");
                        $("#current_test_result").html("");
                        $("#hivstat").html(hivstat);
                    }
                });


                $("select[name=hiv_status]").change(function(){
                    if($(this).val() == "Negative"){
                        $("#last_test").html(last_test);

                        $("#positive").html("")

                    }else if($(this).val() == "Positive"){
                        $("#last_test").html(last_test);
                        $("#positive").html(positive)


                    }else{
                    $("#last_test,#positive").html("");


                }
                })



            });
        </script>



    </div>
</div>
