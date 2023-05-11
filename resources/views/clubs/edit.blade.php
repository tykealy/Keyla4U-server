
@extends('super_admin.SuperDashboardLayout')

@section('content')

<div class="card p-3 m-3">
    <x-page-subtitle>Update</x-page-subtitle>

    @if(Session::has('clubs_update'))
    <div class="alert alert-primary alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Primary!</strong> {!! session('clubs_update') !!}
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
    {!! Form::model($club , array('route' => array('clubs.update', $club->id), 'method'=>'PUT','files'=>'true')) !!}
    {!! Form::label('user_id', 'User:') !!}
    {!! Form::select('user_id',$users,$club->user->id,array('class'=>'form-select')) !!}
    <br>
    {!! Form::label('club_name', "Club's Name:") !!}
    {!! Form::text('club_name',$club->name, array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('map', "Map's Link:") !!}
    {!! Form::text('map',$club->map, array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('image', 'Image:') !!}
    {!! Form::file('image', array('class'=>'form-control')) !!}
    <br>
    {!! Form::submit('update', array('class'=>'btn btn-primary btn-sm')) !!}
    <x-btn-danger href="{{route('clubs.index')}}" content="Back"/>
    {!! Form::close() !!}
</div>

@endsection