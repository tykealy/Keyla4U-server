@extends('super_admin.SuperDashboardLayout')

@section('content')
<div class="card p-3 m-3">  
   
    <div class= "d-flex align-items-center justify-content-between mb-4">
        <x-page-title title="Clubs" />
        <x-create-icon href="{{route('clubs.create')}}" />
    </div>

    
    @if(Session::has('club_delete'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Primary!</strong> {!! session('club_delete') !!}
    </div>
    @endif

    {{ Form::open(array('url'=>'/search_club','method'=>'get')) }}
    <div class="input-group">
        {{ Form::text('keyword',$keyword ?? '', array('placeholder'=>'Search', 'class'=>'form-control')) }}
        {{ Form::submit('search',array('class'=>'btn btn-primary')) }}
    </div>
    {{ Form::close() }}

    <?php $num=1 ?>

    @if($clubs->isEmpty())

        <div class="alert alert-danger mt-3">
            <strong>Sorry, Not Found!</strong>
            <small class="ms-3"><a href="{{route('clubs.index')}}">Show all</a></small>
        </div>

    @else   
         {{-- table --}}
      <div class="col-lg-12 grid-margin stretch-card mt-3">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Club table</h4>
            <div class="table-responsive pt-3">
              <table class="table table-bordered  table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Admin</th>
                    <th>Club's Name</th>
                    <th>Image</th>
                    <th>Map</th>
                    <th>Update</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($clubs as $club)
                        <tr>
                            <td>{{$num}}</td>
                            <td>{{$club->user->first_name}} {{$club->user->last_name}}</td>
                            <td>{{$club->name}}</td>
                            <td>
                                <div>{{ Html::image('/img/'.$club->image, "$club->name", array('width'=>'60')) }}</div>
                            </td>
                            <td><a class="btn btn-info text-white" href="{{$club->map}}">View on map</a></td>
                            <td><a class="btn btn-primary btn-sm" href="{{url('/clubs/'.$club->id.'/edit')}}">Update</a></td>
                            <td>
                            <!-- {!! Form::open(array('url' => 'clubs/'.$club->id, 'method' => 'DELETE')) !!} -->
                            {!! Form::open(array('route' => array('clubs.destroy', $club->id), 'method'=>'DELETE')) !!}
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
    {{-- back btn --}}
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