@extends('home.layouts.home')

@section('content')
    <table class="table table-responsive" id="addresses-table">
        <thead>
        <tr>
            <th>Country</th>
            <th>Zone</th>
            <th>City</th>
            <th>Location</th>
            <th>Zip Code</th>
            <th>Address</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
            @if(!empty($userAddresses))
                @foreach($userAddresses as $userAddress)
                    <tr>
                        <td>{{ $userAddress->address->location->city->zone->country->description }}</td>
                        <td>{{ $userAddress->address->location->city->zone->description }}</td>
                        <td>{{ $userAddress->address->location->city->description }}</td>
                        <td>{{ $userAddress->address->location->description }}</td>
                        <td>{{ $userAddress->address->zip_code }}</td>
                        <td>{{ $userAddress->address->address }}</td>
                        <td>
                            {{ Form::open(['route' => ['address.destroy', $userAddress->address->id], 'method' => 'delete']) }}
                            <div class='btn-group'>
                                <a href="{{ route('address.edit', [$userAddress->address->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                                {{ Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) }}
                            </div>
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <a href="{{ route('address.create') }}" class='btn btn-primary'>Add new</a>
@endsection
