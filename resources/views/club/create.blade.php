<?php
$club = [];
?>
@extends('admin.dashboardLayout')

@section('content')
<div class="card p-3 m-3">
    <x-page-subtitle>Create</x-page-subtitle>

    @if(Session::has('club_create'))
    <div class="alert alert-primary alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Primary!</strong> {!! session('club_create') !!}
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

    {!! Form::open(array('url'=>'club', 'files'=>'true')) !!}
    {!! Form::label('name', 'Name:') !!}
    <br>
    {!! Form::text('name',null, array('class'=>'form-control','placeholder'=>"Sport center's name")) !!}
    <br>
    {!! Form::label('image', 'Image:') !!}
    <br>
    {!! Form::file('image', array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('map', 'Map:') !!}
    <br>
    {!! Form::text('map',null, array('class'=>'form-control','placeholder'=>"Map's Link")) !!}
    <br>
    {!! Form::submit('Create', array('class'=>'btn btn-primary btn-sm')) !!}
    <x-btn-danger href="{{route('club.index')}}" content="Back"/>
    {!! Form::close() !!}
</div>

@endsection