@extends('home.layouts.home')

@section('content')

    @foreach($categoryProducts as $categoryProduct)
        <a href="/prod/{!! $categoryProduct->product->id !!}">{!! $categoryProduct->product->name !!}</a>
        @foreach($categoryProduct->product->imageProducts as $imageProduct)
            <img src="{{ asset('images/'.$imageProduct->image->name) }}">
        @endforeach
    @endforeach

@endsection
