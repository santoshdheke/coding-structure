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

                    @yield('child_content')

                </div>
            </div>
        </div>
    </div>
</div>