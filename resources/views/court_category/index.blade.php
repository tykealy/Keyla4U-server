@extends('admin.dashboardLayout')

@section('content')
<div class="card p-3 m-3 bg-light">  
   
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

    {{-- table --}}
    <div class="col-lg-12 grid-margin stretch-card mt-3">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Ordered table</h4>
            <div class="table-responsive pt-3">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>#</th>
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
            </div>
          </div>
        </div>
    </div>
    <div>
        <a href="{{route('dashboard')}}"><div class=" btn btn-primary">Back</div></a>
    </div>
</div>
@endsection