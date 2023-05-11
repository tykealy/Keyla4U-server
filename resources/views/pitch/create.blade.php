
@extends('admin.dashboardLayout')

@section('content')

<div class="card p-3 m-3">

    <x-page-subtitle>Create</x-page-subtitle>

    @if(Session::has('ptich_create'))
    <div class="alert alert-primary alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Primary!</strong> {!! session('pitch_create') !!}
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

    {!! Form::open(['route' => 'pitch.store', 'method' => 'POST']) !!}

    {!! Form::label('court_id', 'Court:') !!}
    <select name="court_id" class="form-select">
        @foreach ($courts as $court)
            <option value="{{ $court->id }}">{{ $court->court_category->category_name }}</option>
        @endforeach
    </select>
    <br>
    {!! Form::label('pitch_num', "Pitch's number:") !!}
    {!! Form::text('pitch_num',null, array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('size', 'Size:') !!}
    {!! Form::text('size',null, array('class'=>'form-control')) !!}
    <br>
    {!! Form::submit('Create', array('class'=>'btn btn-primary btn-sm')) !!}
    <x-btn-danger href="{{route('pitch.index')}}" content="Back"/>
    {!! Form::close() !!}
</div>

@endsection