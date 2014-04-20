<h3 id="addexamerec">Examination Record(s) <a href='{{ url("patient/add/exam/{$patient->id}") }}' class="btn btn-info btn-xs addex" ><i class="fa fa-plus"></i> </a></h3>
<div class="accordion" id="accordion3">
    <?php
    $count= 0;
    foreach($patient->examination as $exam) {
        $count++;
        ?>
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collaps{{ $count }}">
                    <strong>Examination Record #{{ $count }}  <i class="fa fa-angle-double-down fa-lg pull-left"></i></strong>
                </a><button class="btn btn-xs deleteexam" id="{{ $exam->id }}"><i class="fa fa-trash-o"></i></button>
            </div>
            <div id="collaps{{ $count }}" class="accordion-body collapse">
                <div class="accordion-inner">
                   <table class="table table-bordered table-hover table-responsive">
                        <tr>
                            <th>Biopsy Number</th><td><?php echo $exam->biopsy_number ?></td>
                        </tr>
                        <tr>
                            <th>Collected From</th><td><?php echo $exam->collected_from ?></td>
                        </tr>
                        <tr>
                            <th>Examination Details</th><td><?php echo $exam->examination_details ?></td>
                        </tr>
                        <tr>
                            <th>Treatment Details</th><td><?php echo $exam->treatment_details ?></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    <?php  } ?>
</div>
<script>
    $(document).ready(function(){
        $(".deleteexam").click(function(){
            var id1 = $(this).attr("id")
            $(".deleteexam").show("slow").parent().parent().find("span").remove();
            var btn = $(this).parent().parent();
            $(this).hide("slow").parent().append("<span><br>Are You Sure <br /> <a href='#s' class='btn btn-danger btn-xs' id='yes'><i class='fa fa-check'></i> Yes</a> <a href='#s' class='btn btn-success btn-xs' id='no'> <i class='fa fa-times'></i> No</a></span>");
            $("#no").click(function(){
                $(this).parent().parent().find(".deleteexam").show("slow");
                $(this).parent().parent().find("span").remove();
            });
            $("#yes").click(function(){
                $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>deleting...");
                $.post("<?php echo url("exam/delete") ?>/"+id1,{id:id1},function(data){
                    btn.hide("slow").next("hr").hide("slow");
                });
            });
        });//endof editing tumor
    });
</script>