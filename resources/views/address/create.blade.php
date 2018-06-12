@extends('home.layouts.home')

@section('content')
    <section class="content-header">
        <h1>
            New Address
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::open(['route' => 'address.store']) !!}

                       <!-- Address Field -->
                       <div class="form-group col-sm-6">
                           {!! Form::label('address', 'Address:') !!}
                           {!! Form::text('address', null, ['class' => 'form-control', 'required']) !!}
                       </div>

                       <!-- Zip Code Field -->
                       <div class="form-group col-sm-6">
                           {!! Form::label('zip_code', 'Zip Code:') !!}
                           {!! Form::text('zip_code', null, ['class' => 'form-control', 'required']) !!}
                       </div>

                       <!-- Zone Id Field -->
                       <div class="form-group col-sm-6">
                           {!! Form::label('zone_id', 'Zone Id:') !!}
                           {!! Form::select('zone_id', $zones, null, ['class' => 'form-control', 'required']) !!}
                       </div>

                       <!-- City Id Field -->
                       <div class="form-group col-sm-6">
                           {!! Form::label('city_id', 'City Id:') !!}
                           {!! Form::select('city_id', $cities, null, ['class' => 'form-control', 'required']) !!}
                       </div>

                       <!-- Location Id Field -->
                       <div class="form-group col-sm-6">
                           {!! Form::label('location_id', 'Location Id:') !!}
                           {!! Form::select('location_id', $locations, null, ['class' => 'form-control', 'required']) !!}
                       </div>

                       <!-- Submit Field -->
                       <div class="form-group col-sm-12">
                           {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                           <a href="{!! route('address.index') !!}" class="btn btn-default">Cancel</a>
                       </div>

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
    <script>
        $(function() {
            $('#city_id').button('loading');
            $('#location_id').button('loading');
            var url = '{{ url('address/zone') }}' + '/' + $('#zone_id').val() + '/cities/';

            $.get(url, function(data) {
                var select = $('#city_id');

                $('#city_id').button('reset');

                select.empty();

                select.append('<option value="">---Select One---</option>');
                $.each(data,function(key, value) {
                    select.append('<option value=' + key + '>' + value + '</option>');
                });

                $('#location_id').button('reset');
                var select = $('#location_id');
                select.empty();
                select.append('<option value="">---Select One---</option>');
            }).fail(function() {
                $('#city_id').button('reset');
                var select = $('#city_id');
                select.empty();
                select.append('<option value="">---Select One---</option>');

                $('#location_id').button('reset');
                var select = $('#location_id');
                select.empty();
                select.append('<option value="">---Select One---</option>');
            });

            $('#zone_id').change(function() {

                $('#city_id').button('loading');
                $('#location_id').button('loading');
                var url = '{{ url('address/zone') }}' + '/' + $(this).val() + '/cities/';

                $.get(url, function(data) {
                    var select = $('#city_id');

                    $('#city_id').button('reset');

                    select.empty();

                    select.append('<option value="">---Select One---</option>');
                    $.each(data,function(key, value) {
                        select.append('<option value=' + key + '>' + value + '</option>');
                    });

                    $('#location_id').button('reset');
                    var select = $('#location_id');
                    select.empty();
                    select.append('<option value="">---Select One---</option>');
                }).fail(function() {
                    $('#city_id').button('reset');
                    var select = $('#city_id');
                    select.empty();
                    select.append('<option value="">---Select One---</option>');

                    $('#location_id').button('reset');
                    var select = $('#location_id');
                    select.empty();
                    select.append('<option value="">---Select One---</option>');
                });
            });

            $('#city_id').change(function() {

                $('#location_id').button('loading');
                var url = '{{ url('address/city') }}' + '/' + $(this).val() + '/locations/';

                $.get(url, function(data) {
                    var select = $('#location_id');

                    $('#location_id').button('reset');

                    select.empty();

                    select.append('<option value="">---Select One---</option>');
                    $.each(data,function(key, value) {
                        select.append('<option value=' + key + '>' + value + '</option>');
                    });
                }).fail(function() {
                    $('#location_id').button('reset');
                    var select = $('#location_id');
                    select.empty();
                    select.append('<option value="">---Select One---</option>');
                });
            });
        });
    </script>
@endsection
