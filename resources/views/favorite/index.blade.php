@extends('admin.dashboardLayout')

@section('content')
<div class="card p-3 m-3">  
   
    <div class= "d-flex align-items-center justify-content-between mb-4">
        <x-page-title title="favorite" />
        <x-create-icon href="#" />
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
                <th>Club</th>
                <th>User</th>
            </tr>
        </thead>
        <tbody>
           <tr>
                <td>1</td>
                <td>Blue Sport center</td>
                <td>Tola</td>
           </tr>     
           <tr>
                <td>2</td>
                <td>Blue Sport center</td>
                <td>Mesa</td>
           </tr>   
            <tr>
                <td>3</td>
                <td>Blue Sport center</td>
                <td>Dom</td>
           </tr>         
        </tbody>
    </table>
    <div>
        <x-btn-danger content="Back" href="{{route('dashboard')}}" />
    </div>
</div>
@endsection