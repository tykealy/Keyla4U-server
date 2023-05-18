@extends('admin.dashboardLayout')

@section('content')

    
    <div class="card p-3 m-3">
        {{-- panel heading --}}
        <div class="alert alert-success" role="alert">
            <div>View your Pitch availability</div>
        </div>

        <div class="card-body p-3 ">  
            {{-- select form  --}}
            <div class='d-flex gap-3'> 
                {{-- court --}}
                <div class='d-flex gap-3'>
                    <p>Court:</p>
                    <form action="{{route('available_time.getPitch')}}" method="Post">
                        @csrf
                        <select id="court_id" name='court_id' class="form-select form-select-sm" aria-label="Default select example">
                            @if(isset($courts))
                                <option value="">Select a court</option>
                                @foreach ($courts as $court )
                                <option value="{{$court->id}}">{{$court->court_category->category_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </form>    
                </div>
    
                <div class='d-flex gap-3'>
                    {{-- pitch --}}
                    <p>Pitch:</p>
                    <form action="{{route('available_time.getDate')}}" method="Post">
                        @csrf
                        <select id="pitch_id"  name='pitch_id' class="form-select form-select-sm" aria-label="Default select example">
                            @if (isset($pitches))
                                <option value="">Select a Pitch</option>
                                @foreach ($pitches as $pitch)
                                    <option value="{{$pitch->id}}">Pitch {{$pitch->pitch_num}}</option>
                                @endforeach
                            @endif
                        </select>
                    </form>
                </div>
    
                <div class='d-flex gap-3'>
                    <p>Date:</p>
                    <form action="{{route('available_time.getAvailableTime')}}" method="Post">
                        @csrf
                        @if(isset($pitch_id))
                            <input type="hidden" id="selected_pitch" name="pitch_id" value="{{$pitch_id}}">
                        @endif
                        <select id="day_id" name='date' class="form-select form-select-sm " aria-label="Default select example">
                            @if(isset($dates))
                                <option value="">Select a Date</option>
                                @foreach ($dates as $date)
                                    <option value="{{$date->week_day}}">{{$date->week_day}}</option>
                                @endforeach
                            @endif
                        </select>
                    </form>
                </div>
            </div>

            <div class='d-flex '>
                <div class='card p-3 m-3'>
                    {{-- listing available time --}}
                    <div class="alert alert-success" role="alert">
                        <div>Available Time</div>
                    </div>
                    <ul class="list-group list-group-flush">
                        @if(isset($availableTimes))
                            @foreach ($availableTimes as $availableTime)
                                <li class="list-group-item">{{$availableTime->start_time}} - {{$availableTime->end_time}}</li>
                            @endforeach
                        @endif
                        
                    </ul>
                </div>
    
                <div class='card p-3 m-3'>
                    {{-- listing available time --}}
                    <div class="alert alert-success" role="alert">
                        <div>Unavailable Time</div>
                    </div>
                    <ul class="list-group list-group-flush">
                        @if(isset($unavailableTimes))
                            @foreach ($unavailableTimes as $unavailableTime)
                                <li class="list-group-item">{{$unavailableTime->start_time}} - {{$unavailableTime->end_time}}</li>
                            @endforeach
                        @endif
                        
                    </ul>
                </div>
                
            </div>
            
        </div>
   
    </div>
    
    


<script>
   //auto submit form
    $('#court_id').on('change', function(e) {
        $(this).closest('form').submit();
    });

    $('#pitch_id').on('change', function(e) {
        $(this).closest('form').submit();
    });

    $('#day_id').on('change', function(e) {
        $(this).closest('form').submit();
       
    });
</script>

@endsection