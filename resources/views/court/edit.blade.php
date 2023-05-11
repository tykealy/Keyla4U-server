
@extends('admin.dashboardLayout')

@section('content')

<div class="card p-3 m-3">
    <x-page-subtitle>Update</x-page-subtitle>

    @if(Session::has('court_create'))
    <div class="alert alert-primary alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Primary!</strong> {!! session('court_create') !!}
    </div>
    @endif
    @if (count($errors) > 0 )
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

    {!! Form::model($court ,array('route' =>['court.update',$court['id']], 'method'=>'PUT','files'=>'true')) !!}

    {!! Form::label('category_id', 'Category:') !!}
    {!! Form::select('category_id', $categories->pluck('category_name', 'id'), $court->court_category->id, ['class' => 'form-select']) !!}
    <br>
    {!! Form::label('open_time', "open Time:") !!}
    {!! Form::time('open_time',$court->open_time, array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('close_time', "close Time:") !!}
    {!! Form::time('close_time',$court->close_time, array('class'=>'form-control')) !!}
    <br>
    {!! Form::submit('Update', array('class'=>'btn btn-primary btn-sm')) !!}
    <x-btn-danger href="{{route('court.index')}}" content="Back"/>
    {!! Form::close() !!}

</div>

@endsection