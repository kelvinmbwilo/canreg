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

<div id="output1"></div>

<div class="form-group" style="margin-top: 20px">
    <div class="col-md-offset-2 col-md-8 pull-right">
        <button type="reset" class="btn btn-warning">Reset</button>
        <button type="button" class="btn btn-info" id="submitbtn1">Add Another</button>
        <button type="button" class="btn btn-primary" id="submitbtn">Submit</button>
    </div>
</div>
{{ Form::close() }}
<script>
    $(document).ready(function (){

        $("#submitbtn1").unbind("click").click(function(){
            $("#output1").html("<h3><i class='fa fa-spin fa-spinner fa-3x'></i><span>Submiting Patient Information please wait...</span><h3>");
            $("#FileUploader").ajaxSubmit({
                target: '#output1',
                success:  afterSuccess1
            });
        });

        $("#submitbtn").unbind("click").click(function(){
            $("#output1").html("<h3><i class='fa fa-spin fa-spinner fa-3x'></i><span>Submiting Patient Information please wait...</span><h3>");
            $("#FileUploader").ajaxSubmit({
                url:"<?php echo url("patient/register/exam1/{$patient->id}") ?>",
                target: '#output',
                success:  afterSuccess
            });
        });


    });

    function afterSuccess(){
        setTimeout(function() {
        }, 3000);

    }

    function afterSuccess1(){
        $('#FileUploader').resetForm();
        setTimeout(function() {
            $("#output1").html("")
        }, 3000);

    }

</script>