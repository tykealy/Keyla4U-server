
@extends('admin.dashboardLayout')

@section('content')

<div class="card p-3 m-3">
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

    {{-- form two colunm --}}
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Make Your Order</h4>
                <form class="form-sample" action="{{route('order.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                            <input type="text" name='email' class="form-control form-control-sm" value="{{ old('email') }}" />
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Court</label>
                            <div class="col-sm-9">
                                <select name='court' class="form-control">
                                    @if('isset($courts)')
                                        @foreach ($courts as $court)
                                            <option value='{{$court->id}}'>{{$court->court_category->category_name}}</option>
                                        @endforeach()
                                    @endif
                                </select>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pitch</label>
                            <div class="col-sm-9">
                            <select name='pitch' class="form-control">
                                {{-- dynamic inject from javascript --}}
                            </select>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Play Date</label>
                            <div class="col-sm-9">
                                <select name='play_date' class="form-control">
                                    {{-- dynamic inject from javascript --}}
                                </select>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Start Time</label>
                                <div class="col-sm-9">
                                    <select name='start_time' class="form-control">
                                        {{-- dynamic inject from javascript --}}
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select name='status' class="form-control">
                                        <option value="Paid">Paid</option>
                                        <option value="Booked">Booked</option>
                                    </select>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <div class='row'>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Payment method</label>
                                <div class="col-sm-9">
                                    <input type="text" name='payment_method' class="form-control form-control-sm" value="{{ old('payment_method') }}" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        {{-- submit --}}
                        <div class='col-md-1 col-sm-1' >
                            <button type="submit" class="btn btn-dark btn-sm">Submit</button>
                        </div>
                        {{-- back --}}
                        <div class='col-md-2 col-sm-3'>
                            <a href="{{ url()->previous() }}">
                                <div class='btn btn-info btn-sm'>Back</div>
                            </a>
                        </div>
                    </div>
                    
                </form> 
            </div>
        </div>
    </div>

    
</div>
    @routes
    <script>
        
        // get pitch by court values can change the pitch select option
        $('select[name="court"]').on('change', function() {
            console.log('change');
            var court = $(this).val();

                $.ajax({
                    url: route('order.pitch'),
                    type: 'GET',
                    data: { court: court },
                    success: function(data) {
                        var pitchSelect = $('select[name="pitch"]');
                        pitchSelect.empty();

                        $.each(data, function(key, value) {
                            pitchSelect.append('<option value="' + key + '">' + value + '</option>');
                        });

                        // trigger change event on pitch select element
                        pitchSelect.trigger('change');
                    }
                });
            });
        

        // get date by pitch values can change the pitch select option
        $('select[name="pitch"]').on('change', function() {
            console.log('change');
        var pitch = $(this).val();

            $.ajax({
                url: route('order.playDate'),
                type: 'GET',
                data: { pitch: pitch },
                success: function(data) {
                    var dateSelect = $('select[name="play_date"]');
                    dateSelect.empty();

                    $.each(data, function(key, value) {
                        dateSelect.append('<option value="' + key + '">' + value + '</option>');
                    });

                    // trigger change event on pitch select element
                    dateSelect.trigger('change');
                }
            });
        });

        // get start time by date values can change the play date select option
        $('select[name="play_date"]').on('change', function() {
            console.log('change');
            var date = $(this).val();
            var pitch = $('select[name="pitch"]').val();
                $.ajax({
                    url: route('order.startTime'),
                    type: 'GET',
                    data: { date: date,pitch: pitch },
                    success: function(data) {
                        var startTimeSelect = $('select[name="start_time"]');
                        startTimeSelect.empty();

                        $.each(data, function(key, value) {
                            startTimeSelect.append('<option value="' + key + '">' + value + '</option>');
                        });

                        // trigger change event on pitch select element
                        startTimeSelect.trigger('change');
                    }
                });
            });

        //This will cause the change event handler for the court select element to be called when the page loads, which will send the AJAX request to get the available pitches.
        $('select[name="court"]').trigger('change');

    </script>
@endsection