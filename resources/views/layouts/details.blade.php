@extends('layouts.base')

@section('content')



    <div id="content">
        <div class="container">

            @if(isset($category))
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="/">Home</a>
                        </li>
                        <li>{!! $category->description!!}</li>
                    </ul>
                </div>
            @endif

            <div class="col-md-3">
                <!-- *** MENUS AND FILTERS ***
_________________________________________________________ -->
                <div class="panel panel-default sidebar-menu">

                    <div class="panel-heading">
                        <h3 class="panel-title">Categorias</h3>
                    </div>

                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked category-menu">
                            @if(isset($categories))
                                @foreach($categories as $category)
                                    <li class="dropdown yamm-fw">
                                        <a href="/cat/{!! $category->id !!}">{!! $category->description !!}</a>
                                    </li>
                                @endforeach
                            @else
                                @foreach($sections as $section)
                                    @if($section->type == 'home_principal')
                                        @foreach($section->sectionCategories as $sectionCategory)
                                            <li class="dropdown yamm-fw">
                                                <a href="/cat/{!! $sectionCategory->category->id !!}">{!! $sectionCategory->category->description !!}</a>
                                            </li>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </ul>

                    </div>
                </div>

                <div class="panel panel-default sidebar-menu">

                    <!-- div class="panel-heading">
                        <h3 class="panel-title">Brands <a class="btn btn-xs btn-danger pull-right" href="#"><i class="fa fa-times-circle"></i> Clear</a></h3>
                    </div -->

                    <!-- div class="panel-body">

                        <form>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">Armani (10)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">Versace (12)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">Carlo Bruni (15)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">Jack Honey (14)
                                    </label>
                                </div>
                            </div>

                            <button class="btn btn-default btn-sm btn-primary"><i class="fa fa-pencil"></i> Apply</button>

                        </form>

                    </div -->
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
