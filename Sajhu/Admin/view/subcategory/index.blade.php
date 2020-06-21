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
                            <a href="{{ route(AppHelper::getBaseRoute('create'),$category) }}"
                               class="btn btn-dark btn-sm"> <i
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
                        @if(isset($subcategories) && count($subcategories)>0)
                            @foreach($subcategories as $suubcategory)
                                <tr>
                                    <td class="col-md-5">{{ $suubcategory->category_title }}</td>
                                    <td class="col-md-3">
                                        <a href="{{ route(AppHelper::getBaseRoute('edit'),['category' => $category,'subcategory' => $suubcategory]) }}"
                                           class="btn btn-dark btn-xs"><i class="fa fa-pencil"></i> Edit </a>


                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-dark btn-xs" data-toggle="modal"
                                                data-target="#delete{{ $suubcategory->id }}">
                                            <i class="fa fa-trash-o"></i> Delete
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="delete{{ $suubcategory->id }}" tabindex="-1"
                                             role="dialog" aria-labelledby="exampleModalLongTitle"
                                             aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form
                                                        action="{{ route(AppHelper::getBaseRoute('destroy'),['category' => $category, 'category_id' => $suubcategory]) }}"
                                                        method="post">
                                                        @csrf @method('delete')
                                                        <div class="modal-header"
                                                             style="background-color: #4B5F71;color: #ffffff">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">
                                                                <b>Delete {{ AppHelper::getTitle() }}</b></h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are You Sure you want to delete <b
                                                                style="color: #4B5F71">{{ $suubcategory->sub_category_title }}</b>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-dark btn-xs"
                                                                    data-dismiss="modal"><i class="fa fa-remove"></i>
                                                                Cancel
                                                            </button>
                                                            <button type="submit" class="btn btn-dark btn-xs"><i
                                                                    class="fa fa-trash"></i> Delete
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        @if($suubcategory->have_child == 1)
                                            <a href="{{ route('admin.minisubcategory.index',$suubcategory) }}"
                                               class="btn btn-dark btn-xs"><i class="fa fa-list"></i> Mini Sub Category
                                            </a>
                                        @endif


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
