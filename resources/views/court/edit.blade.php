<?php
$court = [];
$categories = ['Football','Volleyball','Tennis'];
?>
@extends('admin.dashboardLayout')

@section('content')

<div class="card p-3 m-3">
    <x-page-subtitle>Update</x-page-subtitle>

    @if(Session::has('court_create'))
    <div class="alert alert-primary alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Primary!</strong> {!! session('court_create') !!}
    </div>
    @endif
    @if (count($errors) > 0 )
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

    {!! Form::model($court , array('route' => array('court.update', 1), 'method'=>'PUT','files'=>'true')) !!}

    {!! Form::label('category_id', 'Category:') !!}
    {!! Form::select('category_id',$categories,null ,array('class'=>'form-select')) !!}
    <br>
    {!! Form::label('from', 'From:') !!}
    <input class="form-control" type="time" value="" name="from">
    <br>
    {!! Form::label('to', 'To:') !!}
    <input class="form-control" type="time" value="" name="to">
    <br>
    {!! Form::submit('Update', array('class'=>'btn btn-primary btn-sm')) !!}
    <x-btn-danger href="{{route('court.index')}}" content="Back"/>
    {!! Form::close() !!}

</div>

@endsection