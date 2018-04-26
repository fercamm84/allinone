@extends('layouts.details')

@section('details')

    <div class="col-md-9">
        <div class="box">
            <h1>{!! $category->description !!}</h1>
            <p>Descripcion Categoria</p>
        </div>

        <div class="box info-bar">
            <div class="row">
                <div class="col-sm-12 col-md-4 products-showing">
                    Showing <strong>12</strong> of <strong>25</strong> products
                </div>

                <div class="col-sm-12 col-md-8  products-number-sort">
                    <div class="row">
                        <form class="form-inline">
                            <div class="col-md-6 col-sm-6">
                                <div class="products-number">
                                    <strong>Show</strong>  <a href="#" class="btn btn-default btn-sm btn-primary">12</a>  <a href="#" class="btn btn-default btn-sm">24</a>  <a href="#" class="btn btn-default btn-sm">All</a> products
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="products-sort-by">
                                    <strong>Sort by</strong>
                                    <select name="sort-by" class="form-control">
                                        <option>Price</option>
                                        <option>Name</option>
                                        <option>Sales first</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row products">

            @foreach($categoryProducts as $categoryProduct)

                <div class="col-md-4 col-sm-6">
                    <div class="product">
                        <div class="flip-container">
                            <div class="flipper">
                                <a href="/prod/{!! $categoryProduct->product->id !!}"></a>
                                @foreach($categoryProduct->product->imageProducts as $imageProduct)
                                    <div class="front">
                                        <img src="{{ asset('images/'.$imageProduct->image->name) }}" class="img-responsive">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <a href="/prod/{!! $categoryProduct->product->id !!}" class="invisible">
                            @foreach($categoryProduct->product->imageProducts as $imageProduct)
                                <img src="{{ asset('images/'.$imageProduct->image->name) }}" class="img-responsive">
                            @endforeach
                        </a>
                        <div class="text">
                            <h3><a href="/prod/{!! $categoryProduct->product->id !!}">{!! $categoryProduct->product->name !!}</a></h3>
                            <p class="price">${!! $categoryProduct->product->price !!}</p>
                            <p class="buttons">
                                <a href="/prod/{!! $categoryProduct->product->id !!}" class="btn btn-default">View detail</a>
                                <a href="/basket" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </p>
                        </div>
                        <!-- /.text -->
                    </div>
                    <!-- /.product -->
                </div>
            @endforeach

        </div>
        <!-- /.products -->

        <div class="pages">

            <p class="loadMore">
                <a href="#" class="btn btn-primary btn-lg"><i class="fa fa-chevron-down"></i> Load more</a>
            </p>

            <ul class="pagination">
                <li><a href="#">&laquo;</a>
                </li>
                <li class="active"><a href="#">1</a>
                </li>
                <li><a href="#">2</a>
                </li>
                <li><a href="#">3</a>
                </li>
                <li><a href="#">4</a>
                </li>
                <li><a href="#">5</a>
                </li>
                <li><a href="#">&raquo;</a>
                </li>
            </ul>
        </div>


    </div>
    <!-- /.col-md-9 -->


@endsection
