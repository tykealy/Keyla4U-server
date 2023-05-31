@extends('admin.dashboardLayout')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="card p-3 m-3 bg-color">
    <!-- <x-page-title title="Dashboard"/> -->
    <x-page-subtitle>Dashboard</x-page-subtitle>
    
    {{-- ss --}}
    <div class="row">
        <div class="col-sm-12 flex-column d-flex stretch-card">
            <div class="row">
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card bg-primary ">
                        <div class="card-body text-white">
                            <h3 class="font-weight-bold mb-3">Welcome 😊 {{auth()->user()->first_name}} {{auth()->user()->last_name}}</h3>
                            <div class="progress mb-3">
                                <div class="progress-bar  bg-warning" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="pb-0 mb-0">100% power today</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card sale-diffrence-border">
                        <div class="card-body">
                            <h2 class="text-dark mb-2 font-weight-bold">
                                <i class="mdi mdi-cart-outline text-danger "></i>
                                @if(isset($order_count))
                                    {{$order_count}}
                                @else
                                    0
                                @endif
                            </h2>
                            <h4 class="card-title mb-2">Order</h4>
                            <small class="text-muted">UP TO DATE</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card sale-visit-statistics-border">
                        <div class="card-body">
                            <h2 class="text-dark mb-2 font-weight-bold">
                                <i class="mdi mdi-soccer text-info "></i>
                                @if(isset($court_count))
                                    {{$court_count}}
                                @else
                                    0
                                @endif
                            </h2>
                            <h4 class="card-title mb-2">Court</h4>
                            <small class="text-muted">UP TO DATE</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card sale-diffrence-border">
                        <div class="card-body">
                            <h2 class="text-dark mb-2 font-weight-bold">
                                <i class='mdi mdi-account-multiple text-primary'></i>
                                @if(isset($pitch_count))
                                    {{$pitch_count}}
                                @else
                                    0
                                @endif
                            </h2>
                            <h4 class="card-title mb-2">Pitch</h4>
                            <small class="text-muted">UP TO DATE</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    {{-- chart  --}}
        <div class="col-12">
            <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Line chart</h4>
                        <canvas id="lineChart"></canvas>
                    </div>
                    </div>
                </div>
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Bar chart</h4>
                        <canvas id="barChart"></canvas>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        
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
                    <th>Total Price</th>
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
                                <td>{{$order->category_name}}</td>
                                <td>{{$order->pitch_num}}</td>
                                <td>{{$order->unit_price}}$</td>
                                <td>{{$order->total_amount}}$</td>
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
    {{-- table pagination --}}
    <br>
    {{$order_list->links('pagination::bootstrap-5')}}

</div>

{{-- chart script --}}
<script>
    const ctx = document.getElementById('barChart');
  
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 5, 2, 3],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    //line chart

    const ctx1 = document.getElementById('lineChart');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
            y: {
                beginAtZero: true
            }
            }
        }
    });
</script>



@endsection