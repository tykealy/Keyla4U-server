@extends('admin.dashboardLayout')

@section('content')
<div class="card p-3 m-3">  
   
    <div class= "d-flex align-items-center justify-content-between mb-4">
        <x-page-title title="Court" />
        <x-create-icon href="{{route('court.create')}}" />
    </div>

    {{-- search bar --}}
    {{ Form::open(array('url'=>'/search','method'=>'get')) }}
    <div class="input-group">
        {{ Form::text('keyword',$keyword ?? '', array('placeholder'=>'Search', 'class'=>'form-control')) }}
        {{ Form::submit('search',array('class'=>'btn btn-primary')) }}
    </div>
    {{ Form::close() }}

     {{-- table --}}
     <div class="col-lg-12 grid-margin stretch-card mt-3">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Courts table</h4>
            <div class="table-responsive pt-3">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Club</th>
                    <th>Category</th>
                    <th>Unit Price</th>
                    <th>open time</th>
                    <th>close time</th>
                    <th>Update</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                    @if(count($courts) > 0)
                        <?php
                            $count = 1;
                        ?>
                        @foreach ( $courts as $court )
                            <tr>
                                <td>{{$count}}</td>
                                <td>{{$court->club->name}}</td>
                                <td>{{$court->court_category->category_name}}</td>
                                <td>{{$court->unit_price}} $</td>
                                <td>{{$court->open_time}}</td>
                                <td>{{$court->close_time}}</td>
                                <td><a class="btn btn-primary btn-sm" href="{{ route('court.edit', ['court' =>$court->id]) }}">Update</a></td>
                                <td>
                                {!! Form::open(['route'=>['court.destroy',$court->id],'method'=>'DELETE']) !!}
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                    <button class="btn btn-danger btn-sm delete">Delete</button>
                                {!! Form::close() !!} 
                                </td>
                            </tr>
                            <?php $count++; ?>
                        @endforeach
                    
                    @else
                        <tr><td colspan="8" class="text-center">No Court</td></tr>
                    @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
    <div>
        <a href="{{route('dashboard')}}"><div class=" btn btn-primary">Back</div></a>
    </div>

</div>
@endsection