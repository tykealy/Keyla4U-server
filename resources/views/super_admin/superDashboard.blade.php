@extends('super_admin.superDashboardLayout')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="card p-3 m-3 bg-color">
    <!-- <x-page-title title="Dashboard"/> -->
    <x-page-subtitle>Super Dashboard</x-page-subtitle>
    
    
    <div class="row">
        {{-- end heading card --}}
        <div class="col-sm-12 flex-column d-flex stretch-card">
            <div class="row">
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card bg-success">
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
                                @if(isset($orders))
                                    {{$orders}}
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
                                @if(isset($clubs))
                                    {{$clubs}}
                                @else
                                    0
                                @endif
                            </h2>
                            <h4 class="card-title mb-2">Clubs</h4>
                            <small class="text-muted">UP TO DATE</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card sale-diffrence-border">
                        <div class="card-body">
                            <h2 class="text-dark mb-2 font-weight-bold">
                                <i class='mdi mdi-account-multiple text-primary'></i>
                                @if(isset($users))
                                    {{$users}}
                                @else
                                    0
                                @endif
                                </h2>
                            <h4 class="card-title mb-2">User</h4>
                            <small class="text-muted">UP TO DATE</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end heading card --}}
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
        {{-- end chart --}}

        {{-- table --}}
        <div class="col-lg-12 grid-margin stretch-card mt-3">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">User table</h4>
                <div class="table-responsive pt-3">
                  <table class="table table-bordered  table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Role</th>
                        <th>Update</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if(isset($users_list))
                            <?php $num = 1 ?>
                            @foreach($users_list as $user)
                                <tr>
                                    <td>{{$num}}</td>
                                    <td>{{$user->first_name}} {{$user->last_name}}<a href="{{route('user.show',$user->id)}}"><i class='mdi mdi-eye text-info'></i></a></td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    @if($user->account_role_id == 0)
                                    <td>Super Admin</td>
                                    @elseif($user->account_role_id == 1)
                                    <td>Admin</td>
                                    @else
                                    <td>User</td>
                                    @endif
                                    <td><a class="btn btn-primary btn-sm" href="{{url('user/'. $user->id . '/edit')}}">Update</a></td>
                                    <td>
                                    {!! Form::open(array('url'=>'user/'.$user->id, 'method'=>'DELETE')) !!}
                                    {!! csrf_field() !!}
                                    {!! method_field('DELETE') !!}
                                        <button class="btn btn-danger btn-sm delete">Delete</button>
                                    {!! Form::close() !!} 
                                    </td>
                                </tr>
                                <?php $num++ ?>
                            @endforeach
                        @else
                            <div class="alert alert-danger mt-3">
                                <strong>Sorry, Not Found!</strong>
                                <small class="ms-3"><a href="{{route('user.index')}}">Show all</a></small>
                            </div>
                        @endif
                        
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
        {{-- end table --}}
    </div>
   {{-- pagination --}}
   <br>
   {{$users_list->links('pagination::bootstrap-5')}}
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