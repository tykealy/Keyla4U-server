@extends('admin.dashboardLayout')

@section('content')
<div class="card p-3 m-3 bg-light">  
   <div class= "d-flex align-items-center justify-content-between mb-4">
        <x-page-title title="ORDER" />
        <x-create-icon href="{{route('order.create')}}" />
    </div>

    @if(Session::has('user_delete'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Primary!</strong> {!! session('user_delete') !!}
        </div>
    @endif

    {{ Form::open(array('url'=>'/search_user','method'=>'get')) }}
        <div class="input-group">
            {{ Form::text('keyword',$keyword ?? '', array('placeholder'=>'Search', 'class'=>'form-control')) }}
            {{ Form::submit('search',array('class'=>'btn btn-primary')) }}
        </div>
    {{ Form::close() }}
    <br>

    @if($order_list->isEmpty())
        <div class="alert alert-danger mt-3">
            <strong>Sorry, Empty</strong>
        </div>
    @else
      {{-- table --}}
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Ordered table</h4>
            <div class="table-responsive pt-3">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Costomer's Name</th>
                    <th>phone Number</th>
                    <th>Category</th>
                    <th>Pitch Number</th>
                    <th>Unit Price</th>
                    <th>Order Status</th>
                    <th>Booked Date</th>
                    <th>Play Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Payment Method</th>
                  </tr>
                </thead>
                <tbody>
                    @if(isset($order_list))
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($order_list as $order )
                            <tr>
                                <td>{{$count}}</td>
                                <td>{{$order->customer_name}}</td>
                                <td>{{$order->customer_phone}}</td>
                                <td>{{$order->pitch->court->court_category->category_name}}</td>
                                <td>{{$order->pitch->pitch_num}}</td>
                                <td>{{$order->unit_price}}$</td>
                                <td><div class='btn btn-outline-danger'>{{$order->order_status}}</div></td>
                                <td>{{$order->booked_date}}</td>
                                <td>{{$order->play_date}}</td>
                                <td>{{$order->start_time}}</td>
                                <td>{{$order->end_time}}</td>
                                <td><div class="btn btn-dark">{{$order->payment_method}}</div></td>
                            </tr>
                                @php
                                    $count = $count + 1;
                                @endphp
                        @endforeach
                    @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    @endif
    <div>
        <a href="{{route('dashboard')}}"><div class='btn btn-primary'>Back</div></a>
    </div>
</div>
@endsection