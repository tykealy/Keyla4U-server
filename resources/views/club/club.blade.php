
@extends('admin.dashboardLayout')

@section('content')
<div class="card p-3 m-3">
    <x-page-subtitle>ClUB</x-page-subtitle>

    @if(Session::has('club_create'))
    <div class="alert alert-primary alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Primary!</strong> {!! session('club_create') !!}
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

        @if(isset($club))
            {!! Form::open(['route' => ['club.update', auth()->user()->id], 'method' => 'Post', 'files' => true]) !!}
            {!! Form::label('name', 'Club Name:') !!}
            <br>
            {!! Form::text('name', isset($club) ? $club->name : null, array('class'=>'form-control','placeholder'=>"Sport center's name")) !!}
            <br>
            {!! Form::text('location', isset($club) ? $club->location : null, array('class'=>'form-control','placeholder'=>"Sport center's location")) !!}
            <br>
            {!! Form::text('description', isset($club) ? $club->description : null, array('class'=>'form-control','placeholder'=>"Sport center's description")) !!}
            <br>
            {!! Form::label('image', 'Image:') !!}
            <br>
            {!! Form::file('image', array('class'=>'form-control')) !!}
            <br>
            @if (isset($club) && $club->image)
                <img id="old-image" src="{{ asset('img/' . $club->image) }}" alt="Image" class="mb-3 w-100 rounded">
            @endif
            <img id="image-preview" src="#" alt="your image" class="mb-3 w-100 rounded d-none" />
            <br>
            {!! Form::label('map', 'Map:') !!}
            <br>
            {!! Form::text('map', isset($club) ? $club->map : null, array('class'=>'form-control','placeholder'=>"Map's Link", 'id' => 'map-input')) !!}
            <br>
            @if (isset($club) && $club->map)
                <iframe id="old-map" class="w-100 rounded" src="{{ $club->map }}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            @endif
            <iframe id="map-preview" class="w-100 rounded d-none" src="" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <br>
            {!! Form::hidden('_method', 'PUT') !!}
            {!! Form::submit('update', array('class'=>'btn btn-primary btn-sm')) !!} 
            <x-btn-danger href="{{route('club.index')}}" content="Back"/>
            {!! Form::close() !!}
            <script>
                // Image preview
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#image-preview').attr('src', e.target.result);
                            $('#old-image').addClass('d-none');
                            $('#image-preview').removeClass('d-none');
                        }
                        reader.readAsDataURL(input.files[0]);
                    } else {
                        // If the input is cleared, reset the src attribute of the img tag
                        $('#old-image').removeClass('d-none');
                        $('#image-preview').addClass('d-none');
                    }
                }
                $("input[name='image']").change(function() {
                    readURL(this);
                });

                // Map preview
                $('#map-input').on('input', function() {
                    if ($(this).val()) {
                        $('#map-preview').attr('src', $(this).val());
                        $('#old-map').addClass('d-none');
                        $('#map-preview').removeClass('d-none');
                    } else {
                        // If the input is cleared, reset the src attribute of the iframe tag
                        $('#old-map').removeClass('d-none');
                        $('#map-preview').addClass('d-none');
                    }
                });
            </script>
        @else
            {!! Form::open(['route' => 'club.store', 'method' => 'POST', 'files' => true]) !!}           
            {!! Form::label('name', 'Name:') !!}
            <br>
            {!! Form::text('name',null, array('class'=>'form-control','placeholder'=>"Sport center's name")) !!}
            <br>
            {!! Form::text('location', isset($club) ? $club->location : null, array('class'=>'form-control','placeholder'=>"Sport center's location")) !!}
            <br>
            {!! Form::text('description', isset($club) ? $club->description : null, array('class'=>'form-control','placeholder'=>"Sport center's description")) !!}
            <br>
            <br>
            {!! Form::label('image', 'Image:') !!}
            <br>
            {!! Form::file('image', array('class'=>'form-control')) !!}
            <br>
            <img id="image-preview" src="#" alt="your image" />
            <br>
            {!! Form::label('map', 'Map:') !!}
            <br>
            {!! Form::text('map',null, array('class'=>'form-control','placeholder'=>"Map's Link", 'id' => 'map-input')) !!}
            <br>
            <iframe id="map-preview" class="w-100 rounded" src="" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <br>
            
            {!! Form::submit('Create', array('class'=>'btn btn-primary btn-sm')) !!}
            <x-btn-danger href="{{route('dashboard')}}" content="Back"/>
            {!! Form::close() !!}
            
            <script>
                // Image preview
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#image-preview').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
                $("input[name='image']").change(function() {
                    readURL(this);
                });
            
                // Map preview
                $('#map-input').on('input', function() {
                    $('#map-preview').attr('src', $(this).val());
                });
            </script>
        
    @endif
        
</div>
@endsection