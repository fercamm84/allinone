@extends('layouts.details')

@section('details')

    @if($sellerDay)
        @foreach($hours as $hour => $availability)
            <div class="hour">
                {{ $hour }} -
                @if($availability >= $number_of_reservations)
                    {{ Form::open(array('id' => 'formulario', 'action' => 'SellerShowController@reserve')) }}
                    <p class="text-center buttons">
                        {{ Form::hidden('seller_day_id', $seller->id) }}
                        {{ Form::hidden('number_of_reservations', $number_of_reservations) }}
                        {{ Form::hidden('from_hour', $hour) }}

                        <?php $maxHours = 1; ?>
                        @foreach($hours as $nextHour => $availabilityNextHour)
                            @if($nextHour > $hour)
                                @if($availabilityNextHour >= $number_of_reservations)
                                    <?php $maxHours++; ?>
                                @else
                                    @break
                                @endif
                            @endif
                        @endforeach

                        Cant. horas: {{ Form::number('hours', null, ['class' => 'form-control hour', 'min' => '1', 'max' => $maxHours, 'placeholder' => 'Max: '.$maxHours.' hs.', 'type' => 'number', 'required' => true]) }}
                        <button class='btn btn-primary' type='submit' value='submit' style="margin-top:3%;">
                            <i class='fa fa-user'></i> Reservar
                        </button>
                    </p>
                    {{ Form::close() }}
                @else
                    NO HAY LUGAR
                @endif
            </div>
        @endforeach
    @else
        NO SE HACEN RESERVAS PARA ESTE DIA
    @endif

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
    </script>

@endsection