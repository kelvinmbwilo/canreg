{{ Form::open(array("url"=>"patient/register/tumor/{$patient->id}","class"=>"form-horizontal","id"=>"FileUploader")) }}
   <div class="col-xs-12">
       <div class="col-sm-8">
           <legend>Tumor Record</legend>
           <!--Date Of Incidence-->
           <div class="form-group">
               <div class='col-sm-6'>Date Of Incidence<br>{{ Form::text('Incidence_Date','',array('class'=>'form-control','placeholder'=>'Date Of Incidence','required'=>'required','id'=>'Incidance')) }} </div>
               <div class='col-sm-6'>Topography<br>{{ Form::select('topography',SiteOfTumor::all()->lists("value","id"),'',array('class'=>'form-control','required'=>'requiered')) }}  </div>
           </div>
           <div class="form-group">
               <div class='col-sm-6'>Morphology<br>{{ Form::select('morphology',Table18::select('COL_3', 'COL_4')->distinct()->get()->lists("COL_4","COL_3"),'',array('class'=>'form-control','required'=>'requiered')) }}  </div>
               <div class="col-sm-6">Behavior<br><span id="behaviorarea">{{ Form::select('behavior',Table18::where('COL_3',Table18::first()->COL_3)->get()->lists("COL_6","COL_5"),'',array('class'=>'form-control','required'=>'requiered')) }}
 </span> </div>
           </div>

           <div class="form-group">
               <div class='col-sm-6'>Basis Of Diagnosis<br>{{ Form::select('Basis_Diagnosis',BasisDiagnosis::all()->lists("value","id"),'',array('class'=>'form-control','required'=>'requiered')) }}  </div>
               <div class='col-sm-6'>Stage<br>{{ Form::select('Stage',Stage::all()->lists("stage","id"),'',array('class'=>'form-control','required'=>'requiered')) }}  </div>
           </div>

           <legend>Treatment</legend>
           <label>
               <input type="checkbox" name="treat[]" value="Surgery"> Surgery
           </label>
           <label>
               <input type="checkbox" name="treat[]" value="Radiotherapy"> Radiotherapy
           </label>
           <label>
               <input type="checkbox" name="treat[]" value="Chemotherapy"> Chemotherapy
           </label>
           <label>
               <input type="checkbox" name="treat[]" value="Hormone therapy "> Hormone therapy
           </label>
           <label>
               <input type="checkbox" name="treat[]" value="Other"> Other
           </label>
       </div>
       <div class="col-sm-4">
           <legend>Source</legend>
           <!--Hospital-->
           <div class="form-group">
               <div class='col-sm-12'>Hospital<br>{{ Form::text('hospital','',array('class'=>'form-control','placeholder'=>'Hospital')) }} </div>
            </div>

           <div class="form-group">
               <div class='col-sm-12'>Path_lab_no<br>{{ Form::text('Path_lab_no',$patient->lab_no,array('class'=>'form-control','placeholder'=>'Path_lab_no')) }} </div>
           </div>

           <div class="form-group">
               <div class='col-sm-12'>Unit<br>{{ Form::text('Unit','',array('class'=>'form-control','placeholder'=>'Unit')) }} </div>
           </div>

           <div class="form-group">
               <div class='col-sm-12'>Case_no<br>{{ Form::text('case_no','',array('class'=>'form-control','placeholder'=>'Case_no')) }} </div>
           </div>

       </div>
   </div>
<legend>HIV Status</legend>
@include('tumor.hiv')
<div id="output1"></div>
    <div class="form-group" style="margin-top: 15px">
        <div class="col-md-offset-2 col-md-8 pull-right">
            <button type="reset" class="btn btn-warning">Reset</button>
            <button type="button" class="btn btn-info" id="submitbtn1">Add Another</button>
            <button type="button" class="btn btn-primary" id="submitbtn">Submit</button>
        </div>
    </div>
{{ Form::close() }}
<script>
    $(document).ready(function (){
        $("#Incidance").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:"yy-mm-dd"
        });

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
                url:"<?php echo url("patient/register/tumor1/{$patient->id}") ?>",
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