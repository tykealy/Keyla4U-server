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
    <table class="table mt-3">
        <thead class="table-success text-success">
            <tr>
                <th>No</th>
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
                <tr><td colspan="7" class="text-center">No Court</td></tr>
            @endif
        </tbody>
    </table>

    {{-- card --}}
    <div class='d-flex flex-wrap'>
        @foreach ($courts as $court )
            <div class="card p-1 m-3" style="width: 15rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$court->court_category->category_name}}</h5>
                    <div class="d-flex justify-content-between">
                        <p class="text-primary">open time</p>
                        <p class="text-danger">close time</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="text-primary">{{$court->open_time}}</p>
                        <p class="text-danger">{{$court->close_time}}</p>
                    </div>
                </div>
            </div> 
        @endforeach
    </div>

    <div>
        <x-btn-danger content="Back" href="{{route('dashboard')}}" />
    </div>
</div>
@endsection