@extends('layouts.details')

@section('details')

    <div class="col-md-9">
        {{--<div class="box">--}}
            {{--<h1>{!! $category->description !!}</h1>--}}
            {{--<p>Descripcion Categoria</p>--}}
        {{--</div>--}}

        <div class="box info-bar">
            <div class="row">
                <!-- div class="col-sm-12 col-md-4 products-showing">
                    Showing <strong>{{ count($products) }}</strong> of <strong>25</strong> products
                </div -->

                <div class="col-sm-12 col-md-8  products-number-sort">
                    <div class="row">
                        <form class="form-inline">
                            <!-- div class="col-md-6 col-sm-6">
                                <div class="products-number">
                                    <strong>Show</strong>
                                        <a href="#" class="btn btn-default btn-sm btn-primary">12</a>
                                        <a href="#" class="btn btn-default btn-sm">24</a>
                                        <a href="#" class="btn btn-default btn-sm">All</a>
                                    products
                                </div>
                            </div-->
                            <div class="col-md-12 col-sm-6">
                                <div class="products-sort-by">
                                    <strong>Ordenar Por</strong>
                                    <select name="sort-by" id="sort-by" class="form-control" onchange="ordernarProductos();">
                                        <option value="0">Menor Precio</option>
                                        <option value="1">Mayor Precio</option>
                                        <option value="2">Nombre</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row products">

            @foreach($products as $product)

                <div class="col-md-4 col-sm-6">
                    <div class="product">
                        @if(sizeof($product->entity->imageEntities)>0)
                            <div class="flip-container">
                                <div class="flipper">
                                    <div class="front">
                                        <a href="/prod/{!! $product->id !!}">
                                            <img src="{{ asset('imagenes/'.$product->entity->imageEntities{0}->image->name) }}" class="img-responsive">
                                        </a>
                                    </div>
                                    @if(sizeof($product->entity->imageEntities)>1)
                                        <div class="back">
                                            <a href="/prod/{!! $product->id !!}">
                                                <img src="{{ asset('imagenes/'.$product->entity->imageEntities{1}->image->name) }}" class="img-responsive">
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="flip-container">
                                <div class="front">
                                    <a href="/prod/{!! $product->id !!}">
                                        <img src="{{ asset('/img/default-no-image.png')}}" class="img-responsive">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="/prod/{!! $product->id !!}">
                                        <img src="{{ asset('/img/default-no-image.png')}}" class="img-responsive">
                                    </a>
                                </div>
                            </div>
                        @endif
                        <a href="/prod/{!! $product->id !!}" class="invisible" >
                            <img src="{{ asset('/img/default-no-image.png')}}" alt="" class="img-responsive">
                        </a>
                        <div class="text">
                            <h3><a href="/prod/{!! $product->id !!}">{!! $product->name !!}</a></h3>
                            <p class="price">${!! $product->price !!}</p>
                            <p class="buttons">
                                <a href="/prod/{!! $product->id !!}" class="btn btn-default">Ver detalle</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <!-- /.products -->

        <!-- div class="pages">

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
        </div -->


    </div>
    <!-- /.col-md-9 -->

<script language="javascript">

    function ordernarProductos(){

    }

</script>
@endsection
