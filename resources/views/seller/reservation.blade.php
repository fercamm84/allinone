@extends('layouts.details')

@section('details')

    <script src="{{asset('js/jquery-clock-timepicker.min.js') }}"></script>

    <div class="col-xs-9">
        @if($puedeReservar)
            <div class="col-md-9">
                {{ Form::open(array('id' => 'form_reserva', 'action' => 'SellerShowController@reserve')) }}
                    {{ Form::hidden('seller_day_id', $sellerDay->id) }}
                    {{ Form::hidden('number_of_reservations', $number_of_reservations) }}
                    <h4>Seleccione la hora en la que asistirá:</h4>
                    <input class="time standard" type="text" data-minimum="{{ $sellerDay->from_hour }}:00" data-maximum="{{ $sellerDay->to_hour }}:00" required name="hour" placeholder="Horario de reserva: 0 a 23 hs"/>
                    <button class='btn btn-primary col-xs-4' type='submit' value='submit'>
                        <i class='fa fa-user'></i> Reservar
                    </button>
                {{ Form::close() }}
            </div>
        @else
            <div class="row text-center buttons">
                <label class="col-xs-12">NO HAY DISPONIBILIDAD DE RESERVAS PARA {{$number_of_reservations}} RESERVACIONES EN ESTE DIA</label>
            </div>
        @endif
    </div>

    <script>
        $('.hour').keypress(function (e) {
            console.log(e);
            var pattern = /^[0-9]$/g;
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (pattern.test(str)) {
                return true;
            }
            e.preventDefault();
            return false;
        });

        $('.standard').clockTimePicker({
            precision: 60,
            vibrate: true,
            afternoonHoursInOuterCircle: true,
        });
    </script>

@endsection