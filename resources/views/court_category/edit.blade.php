
@extends('admin.dashboardLayout')

@section('content')

<div class="card p-3 m-3">
    <x-page-subtitle>Update category</x-page-subtitle>

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

    {!! Form::model($category , array('route' =>['court_category.update',$category['id']], 'method'=>'PUT')) !!}
    {!! Form::label('name', 'Name:') !!}
    <br>
    {!! Form::text('category_name',$category['category_name'], array('class'=>'form-control','placeholder'=>"Category's name")) !!}
    <br>
    {!! Form::submit('Create', array('class'=>'btn btn-primary btn-sm')) !!}
    <x-btn-danger href="{{route('court_category.index')}}" content="Back"/>
    {!! Form::close() !!}
</div>

@endsection