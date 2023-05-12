
@extends('super_admin.SuperDashboardLayout')

@section('content')

<div class="card p-3 m-3">
    <x-page-subtitle>Create</x-page-subtitle>

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

    {!! Form::open(array('url'=>'user')) !!}

    {!! Form::label('first_name', 'First Name:') !!}
    {!! Form::text('first_name',null ,array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('last_name', 'Last Name:') !!}
    {!! Form::text('last_name',null ,array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('email', "Email:") !!}
    {!! Form::email('email',null, array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('phone', "Phone Number:") !!}
    {!! Form::text('phone',null, array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('account_role_id', 'Role:') !!}
    {!! Form::select('account_role_id',$user_types,null, array('class'=>'form-select')) !!}
    <br>
    {!! Form::label('password', 'Password:') !!}
    {!! Form::text('password',null, array('class'=>'form-control')) !!}
    <br>
    <br>
    {!! Form::submit('Create', array('class'=>'btn btn-primary btn-sm')) !!}
    <x-btn-danger href="{{route('user.index')}}" content="Back"/>
    {!! Form::close() !!}
</div>

@endsection