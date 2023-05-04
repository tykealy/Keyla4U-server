<?php
$category = [];
?>

@extends('admin.dashboardLayout')

@section('content')

<div class="card p-3 m-3">
    <x-page-subtitle>Update</x-page-subtitle>

    @if(Session::has('club_update'))
    <div class="alert alert-primary alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Primary!</strong> {!! session('club_update') !!}
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

    {!! Form::model($category , array('route' => array('category.update', 1), 'method'=>'PUT')) !!}
    {!! Form::label('name', 'Name:') !!}
    <br>
    {!! Form::text('name',null, array('class'=>'form-control','placeholder'=>"Category's name")) !!}
    <br>
    {!! Form::submit('Create', array('class'=>'btn btn-primary btn-sm')) !!}
    <x-btn-danger href="{{route('category.index')}}" content="Back"/>
    {!! Form::close() !!}
</div>

@endsection