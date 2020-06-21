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
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Country Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(isset($brands) && count($brands)>0)
                            @foreach($brands as $brand)
                                <tr>
                                    <td class="col-md-5">{{ $brand->brand_name }}</td>
                                    <td class="col-md-3">
                                        <a href="{{ route(AppHelper::getBaseRoute('edit'),$brand) }}"
                                           class="btn btn-dark btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                        @include(AppHelper::getModule('common.delete_module'),[
                                            'id'=>$brand->id,
                                            'title'=>$brand->brand_name
                                        ])
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

<script src="{{ asset('admin/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

@endpush
