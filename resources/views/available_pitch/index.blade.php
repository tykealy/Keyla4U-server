@extends('admin.dashboardLayout')

@section('content')
<div class="card p-3 m-3">  
   
    <div class= "d-flex align-items-center justify-content-between mb-4">
        <x-page-title title="Available Pitch" />
        <x-create-icon href="{{route('available_pitch.create')}}" />
    </div>

    {{ Form::open(array('url'=>'/search','method'=>'get')) }}
    <div class="input-group">
        {{ Form::text('keyword',$keyword ?? '', array('placeholder'=>'Search', 'class'=>'form-control')) }}
        {{ Form::submit('search',array('class'=>'btn btn-primary')) }}
    </div>
    {{ Form::close() }}

    <div class="overflow-auto">
    <table class="table mt-3">
        <thead class="table-success text-success">
            <tr>
                <th>No</th>
                <th>Pitch's number</th>
                <th>Category</th>
                <th>Week day</th>
                <th>Unit price</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><a href="#">Pitch 001</a></td>
                <td><a href="#">Football</a></td>
                <td>Mon-Fir</td>
                <td>8 $</td>
                <td>7:00 AM</td>
                <td>9:00 PM</td>
                <td><a class="btn btn-primary btn-sm" href="{{route('available_pitch.update')}}">Update</a></td>
                <td>
                {!! Form::open(array('url'=>'category/'. 1, 'method'=>'DELETE')) !!}
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}
                    <button class="btn btn-danger btn-sm delete">Delete</button>
                {!! Form::close() !!} 
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td><a href="#">Pitch 002</a></td>
                <td><a href="#">Football</a></td>
                <td>Sat-Sun</td>
                <td>12 $</td>
                <td>7:00 AM</td>
                <td>9:00 PM</td>
                <td><a class="btn btn-primary btn-sm" href="{{route('available_pitch.update')}}">Update</a></td>
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
    </div>
    <div>
        <x-btn-danger content="Back" href="{{route('dashboard')}}" />
    </div>
</div>
@endsection