@extends('admin.dashboardLayout')

@section('content')
<div class="card p-3 m-3">  
   
    <div class= "d-flex align-items-center justify-content-between mb-4">
        <x-page-title title="Court" />
        <x-create-icon href="{{route('court.create')}}" />
    </div>

    {{ Form::open(array('url'=>'/search','method'=>'get')) }}
    <div class="input-group">
        {{ Form::text('keyword',$keyword ?? '', array('placeholder'=>'Search', 'class'=>'form-control')) }}
        {{ Form::submit('search',array('class'=>'btn btn-primary')) }}
    </div>
    {{ Form::close() }}

    <table class="table mt-3">
        <thead class="table-success text-success">
            <tr>
                <th>No</th>
                <th>Club</th>
                <th>Category</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><a href="#">Blue sport</a></td>
                <td><a href="#">Football</a></td>
                <td><a class="btn btn-primary btn-sm" href="{{route('court.update')}}">Update</a></td>
                <td>
                {!! Form::open(array('url'=>'category/'. 1, 'method'=>'DELETE')) !!}
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}
                    <button class="btn btn-danger btn-sm delete">Delete</button>
                {!! Form::close() !!} 
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td><a href="#">Blue sport</a></td>
                <td><a href="#">Volleyball</a></td>
                <td><a class="btn btn-primary btn-sm" href="{{route('court.update')}}">Update</a></td>
                <td>
                {!! Form::open(array('url'=>'category/'. 1, 'method'=>'DELETE')) !!}
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}
                    <button class="btn btn-danger btn-sm delete">Delete</button>
                {!! Form::close() !!} 
                </td>
            </tr>
        </tbody>
    </table>
    <div>
        <x-btn-danger content="Back" href="{{route('dashboard')}}" />
    </div>
</div>
@endsection