@extends(AppHelper::getModule('common.layout'))

@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3>{{ AppHelper::getTitle() }} Page</h3>
        </div>

    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ AppHelper::getTitles() }}
                        <small>List</small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="dropdown">
                            <a href="{{ route(AppHelper::getBaseRoute('create')) }}" class="btn btn-dark btn-sm"> <i
                                    class="fa fa-plus"></i> Add {{ AppHelper::getTitle() }}</a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        </div>

                        <div class="clearfix"></div>

                        @if(isset($vendors) && count($vendors)>0)
                            @foreach($vendors as $vendor)
                                <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                                    <div class="well profile_view">
                                        <div class="col-sm-12">
                                            <h4 class="brief"><i>Digital Strategist</i></h4>
                                            <div class="left col-xs-7">
                                                <h2>{{ $vendor->full_name }}</h2>
                                                <p><strong>About: </strong> Web Designer / UI. </p>
                                                <ul class="list-unstyled">
                                                    <li><i class="fa fa-building"></i> Address:</li>
                                                    <li><i class="fa fa-phone"></i> Phone #:</li>
                                                    <li><i class="fa fa-envelope"></i> Email : {{ $vendor->email }}</li>
                                                </ul>
                                            </div>
                                            <div class="right col-xs-5 text-center">
                                                <img src="{{ asset('admin/src/images/user.png') }}" alt=""
                                                     class="img-circle img-responsive">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 bottom text-center">
                                            <div class="col-xs-12 col-sm-6 emphasis">
                                                <p class="ratings">
                                                    <a>4.0</a>
                                                    <a href="#"><span class="fa fa-star"></span></a>
                                                    <a href="#"><span class="fa fa-star"></span></a>
                                                    <a href="#"><span class="fa fa-star"></span></a>
                                                    <a href="#"><span class="fa fa-star"></span></a>
                                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                                </p>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 emphasis">
                                                <button type="button" class="btn btn-dark btn-xs"><i
                                                        class="fa fa-user">
                                                    </i> <i class="fa fa-comments-o"></i></button>
                                                <a href="{{ route(AppHelper::getBaseRoute('show'),$vendor->username) }}"
                                                   class="btn btn-dark btn-xs">
                                                    <i class="fa fa-user"> </i> View Profile
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>


                    {{--<table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Company Phone No</th>
                            <th>Pan No</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(isset($vendors) && count($vendors)>0)
                            @foreach($vendors as $vendor)
                                <tr>
                                    <td>{{ $vendor->full_name }}</td>
                                    <td>{{ $vendor->email }}</td>
                                    <td>{{ $vendor->username }}</td>
                                    <td>{{ $vendor->company_phone_no }}</td>
                                    <td>{{ $vendor->pan_no }}</td>
                                    <td>
                                        <a href="#">Active</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>


                    </table>--}}
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

    <script src="{{ asset('admin/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

@endpush
