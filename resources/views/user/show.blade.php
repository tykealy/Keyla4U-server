@extends('super_admin.SuperDashboardLayout')

@section('content')

<div class="card p-4 m-4">
    <x-page-subtitle class="d-flex justify-content-between align-items-center">
        <span>Detail</span>
        @if($user->account_role_id == 1)
        <x-create-icon href="{{url('/createWithUserId?user_id='.$user->id)}}"/>
        @endif
    </x-page-subtitle>
    <table>
        <tr>
            <th class="text-primary py-2">Username: </th>
            <td>{{$user->first_name}} {{$user->last_name}}</td>
        </tr>
        <tr>
            <th class="text-primary py-2">Role: </th>
            @if($user->account_role_id == 0)
            <td>Super Admin</td>
            @elseif($user->account_role_id == 1)
            <td>Admin</td>
            @else
            <td>User</td>
            @endif
        </tr>
        <tr>
            <th class="text-primary py-2">Email: </th>
            <td>{{$user->email}}</td>
        </tr>
        <tr>
            <th class="text-primary py-2">Phone: </th>
            <td>{{$user->phone}}</td>
        </tr>
    </table>

    <div class="mt-4">
        <x-btn-primary content="Update" href="{{route('user.edit',$user->id)}}" />
        <x-btn-danger content="Back" href="{{route('user.index')}}" />
    </div>

</div>
@endsection