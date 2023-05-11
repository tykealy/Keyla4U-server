@extends('super_admin.SuperDashboardLayout')

@section('content')
<div class="card p-3 m-3">  
   
    <div class= "d-flex align-items-center justify-content-between mb-4">
        <x-page-title title="User" />
        <x-create-icon href="{{route('user.create')}}" />
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
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Role</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Elon</td>
                <td>Jelly</td>
                <td>elon124@gmail.com</td>
                <td>086 453 534</td>
                <td>User</td>
                <td><a class="btn btn-primary btn-sm" href="{{route('user.update')}}">Update</a></td>
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
                <td>Bellu</td>
                <td>Tom</td>
                <td>tom453on124@gmail.com</td>
                <td>016 453 264</td>
                <td>User</td>
                <td><a class="btn btn-primary btn-sm" href="{{route('user.update')}}">Update</a></td>
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
        <x-btn-danger content="Back" href="{{route('super_admin_dashboard')}}" />
    </div>
</div>
@endsection