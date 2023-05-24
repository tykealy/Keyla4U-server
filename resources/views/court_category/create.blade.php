<?php
$category = [];
?>
@extends('admin.dashboardLayout')

@section('content')

<div class="card p-3 m-3 bg-light">
    <x-page-subtitle>Create Category</x-page-subtitle>

    @if(Session::has('category_create'))
    <div class="alert alert-primary alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Primary!</strong> {!! session('category_create') !!}
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

    {!!Form::open(['route' => 'court_category.store', 'method' => 'POST']) !!}
    {!! Form::label('name', 'Name:') !!}
    <br>
    {!! Form::text('category_name',null, array('class'=>'form-control','placeholder'=>"Category's name")) !!}
    <br>
    {!! Form::submit('Create', array('class'=>'btn btn-primary btn-sm')) !!}
    <x-btn-danger href="{{route('court_category.index')}}" content="Back"/>
    {!! Form::close() !!}
</div>

@endsection