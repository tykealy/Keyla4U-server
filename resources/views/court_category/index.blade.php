@extends('admin.dashboardLayout')

@section('content')
<div class="card p-3 m-3">  
   
    <div class= "d-flex align-items-center justify-content-between mb-4">
        <x-page-title title="Court Category" />
        <x-create-icon href="{{route('court_category.create')}}" />
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
                <th>Category</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @if(count($categories) > 0)
                <?php
                $count = 1;
                ?>
                @foreach ($categories as $category)
                    <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $category->category_name }}</td>
                    <td><a class="btn btn-primary btn-sm" href="{{ route('court_category.edit', ['court_category' => $category->id]) }}">Update</a></td>
                    <td>
                    {!! Form::open(['route'=>['court_category.destroy',$category->id],'method'=>'DELETE']) !!}
                    {!! csrf_field() !!}
                    {!! method_field('DELETE') !!}
                    <button class="btn btn-danger btn-sm delete">Delete</button>
                    {!! Form::close() !!} 
                    </td>
                    </tr>
                    <?php $count++; ?>
                @endforeach
            @else
                <tr><td colspan="4" class="text-center">No category</td></tr>
            @endif
        </tbody>
    </table>
    <div>
        <x-btn-danger content="Back" href="{{route('dashboard')}}" />
    </div>
</div>
@endsection