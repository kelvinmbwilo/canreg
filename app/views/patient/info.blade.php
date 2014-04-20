
<h3 class="text-center text-info">{{ strtoupper( $patient->first_name." ".$patient->middle_name." ".$patient->last_name) }}</h3>
<h3>Basic Information <a class="btn btn-default btn-xs editbasic" title="edit patient basic info" href='{{ url("patient/edit/{$patient->id}")}}'><i class="fa fa-pencil"></i></a></h3>
<table class="table table-condensed table-bordered table-hover">
    <tr>
        <td><b>Patient_id</b></td>
        <td>{{ $patient->patient_id }}</td>
        <td><b>Name</b></td>
        <td>{{ $patient->first_name." ".$patient->middle_name." ".$patient->last_name }}</td>
    </tr>
    <tr>
        <td><b>Age</b></td>
        <td>{{ date("Y")-date("Y",  strtotime($patient->date_of_birth)) }}</td>
        <td><b>Gender</b></td>
        <td>{{ $patient->gender }}</td>
    </tr>
    <tr>
        <td><b>Occupation</b></td>
        <td>{{ $patient->occupation }}</td>
        <td><b>Tribe</b></td>
        <td>{{ $patient->tribe }}</td>
    </tr>
    <tr>
        <td><b>Country</b></td>
        <td>{{ Country::find($patient->country)->name }}</td>
        <td><b>Region</b></td>
        <td>{{ Region::find($patient->region)->region }}</td>
    </tr>
    <tr>
        <td><b>District</b></td>
        <td>{{ District::find($patient->district)->district }}</td>
        <td><b>Ward</b></td>
        <td>{{ $patient->ward }}</td>
    </tr>
    <tr>
        <td><b>Village</b></td>
        <td>{{ $patient->village }}</td>
        <td><b>Ten Cell Leader</b></td>
        <td>{{ $patient->ten_cell_leder }}</td>
    </tr>

</table>

