@extends('admin.dashboardLayout')

@section('content')

<div class="card p-3 m-3">
    <x-page-title title="Super Admin"/>
    <div class="row gap-3 p-3">
        <x-widgets-card content="User" class="bg-warning" href="{{route('user.index')}}"/>
        <x-widgets-card content="Clubs" class="bg-success" href="{{route('clubs.index')}}"/>
    </div>
</div>

@endsection