<h3>Tumor Record(s) <a href='{{ url("patient/add/tumor/$patient->id") }}' class="btn btn-info btn-xs addtumorrec"><i class="fa fa-plus"></i> </a> </h3>
<div class="accordion" id="accordion2">
    <?php
    $count= 0;
    foreach($patient->tumor as $tumor){
        $count++;
        ?>
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse{{ $count }}">
                    <strong>Tumor Record #{{ $count }} <i class="fa fa-angle-double-down fa-lg pull-left"></i></strong>
                </a><button class="btn btn-xs edittumor" id="{{ $tumor->id }}"><i class="fa fa-trash-o"></i></button>
            </div>
            <div id="collapse{{ $count }}" class="accordion-body collapse">
                <div class="accordion-inner">
                    <table class="table table-bordered table-hover table-responsive">
                        <tr>
                            <th>Topograph</th><th>Morphology</th><th>behavior</th>
                            <th>incidance_date</th><th>basis_diagnosis</th><th>Stage</th>
                        </tr>
                        <tr>
                            <td><?php echo $tumor->topograph ?></td>
                            <td><?php echo $tumor->morphology ?></td>
                            <td><?php echo $tumor->behavior ?></td>
                            <td><?php echo date("j,M Y",  strtotime($tumor->incidance_date)) ?></td>
                            <td><?php echo $tumor->basis_diagnosis ?></td>
                            <td><?php echo $tumor->stage ?></td>


                        </tr>
                    </table>
                    <h4>Source</h4>
                    <?php
                    foreach ($tumor->source as $hosptal) {
                    ?>
                    <table class="table table-bordered table-hover table-responsive">
                        <tr>
                            <th>Hospital</th><th>Path Lab No</th><th>Unit</th><th>Case No</th>

                        </tr>
                        <tr>
                            <td><?php echo $hosptal->hosptal ?></td>
                            <td><?php echo $hosptal->path_lab_no ?></td>
                            <td><?php echo $hosptal->unit ?></td>
                            <td><?php echo $hosptal->case_no ?></td>

                        </tr>
                    </table>
                    <?php  } ?>

<!--                    hiv status-->
                </div>
            </div>
        </div>
    <?php  } ?>
</div>
<script>
    $(document).ready(function(){
        $(".edittumor").click(function(){
            var id1 = $(this).attr("id")
            $(".edittumor").show("slow").parent().parent().find("span").remove();
            var btn = $(this).parent().parent();
            $(this).hide("slow").parent().append("<span><br>Are You Sure <br /> <a href='#s' class='btn btn-danger btn-xs' id='yes'><i class='fa fa-check'></i> Yes</a> <a href='#s' class='btn btn-success btn-xs' id='no'> <i class='fa fa-times'></i> No</a></span>");
            $("#no").click(function(){
                $(this).parent().parent().find(".edittumor").show("slow");
                $(this).parent().parent().find("span").remove();
            });
            $("#yes").click(function(){
                $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>deleting...");
                $.post("<?php echo url("tumor/delete") ?>/"+id1,{id:id1},function(data){
                    btn.hide("slow").next("hr").hide("slow");
                });
            });
        });//endof editing tumor
    });
</script>
