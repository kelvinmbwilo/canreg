@extends('layout.master')

@section('breadcumbs')
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">Patients</li>

@stop

@section('contents')
<?php $patient = Patient::all(); $counter = 1; ?>
<table id="example" class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Middle Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Age</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($patient as $patient)

        <tr>
            <td>{{ $counter++ }}</td>
            <td>{{ $patient->first_name }}</td>
            <td>{{ $patient->last_name }}</td>
            <td>{{ $patient->last_name }}</td>
            <td>{{ $patient->gender }}</td>
            <td>{{ date("Y")-date("Y",strtotime($patient->date_of_birth)) }}</td>
            <td id="{{ $patient->id }}">
                <a href='{{ url("patients/{$patient->id}") }}' id="{{ $patient->id }}" class="moreinfo btn btn-primary btn-xs" title="View More Details" style="margin-right: 5px"><i class="fa fa-info"></i> Info</a>
                <a href="#a" id="{{ $patient->id }}" class="deletepat text-danger btn btn-danger btn-xs" title="Delete Patient"><i class="fa fa-trash-o"></i> </a>
            </td>
        </tr>
@endforeach
    </tbody>

    <tfoot>
    <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Middle Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Date of Birth</th>
        <th></th>
    </tr>
    </tfoot>
</table>
<script>
    $(document).ready(function() {
        $('#example').dataTable( {
            "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page"
            },
            "fnDrawCallback": function( oSettings ) {

                $(".deletepat").click(function(){
                    var id1 = $(this).parent().attr('id');
                    $(".deletepat").show("slow").parent().parent().find("span").remove();
                    var btn = $(this).parent().parent();
                    $(this).hide("slow").parent().append("<span><br>Are You Sure <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
                    $("#no").click(function(){
                        $(this).parent().parent().find(".deletepat").show("slow");
                        $(this).parent().parent().find("span").remove();
                    });
                    $("#yes").click(function(){

                        $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>deleting...");
                        $.post("<?php echo url('patient/delete') ?>/"+id1,function(data){
                            btn.hide("slow").next("hr").hide("slow");
                        });
                    });
                });//endof deleting category
            }
        });
        $('input[type="text"]').addClass("form-control");
        $('select').addClass("form-control");

    } );
</script>
@stop