@extends('admin.dashboardLayout')

@section('content')
<div class="card p-3 m-3">  
   
    <div class= "d-flex align-items-center justify-content-between mb-4">
        <x-page-title title="Pitch" />
        <x-create-icon href="{{route('pitch.create')}}" />
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
                <th>Pitch's number</th>
                <th>Court</th>
                <th>Size</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @php
                $count = 1;
            @endphp
            @php
            $count = 1;
            @endphp
            @foreach ($pitches as $courtPitches)
                @foreach ($courtPitches as $pitch)
                    <tr>
                        <td>{{$count}}</td>
                        <td><a href="#">Pitch {{$pitch->pitch_num}}</a></td>
                        <td><a href="#">{{$pitch->court->court_category->category_name}}</a></td>
                        <td>{{$pitch->size}}</td>
                        <td><a class="btn btn-primary btn-sm" href="{!!route('pitch.edit',$pitch->id)!!}">Update</a></td>
                        <td>
                            {!! Form::open(['route'=>['pitch.destroy',$pitch->id], 'method'=>'DELETE']) !!}
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                            <button class="btn btn-danger btn-sm delete">Delete</button>
                            {!! Form::close() !!} 
                        </td>
                    </tr>
                    @php
                    $count = $count + 1;
                    @endphp
                @endforeach
            @endforeach
            
        </tbody>
    </table>
    <div>
        <x-btn-danger content="Back" href="{{route('dashboard')}}" />
    </div>
</div>
@endsection