@extends('layout.master')

@section('breadcumbs')
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">Patients</li>

@stop

@section('contents')

@include('patient.info')

@include('tumor.list')

@include('examination.list')

@include('folowup.list')


@stop