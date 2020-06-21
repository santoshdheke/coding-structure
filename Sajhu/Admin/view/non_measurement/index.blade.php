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
                    <form action="{{ route('admin.non_measurement.sortable') }}" method="post">
                        {{ csrf_field() }}
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody id="sortable">
                            @if(isset($measurements) && count($measurements)>0)
                                @foreach($measurements as $measurement)
                                    <tr>
                                        <input type="hidden" name="ids[]" value="{{ $measurement->id }}">
                                        <td class="col-md-4">{{ $measurement->title }}</td>
                                        <td class="col-md-4">

                                            <a href="{{ route(AppHelper::getBaseRoute('edit'),$measurement) }}"
                                               class="btn btn-dark btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                            @include(AppHelper::getModule('common.delete_module'),[
                                                'id'=>$measurement->id,
                                                'title'=>$measurement->title
                                            ])
                                            @if(count($measurement->childs) > 0)
                                                <a href="{{ route(AppHelper::getBaseRoute('show'),$measurement) }}"
                                                   class="btn btn-dark btn-xs"><i class="fa fa-eye"></i> Show </a>
                                            @endif
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>


                        </table>
                        <button type="submit" class="btn btn-dark pull-right"><i class="fa fa-refresh"></i> Sortable
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

    {{--<script src="{{ asset('admin/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>--}}
    {{--<script src="{{ asset('admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>--}}
    @include(AppHelper::getModule('common.js.sortable'))
@endpush
