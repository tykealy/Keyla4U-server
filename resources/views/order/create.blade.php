<?php
$users = ['Tola','Odom','Neang','Sok','Sao','Srey'];
$categories = ['Football','Volleyball','Basketball'];
$pitch_num = ['1','2','3','4','5','6','7','8','9','10'];
$status = ['active','not active'];
?>
@extends('admin.dashboardLayout')

@section('content')

<div class="card p-3 m-3">

    <x-page-subtitle>Create</x-page-subtitle>

    @if(Session::has('order_create'))
    <div class="alert alert-primary alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Primary!</strong> {!! session('order_create') !!}
    </div>
    @endif
    @if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="alert alert-danger">    
        <strong>Something is Wrong</strong>
        <br><br>        
        <ul>
            @foreach ($errors->all() as $error)
            <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {!! Form::open(array('url'=>'order')) !!}

    {!! Form::label('user_id', "Customer's name:") !!}
    {!! Form::select('user_id',$users,null ,array('class'=>'form-select')) !!}
    <br>
    {!! Form::label('phone_num', "Phone number:") !!}
    {!! Form::text('phone_num',null, array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('category_id', 'Category:') !!}
    {!! Form::select('category_id',$categories,null ,array('class'=>'form-select')) !!}
    <br>
    {!! Form::label('pitch_num', 'Pitch number:') !!}
    {!! Form::select('pitch_num',$pitch_num,null ,array('class'=>'form-select')) !!}
    <br>
    {!! Form::label('unit_price', "Unit Price:") !!}
    {!! Form::text('unit_price',null, array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('total_amount', "Total's amount:") !!}
    {!! Form::text('total_amount',null, array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('order_status', 'Order status:') !!}
    {!! Form::select('order_status',$status,null ,array('class'=>'form-select')) !!}
    <br>
    {!! Form::label('book_date', "Booked date:") !!}
    {!! Form::date('book_date',null, array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('play_date', "Play date:") !!}
    {!! Form::date('play_date',null, array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('start_time', "Start Time:") !!}
    {!! Form::time('start_time',null, array('class'=>'form-control')) !!}
    <br>
    {!! Form::label('end_time', "End Time:") !!}
    {!! Form::time('end_time',null, array('class'=>'form-control')) !!}
    <br>
    {!! Form::submit('Create', array('class'=>'btn btn-primary btn-sm')) !!}
    <x-btn-danger href="{{route('order.index')}}" content="Back"/>
    {!! Form::close() !!}
</div>

@endsection