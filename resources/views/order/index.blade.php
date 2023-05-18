@extends('admin.dashboardLayout')

@section('content')
<div class="card p-3 m-3">  
   
    {{ Form::open(array('url'=>'/search','method'=>'get')) }}
    <div class="input-group">
        {{ Form::text('keyword',$keyword ?? '', array('placeholder'=>'Search', 'class'=>'form-control')) }}
        {{ Form::submit('search',array('class'=>'btn btn-primary')) }}
    </div>
    {{ Form::close() }}

    <div class="overflow-auto mb-3">
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
                    <th>Payment-method</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($orders))
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($orders as $order )
                        <tr>
                            <td>{{$count}}</td>
                            <td>{{$order->customer_name}}</td>
                            <td>{{$order->customer_phone}}</td>
                            <td>{{$order->pitch->court->court_category->category_name}}</td>
                            <td>{{$order->pitch->pitch_num}}</td>
                            <td>{{$order->unit_price}}$</td>
                            <td>{{$order->total_amount}}$</td>
                            <td>{{$order->order_status}}</td>
                            <td>{{$order->booked_date}}</td>
                            <td>{{$order->play_date}}</td>
                            <td>{{$order->start_time}}</td>
                            <td>{{$order->end_time}}</td>
                            <td>{{$order->payment_method}}</td>
                        </tr>
                        @php
                            $count = $count + 1;
                        @endphp
                    @endforeach
                    
                @endif
            </tbody>
        </table>
    </div>
    <div>
        <x-btn-danger content="Back" href="{{route('dashboard')}}" />
    </div>
</div>
@endsection