<?php
$role = ['User','Admin','Super admin'];
$user = [];
?>
@extends('admin.dashboardLayout')

@section('content')

<div class="card p-3 m-3">
    <x-page-subtitle>Update</x-page-subtitle>

    @if(Session::has('user_create'))
    <div class="alert alert-primary alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Primary!</strong> {!! session('user_create') !!}
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

    {!! Form::model($user , array('route' => array('user.update', 1), 'method'=>'PUT')) !!}

    {!! Form::label('first_name', 'First Name:') !!}
    {!! Form::text('first_name',null ,array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('last_name', 'Last Name:') !!}
    {!! Form::text('last_name',null ,array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('email', "Email:") !!}
    {!! Form::email('email',null, array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('phone_number', "Phone Number:") !!}
    {!! Form::text('phone_number',null, array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('role', 'Role:') !!}
    {!! Form::select('role',$role,null, array('class'=>'form-select')) !!}
    <br>
    {!! Form::submit('Update', array('class'=>'btn btn-primary btn-sm')) !!}
    <x-btn-danger href="{{route('user.index')}}" content="Back"/>
    {!! Form::close() !!}
</div>

@endsection