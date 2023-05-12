
@extends('super_admin.SuperDashboardLayout')

@section('content')

<div class="card p-3 m-3">
    <x-page-subtitle>Update</x-page-subtitle>

    @if(Session::has('user_update'))
    <div class="alert alert-primary alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Primary!</strong> {!! session('user_update') !!}
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

    {!! Form::model($user , array('route' => array('user.update', $user->id), 'method'=>'PUT')) !!}

    {!! Form::label('first_name', 'First Name:') !!}
    {!! Form::text('first_name',$user->first_name ,array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('last_name', 'Last Name:') !!}
    {!! Form::text('last_name',$user->last_name ,array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('email', "Email:") !!}
    {!! Form::email('email',$user->email, array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('phone', "Phone Number:") !!}
    {!! Form::text('phone',$user->phone, array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('account_role_id', 'Role:') !!}
    {!! Form::select('account_role_id',$user_types,$user->account_role_id, array('class'=>'form-select')) !!}
    <br>
    {!! Form::submit('Update', array('class'=>'btn btn-primary btn-sm')) !!}
    <x-btn-danger href="{{route('user.index')}}" content="Back"/>
    {!! Form::close() !!}
</div>

@endsection