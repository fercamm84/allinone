@extends('home.layouts.home')

@section('content')

    @foreach($categoryProducts as $categoryProduct)
        <a href="/prod/{!! $categoryProduct->product->id !!}">{!! $categoryProduct->product->name !!}</a>
        @foreach($categoryProduct->product->imageProducts as $imageProduct)
            <img src="{{ asset('images/'.$imageProduct->image->name) }}" width="500px" height="500px">
        @endforeach
    @endforeach

@endsection
