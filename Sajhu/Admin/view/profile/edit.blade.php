@extends(AppHelper::getModule('common.layout'))

@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3>User Profile</h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>User Report
                        <small>Activity report</small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-wrench"></i> Option</a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                        <div class="profile_img">
                            <div id="crop-avatar">
                                <!-- Current avatar -->
                                <label for="profile_image">
                                    <img id="{{--upload_profile_picture--}}" class="img-responsive avatar-view"
                                         src="{{ asset('admin/src/images/user.png') }}"
                                         alt="Avatar" title="Change the avatar">
                                </label>
                            </div>
                        </div>
                        <h3>Samuel Doe</h3>

                        <ul class="list-unstyled user_data">
                            <li><i class="fa fa-map-marker user-profile-icon"></i> San Francisco, California, USA
                            </li>

                            <li>
                                <i class="fa fa-briefcase user-profile-icon"></i> Software Engineer
                            </li>

                            <li class="m-top-xs">
                                <i class="fa fa-external-link user-profile-icon"></i>
                                <a href="http://www.kimlabs.com/profile/" target="_blank">www.kimlabs.com</a>
                            </li>
                        </ul>

                        <a class="btn btn-success" href="{{ route('admin.profile.edit') }}"><i
                                    class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                        <br/>

                        <!-- start skills -->
                        <h4>Skills</h4>
                        <ul class="list-unstyled user_data">
                            <li>
                                <p>Web Applications</p>
                                <div class="progress progress_sm">
                                    <div class="progress-bar bg-green" role="progressbar"
                                         data-transitiongoal="50"></div>
                                </div>
                            </li>
                            <li>
                                <p>Website Design</p>
                                <div class="progress progress_sm">
                                    <div class="progress-bar bg-green" role="progressbar"
                                         data-transitiongoal="70"></div>
                                </div>
                            </li>
                            <li>
                                <p>Automation & Testing</p>
                                <div class="progress progress_sm">
                                    <div class="progress-bar bg-green" role="progressbar"
                                         data-transitiongoal="30"></div>
                                </div>
                            </li>
                            <li>
                                <p>UI / UX</p>
                                <div class="progress progress_sm">
                                    <div class="progress-bar bg-green" role="progressbar"
                                         data-transitiongoal="50"></div>
                                </div>
                            </li>
                        </ul>
                        <!-- end of skills -->

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#generalSetting" id="home-tab" role="tab" data-toggle="tab"
                                       aria-expanded="true">
                                        General Setting
                                    </a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#profile_picture" role="tab" id="profile-tab" data-toggle="tab"
                                       aria-expanded="false">
                                        Picture
                                    </a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#secutiry" role="tab" id="profile-tab2" data-toggle="tab"
                                       aria-expanded="false">
                                        Security
                                    </a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="generalSetting"
                                     aria-labelledby="home-tab">
                                    @include(AppHelper::getViewPath('common.general_setting'))
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="profile_picture"
                                     aria-labelledby="profile-tab">
                                    @include(AppHelper::getViewPath('common.profile_picture'))
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="secutiry"
                                     aria-labelledby="profile-tab">
                                    @include(AppHelper::getViewPath('common.security'))
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('css')
<!-- bootstrap-daterangepicker -->
<link href="{{ asset('admin/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
@endpush

@push('js')
<!-- morris.js -->
<script src="{{ asset('admin/vendors/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('admin/vendors/morris.js/morris.min.js') }}"></script>
<!-- bootstrap-progressbar -->
<script src="{{ asset('admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset('admin/vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('admin/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

<script type="text/javascript">

    $(document).ready(function () {

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            localStorage.setItem('activeTab', $(e.target).attr('id'));
        });

        var activeTab = localStorage.getItem('activeTab');

        if (activeTab) {
            $('#' + activeTab).tab('show');
        }

    });

</script>

@endpush