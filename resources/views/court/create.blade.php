<?php
$court = [];

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

    {!! Form::open(['route' => 'court.store', 'method' => 'POST']) !!}

    {!! Form::label('category_id', 'Category:') !!}
    {!! Form::select('category_id', $categories->pluck('category_name', 'id'), null, ['class' => 'form-select']) !!}
    <br>
    {!! Form::label('unit_price', "Unit price:") !!}
    {!! Form::text('unit_price',null, array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('open_time', "Start Time:") !!}
    {!! Form::time('open_time',null, array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('close_time', "End Time:") !!}
    {!! Form::time('close_time',null, array('class'=>'form-control')) !!}
    <br>
    {!! Form::submit('Create', array('class'=>'btn btn-primary btn-sm')) !!}
    <x-btn-danger href="{{route('court.index')}}" content="Back"/>
    {!! Form::close() !!}
</div>

@endsection