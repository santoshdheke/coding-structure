@extends(AppHelper::getModule('common.layout'))

@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3>E-commerce :: Product Page</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>E-commerce page design</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                                <a href="{{ route(AppHelper::getBaseRoute('index')) }}">test</a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <div class="product-image">
                            <img src="{{ asset('storage/images/products/'.$product->main_product_image) }}"
                                 alt="..."/>
                            {{--                            <img src="{{ asset('admin/src/images/prod-1.jpg') }}" alt="..." />--}}
                        </div>
                        <div class="product_gallery">
                            @foreach($product->images()->take(4)->get() as $image)
                                <a>
                                    <img src="{{ asset('storage/images/products/'.$image->image) }}" alt="..."/>
                                </a>
                            @endforeach
                            {{--<a>
                                <img src="{{ asset('admin/src/images/prod-3.jpg') }}" alt="..." />
                            </a>
                            <a>
                                <img src="{{ asset('admin/src/images/prod-4.jpg') }}" alt="..." />
                            </a>
                            <a>
                                <img src="{{ asset('admin/src/images/prod-5.jpg') }}" alt="..." />
                            </a>--}}
                        </div>
                    </div>

                    <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">

                        <h3 class="prod_title">{{ $product->product_name }}</h3>

                        <p>{!! $product->short_description !!}</p>
                        <br/>

                        <div class="">
                            <h2>Available Colors</h2>
                            <ul class="list-inline prod_color">
                                <li>
                                    <p>Green</p>
                                    <div class="color bg-green"></div>
                                </li>
                                <li>
                                    <p>Blue</p>
                                    <div class="color bg-blue"></div>
                                </li>
                                <li>
                                    <p>Red</p>
                                    <div class="color bg-red"></div>
                                </li>
                                <li>
                                    <p>Orange</p>
                                    <div class="color bg-orange"></div>
                                </li>

                            </ul>
                        </div>
                        <br/>

                        <div class="">
                            <h2>Size
                                <small>Please select one</small>
                            </h2>
                            <ul class="list-inline prod_size">
                                <li>
                                    <button type="button" class="btn btn-default btn-xs">Small</button>
                                </li>
                                <li>
                                    <button type="button" class="btn btn-default btn-xs">Medium</button>
                                </li>
                                <li>
                                    <button type="button" class="btn btn-default btn-xs">Large</button>
                                </li>
                                <li>
                                    <button type="button" class="btn btn-default btn-xs">Xtra-Large</button>
                                </li>
                            </ul>
                        </div>
                        <br/>

                        <div class="">
                            <div class="product_price">
                                <h1 class="price">Ksh80.00</h1>
                                <span class="price-tax">Ex Tax: Ksh80.00</span>
                                <br>
                            </div>
                        </div>

                        <div class="">
                            <button type="button" class="btn btn-default btn-lg">Add to Cart</button>
                            <button type="button" class="btn btn-default btn-lg">Add to Wishlist</button>
                        </div>

                        <div class="product_social">
                            <ul class="list-inline">
                                <li><a href="#"><i class="fa fa-facebook-square"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-twitter-square"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-envelope-square"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-rss-square"></i></a>
                                </li>
                            </ul>
                        </div>

                    </div>


                    <div class="col-md-12">

                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab"
                                                                          data-toggle="tab"
                                                                          aria-expanded="true">Home</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab"
                                                                    data-toggle="tab" aria-expanded="false">Profile</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2"
                                                                    data-toggle="tab" aria-expanded="false">Profile</a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1"
                                     aria-labelledby="home-tab">
                                    <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu
                                        stumptown aliqua, retro synth master cleanse. Mustache cliche tempor,
                                        williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh
                                        dreamcatcher
                                        synth. Cosby sweater eu banh mi, qui irure terr.</p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content2"
                                     aria-labelledby="profile-tab">
                                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee
                                        squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes
                                        anderson artisan four loko farm-to-table craft beer twee. Qui photo
                                        booth letterpress, commodo enim craft beer mlkshk aliquip</p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content3"
                                     aria-labelledby="profile-tab">
                                    <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin
                                        coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next
                                        level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                                        photo booth letterpress, commodo enim craft beer mlkshk </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
