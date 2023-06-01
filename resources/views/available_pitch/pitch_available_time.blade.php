@extends('admin.dashboardLayout')

@section('content')

    
<div class="card m-3">
        {{-- panel heading --}}
        <div class="alert alert-success fw-bold mb-0" role="alert">
            <div>View your Pitch availability</div>
        </div>
</div>

<div class="card m-3 p-3">  
            {{-- select form  --}}
            <div class='d-flex gap-3'> 
                {{-- court --}}
                <div class='d-flex gap-3'>
                    <p>Court:</p>
                    <select name='court_id' class="form-select form-select-sm" aria-label="Default select example">
                        @if(isset($courts))
                            @foreach ($courts as $court )
                                <option value="{{$court->id}}">{{$court->court_category->category_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                {{-- pitch --}}
                <div class='d-flex gap-3'>  
                    <p>Pitch:</p>
                    <select name='pitch_id' class="form-select form-select-sm" aria-label="Default select example">
                        {{-- dynamic inject from javascript --}}
                    </select>
                </div>
    
                <div class='d-flex gap-3'>
                    <p>Date:</p>
                    <select name='date' class="form-select form-select-sm " aria-label="Default select example">
                        {{-- dynamic inject from javascript --}}
                    </select>
                </div>
            </div>
    {{--end select form  --}}
</div>

{{-- time listing --}}
 <div class="card m-3 p-3">
    <h4 class="card-title">Listing Times</h4>
    <p class="card-description">Color meaning <strong class='text-info'>Teal</strong> = available Time | <strong class="text-secondary">Gray</strong> = Unavailable Time</p>
        <div id='availableTime' class="template-demo">
            {{-- dynamic inject from javascript --}}
        </div>
</div>            
        
<div class="card-body">
    {{-- back button --}}
    <div>
        <x-btn-danger content="Back" href="{{route('dashboard')}}" />
    </div>
</div>


    
@routes 
<script>
   // get pitch by court values can change the pitch select option
    $('select[name="court_id"]').on('change', function(e) {
        console.log('change');
        var court = $(this).val();
        $.ajax({
            url:route('available_time.getPitch'),
            type:'GET',
            data: {court: court},
            success: function(data) {
                var pitchSelect = $('select[name="pitch_id"]');
                pitchSelect.empty();

                $.each(data, function(key, value) {
                    pitchSelect.append('<option value="' + key + '">' + value + '</option>');
                })

                // trigger change event on pitch select element
                pitchSelect.trigger('change');
            }
        })
    });

    // get date by pitcj values can change the date select option
    $('select[name="pitch_id"]').on('change', function(e){
        var pitch = $(this).val();
        $.ajax({
            url: route('available_time.getDate'),
            type: 'GET',
            data: {pitch: pitch},
            success: function(data){
                var dateSelect = $('select[name="date"]');
                dateSelect.empty();
    
                $.each(data,function(key, value){
                    dateSelect.append('<option value="' + key + '">' + value + '</option>');
                })

                dateSelect.trigger('change');
            }
        })
    });


    // get available time by date values 
    $('select[name="date"]').on('change', function(e){
        var date = $(this).val();
        var pitch =$('select[name="pitch_id"]').val();

        $.ajax({
            url: route('available_time.getAvailableTime'),
            type: 'GET',
            data: {pitch: pitch, date: date},
            success: function(data){
                var availableTimes = data.availableTime;
               
                // Update the available times list
                var availableTimesList = $('#availableTime');
                availableTimesList.empty();
                availableTimes.forEach(function(time) {
                    var listItem = $('<button type="button"></button>');
                    if(time.availability == 1){
                        listItem.addClass('btn btn-outline-info');
                    }
                    else{
                        listItem.addClass('btn btn-outline-secondary');
                    }
                    listItem.text(time.start_time + ' - ' + time.end_time);
                    availableTimesList.append(listItem);
                });

            }
        })
    });

    //This will cause the change event handler for the court select element to be called when the page loads, which will send the AJAX request to get the available pitches.
    $('select[name="court_id"]').trigger('change');

   
       
    
</script>

@endsection
