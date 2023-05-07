<?php
$pitch_num = ['Pitch 001','Pitch 002','Pitch 003'];
$categories = ['Football','Volleyball','Basketball'];
$week_day = ['Mon - Fri','Sat - Sun','All week'];
$available_pitch = [];
?>
@extends('admin.dashboardLayout')

@section('content')

<div class="card p-3 m-3">

    <x-page-subtitle>Update</x-page-subtitle>

    @if(Session::has('available_pitch_create'))
    <div class="alert alert-primary alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Primary!</strong> {!! session('available_pitch_create') !!}
    </div>
    @endif
    @if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="alert alert-danger">    
        <strong>Something is Wrong</strong>
        <br><br>        
        <ul>
            @foreach ($errors->all() as $error)
            <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {!! Form::model($available_pitch , array('route' => array('available_pitch.update', 1), 'method'=>'PUT')) !!}
    {!! Form::label('category_id', 'Category:') !!}
    {!! Form::select('category_id',$categories,null ,array('class'=>'form-select')) !!}
    <br>
    {!! Form::label('pitch_id', "Pitch's number:") !!}
    {!! Form::select('pitch_id',$pitch_num,null ,array('class'=>'form-select')) !!}
    <br>
    {!! Form::label('week_day', 'Week Day:') !!}
    {!! Form::select('week_day',$week_day,null ,array('class'=>'form-select')) !!}
    <br>
    {!! Form::label('unit_price', 'Unit Price:') !!}
    {!! Form::text('unit_price','12 $', array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('start_time', "Start Time:") !!}
    {!! Form::time('start_time',null, array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('end_time', "End Time:") !!}
    {!! Form::time('end_time',null, array('class'=>'form-control')) !!}
    <br>
    {!! Form::submit('Update', array('class'=>'btn btn-primary btn-sm')) !!}
    <x-btn-danger href="{{route('available_pitch.index')}}" content="Back"/>
    {!! Form::close() !!}
</div>

@endsection