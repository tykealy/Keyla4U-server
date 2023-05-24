@extends('super_admin.SuperDashboardLayout')

@section('content')
<div class="card p-3 m-3">  
   
    <div class= "d-flex align-items-center justify-content-between mb-4">
        <x-page-title title="User" />
        <x-create-icon href="{{route('admin_register')}}" />
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

    @if($users->isEmpty())

        <div class="alert alert-danger mt-3">
            <strong>Sorry, Not Found!</strong>
            <small class="ms-3"><a href="{{route('user.index')}}">Show all</a></small>
        </div>

    @else   
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
                    <?php $num = 1 ?>
                    @foreach($users as $user)
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
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    @endif

    <div>
        <a href="{{route('super_admin_dashboard')}}">
            <button type="button" class="btn btn-dark btn-icon-text">
                <i class="mdi mdi-chevron-left btn-icon-prepend"></i>                                                    
                Back
            </button>
        </a>
    </div>
</div>
@endsection