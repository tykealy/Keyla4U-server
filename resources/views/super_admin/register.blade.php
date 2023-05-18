@extends('super_admin.superDashboardLayout')

@section('content')

<div class="card p-3 m-3">

    <x-page-subtitle>Create Admin Account</x-page-subtitle>
    {!!Form::open(['route' => 'admin_register','method'=>'post'])!!}
    @csrf
    {{-- first Name --}}
    {!!Form::label('first_name', 'First Name')!!}
    {!!Form::text('first_name',null, array('class'=>'form-control')) !!}
    {{-- first Name --}}
    {!!Form::label('last_name', 'last Name')!!}
    {!!Form::text('last_name',null, array('class'=>'form-control')) !!}
    {{-- phone --}}
    {!!Form::label('phone', 'Phone')!!}
    {!! Form::text('phone',null, array('class'=>'form-control')) !!}
    {{-- email --}}
    {!!Form::label('email', 'email')!!}
    {!! Form::text('email',null, array('class'=>'form-control')) !!}
    {{-- password --}}
    {!!Form::label('password', 'Password')!!}
    {!! Form::text('password',null, array('class'=>'form-control')) !!}
    {{-- re password --}}
    {!!Form::label('password_confirmation', 'Password')!!}
    {!! Form::text('password_confirmation',null, array('class'=>'form-control')) !!}
    {{-- role --}}
    {!!Form::label('role', 'Account_role')!!}
    {!!Form::select('role', [1 => 'Admin', 0 => 'SuperAmin'],0,array('class'=>'form-control'))!!}
    <br>
    {{-- button create --}}
    {!! Form::submit('Create', array('class'=>'btn btn-primary btn-sm')) !!}
    <x-btn-danger href="{{route('super_admin_dashboard')}}" content="Back"/>
    {!!Form::close()!!}

</div>
@endsection