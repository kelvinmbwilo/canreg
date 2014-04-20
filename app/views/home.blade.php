@extends("layout.master")

@section('breadcumbs')

<li class="active">Dashboard</li>

@stop

@section('contents')
<div class="row">

    <div class="panel panel-default bootstrap-admin-no-table-panel">
        <div class="panel-heading">
            <div class="text-muted bootstrap-admin-box-title">Statistics</div>
            <div class="pull-right"><span class="badge">View More</span></div>
        </div>
        <div class="bootstrap-admin-panel-content bootstrap-admin-no-table-panel-content collapse in">
            <div class="col-md-3">
                <div class="easyPieChart" data-percent="73" style="width: 110px; height: 110px; line-height: 110px;">73%<canvas width="110" height="110"></canvas></div>
                <div class="chart-bottom-heading"><span class="label label-info">Visitors</span></div>
            </div>
            <div class="col-md-3">
                <div class="easyPieChart" data-percent="53" style="width: 110px; height: 110px; line-height: 110px;">53%<canvas width="110" height="110"></canvas></div>
                <div class="chart-bottom-heading"><span class="label label-info">Page Views</span></div>
            </div>
            <div class="col-md-3">
                <div class="easyPieChart" data-percent="83" style="width: 110px; height: 110px; line-height: 110px;">83%<canvas width="110" height="110"></canvas></div>
                <div class="chart-bottom-heading"><span class="label label-info">Users</span></div>
            </div>
            <div class="col-md-3">
                <div class="easyPieChart" data-percent="13" style="width: 110px; height: 110px; line-height: 110px;">13%<canvas width="110" height="110"></canvas></div>
                <div class="chart-bottom-heading"><span class="label label-info">Orders</span></div>
            </div>
        </div>
    </div>
</div>


@stop