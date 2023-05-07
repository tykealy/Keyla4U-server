<?php
$court = [];
$categories = ['football','volleyball'];
?>
@extends('admin.dashboardLayout')

@section('content')

<div class="card p-3 m-3">
    <x-page-subtitle>Create</x-page-subtitle>

    @if(Session::has('court_create'))
    <div class="alert alert-primary alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Primary!</strong> {!! session('court_create') !!}
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

    {!! Form::open(array('url'=>'court')) !!}

    {!! Form::label('category_id', 'Category:') !!}
    {!! Form::select('category_id',$categories,null ,array('class'=>'form-select')) !!}
    <br>
    {!! Form::label('start_time', "Start Time:") !!}
    {!! Form::time('start_time',null, array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('end_time', "End Time:") !!}
    {!! Form::time('end_time',null, array('class'=>'form-control')) !!}
    <br>
    {!! Form::submit('Create', array('class'=>'btn btn-primary btn-sm')) !!}
    <x-btn-danger href="{{route('court.index')}}" content="Back"/>
    {!! Form::close() !!}
</div>

@endsection