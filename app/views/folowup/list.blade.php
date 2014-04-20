<!--follow up-->
<h3 id="addexamerec">Follow Up(s) <a href='{{ url("patient/add/followup/{$patient->id}") }}' class="btn btn-info btn-xs addfol" ><i class="fa fa-plus"></i> </a></h3>
<?php
if($patient->followup()->count() == 0){
    echo "<strong>No follow up done before</strong>";
}else{
    $folowups = $patient->followup()->orderBy("created_at","DESC");

?>
<div class="row">
    <div class="col-md-4">Total Follow Ups Done To Date</div><div class="col-md-8 text-left"><b>{{ $patient->followup()->count() }}</b></div>
</div>

<?php
$last = $folowups->first();
    echo "<div class='row'>";
    echo "<div class='col-md-4'>Date Of Last Follow UP</div><div class='col-md-8 text-left'><b>".date("j,M Y",  strtotime($last->last_contact))."</b></div>";
    echo "</div>";
    echo "<div class='row'>
    <div class='col-md-4'>Last Follow Up Status</div><div class='col-md-8 text-left'><b>{$last->status}</b></div>
</div>";
echo "<hr>";
?>
<div class="accordion" id="accordion4">
    <?php
    $count= 0;
    foreach ($folowups->get() as $follow) {
    $count++;
    ?>
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#collapsee{{ $count }}">
                <strong>Follow Up Record #{{ $count }}  <i class="fa fa-angle-double-down fa-lg pull-left"></i></strong>
            </a><button class="btn btn-xs editfollow" id="{{ $follow->id }}"><i class="fa fa-trash-o"></i></button>
        </div>
        <div id="collapsee{{ $count }}" class="accordion-body collapse">
            <div class="accordion-inner">
                <table class="table table-bordered table-condensed table-hover">

                        <tr>
                            <td>Follow Up Date</td>
                            <td>{{ $follow->last_contact}}</td>
                        </tr>
                        <tr>
                            <td>Patient Status</td>
                            <td>{{ $follow->status }}</td>
                        </tr>
                        <tr class="deathcause">
                            <td>Cause Of Death</td>
                            <td class="cuase">{{ $follow->cause_of_death }}</td>
                        </tr>
                        <tr class="deathcause">
                            <td>Follow Up Done By</td>
                            <td>{{ $follow->dr_name }}</td>
                        </tr>

                </table>
            </div>
        </div>

    </div>
    <?php } ?>
    </div>
<?php } ?>