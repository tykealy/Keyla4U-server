@extends('admin.dashboardLayout')

@section('content')

<div class="card p-3 m-3">              
    <div class= "d-flex align-items-center justify-content-between">
        <x-page-title title="Club" class="mb-3" />
        <x-create-icon href="" />
    </div>
    <div class="p-3 border border-primary rounded mb-3">
        <span class="h2 fw-bold text-primary text-uppercase">Sport center's name: </span>
        <span class="h2">Blue Sport Center</span>
        <span class="h5 ms-2" style="cursor: pointer"><a href=""><i class="fa-solid fa-pen"></i></a></span>
    </div>
    <x-page-subtitle>#Image</x-page-subtitle>
    <div>
        <img class="mb-3 w-100 rounded" style="max-height:300px" src="https://source.unsplash.com/1600x900/?sport" alt="img">
    </div>
    <x-page-subtitle>#Map</x-page-subtitle>
    <div>
        <iframe class="w-100 rounded" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15633.40166136576!2d104.92720480000001!3d11.5983474!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109538d1433f56f%3A0xe6303db3a9550518!2z4Z6i4Z6Z4Z6f4Z-S4Z6R4Z-Q4Z6a4Z6g4Z-F4Z6f4Z-NIOGeh-GfkuGemuGfhOGemeGeheGehOGfkuGenOGetg!5e0!3m2!1skm!2skh!4v1682952640123!5m2!1skm!2skh" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="container-fluid mt-3">
        <div class="row gap-3">
            <x-widgets-card href="{{route('club.create')}}" class="bg-success" content="Create" />
            <x-widgets-card href="" class="bg-primary" content="Update" />
            <x-widgets-card href="" class="bg-danger" content="Delete" />
        </div>
    </div>
    <div>
    <x-btn-danger href="{{route('dashboard')}}" class="mt-4" content="Back"/>
  
    </div>
</div>

@endsection