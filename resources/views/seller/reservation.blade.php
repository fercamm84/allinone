@extends('layouts.details')

@section('details')

    <div class="col-xs-9">
        @if($sellerDay)
            @foreach($hours as $hour => $availability)
                <div class="row text-center buttons">
                    @if($availability >= $number_of_reservations)
                        {{ Form::open(array('id' => 'formulario', 'action' => 'SellerShowController@reserve')) }}
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

                            <label class="col-xs-1">{{ $hour }}:</label>
                            <label class="col-xs-2">Horas a reservar:</label>
                            <div class="col-xs-5">
                                {{ Form::number('hours', null, ['class' => 'form-control hour ', 'min' => '1', 'max' => $maxHours, 'placeholder' => 'Max: '.$maxHours.' hs.', 'type' => 'number', 'required' => true]) }}
                            </div>
                            <button class='btn btn-primary col-xs-4' type='submit' value='submit'>
                                <i class='fa fa-user'></i> Reservar
                            </button>

                        {{ Form::close() }}
                    @else
                        <label class="col-xs-1">{{ $hour }}:</label>
                        <label class="col-xs-2">NO DISPONIBLE</label>
                    @endif
                </div>
            @endforeach
        @else
            <div class="row text-center buttons">
                <label class="col-xs-12">NO SE HACEN RESERVAS PARA ESTE DIA</label>
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
    </script>

@endsection