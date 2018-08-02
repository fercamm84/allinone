@extends('layouts.base')

@section('content')



    <div id="content">
        <div class="container">


                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        @if(isset($category))
                            <li><a href="/cat/{{ $category->id }}">{{ $category->description}}</a></li>
                            @if(isset($product))
                                <li><a href="/prod/{{ $product->id }}">{{ $product->description }}</a></li>
                            @endif
                        @endif
                    </ul>
                </div>


            <div class="col-md-3">
                <!-- *** MENUS AND FILTERS ***
_________________________________________________________ -->
                <div class="panel panel-default sidebar-menu">

                    <div class="panel-heading">
                        <h3 class="panel-title">Categorías</h3>
                    </div>

                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked category-menu">
                            @if(isset($categories))
                                @foreach($categories as $category)
                                    <li class="dropdown yamm-fw">
                                        <a href="/cat/{{ $category->id }}">{{ $category->description }}</a>
                                    </li>
                                @endforeach
                            @else
                                @foreach($sections as $section)
                                    @if($section->type == 'home_principal')
                                        @foreach($section->sectionEntities as $sectionEntity)
                                            <?php $category = $sectionEntity->entity->entidad(); ?>
                                            <li class="dropdown yamm-fw">
                                                <a href="/cat/{{ $category->id }}">{{ $category->description }}</a>
                                            </li>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </ul>

                    </div>
                </div>

                <div class="panel panel-default sidebar-menu">

                </div>

                <!-- *** MENUS AND FILTERS END *** -->

                <div class="banner">
                    <a href="#">
                        {{--<img src="{{ asset('img/banner.jpg')}}" alt="sales 2014" class="img-responsive">--}}
                    </a>
                </div>
            </div>


            @yield('details')


        </div>
        <!-- /.container -->
    </div>

@endsection
