@extends('layouts.details')

@section('details')

    @if($seller->reservations)
        <div class="col-md-9">
            {{ Form::open(array('id' => 'formulario', 'action' => 'SellerShowController@reservation')) }}
            <h4>Reservar:</h4>

            <p class="text-center buttons">
                {{ Form::hidden('seller_id', $seller->id) }}
                <?php $max_reservas = $sellerDay!=null ? $sellerDay->total : 10; ?>
                Cantidad de personas: {{ Form::number('number_of_reservations', 1, ['class' => 'form-control', 'min' => '1', 'max' => $max_reservas, 'required' => true]) }}
                <button class='btn btn-primary' type='submit' value='submit' style="margin-top:3%;">
                    <i class='fa fa-user'></i> Reservar
                </button>
            </p>
            {{ Form::close() }}
        </div>
    @endif

    @include('search.search')

@endsection
