@extends('admin.dashboardLayout')

@section('content')
<div class="card p-3 m-3">  
   
    <div class= "d-flex align-items-center justify-content-between mb-4">
        <x-page-title title="Order" />
        <x-create-icon href="{{route('order.create')}}" />
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
                <th>Customer's name</th>
                <th>Phone number</th>
                <th>Category</th>
                <th>Pitch's number</th>
                <th>Unit Price</th>
                <th>Total's amount</th>
                <th>Order's status</th>
                <th>Booked date</th>
                <th>Play date</th>
                <th>Start time</th>
                <th>End time</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Piseth</td>
                <td>085 67 567</td>
                <td>Football</td>
                <td>001</td>
                <td>10 $</td>
                <td>total amount...</td>
                <td>active</td>
                <td>2021-09-09</td>
                <td>2021-09-09</td>
                <td>06:00 PM</td>
                <td>08:00 PM</td>
                <td><a class="btn btn-primary btn-sm" href="{{route('order.update')}}">Update</a></td>
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