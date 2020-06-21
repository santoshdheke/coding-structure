<li class="{{ Request::is('admin/dashboard')?'active':'' }}">
    <a href="{{ route('admin.dashboard') }}">
        <i class="fa fa-home"></i> Dashboard
    </a>
</li>

<li class="{{ Request::is('admin/vendor*')?'active':'' }}">
    <a href="{{ route('admin.vendor.index') }}">
        <i class="fa fa-industry"></i> Vendor
    </a>
</li>

<li class="{{ Request::is('admin/currency*')?'active':'' }}">
    <a href="{{ route('admin.currency.index') }}">
        <i class="fa fa-money"></i> Currency
    </a>
</li>

<li class="{{ Request::is('admin/language*')?'active':'' }}">
    <a href="{{ route('admin.language.index') }}">
        <i class="fa fa-flag"></i> Language
    </a>
</li>

<li class="{{ Request::is('admin/category*')?'active':'' }}">
    <a href="{{ route('admin.category.index') }}">
        <i class="fa fa-list-alt"></i> Product Category
    </a>
</li>

<li class="{{ Request::is('page/*')?'active current_page_li':'' }}">
    <a>
        <i class="fa fa-file"></i> Attributes
        <span class="fa fa-chevron-down"></span>
    </a>
    <ul class="nav child_menu">

        <li class="{{ Request::is('admin/attribute*')?'active active_li':'' }}">
            <a class="active_a" href="{{ route('admin.attribute.index') }}">
                <i class="fa fa-tag"></i> Product Attributes
            </a>
        </li>

        <li class="{{ Request::is('admin/measurement*')?'active active_li':'' }}">
            <a class="active_a" href="{{ route('admin.measurement.index') }}">
                <i class="fa fa-tag"></i> Measurement
            </a>
        </li>

        <li class="{{ Request::is('admin/non_measurement*')?'active active_li':'' }}">
            <a class="active_a" href="{{ route('admin.non_measurement.index') }}">
                <i class="fa fa-tag"></i> Non Measurement
            </a>
        </li>

    </ul>
</li>

<li class="{{ Request::is('admin/brand*')?'active':'' }}">
    <a href="{{ route('admin.brand.index') }}">
        <i class="fa fa-tag"></i> Brands Manage
    </a>
</li>

<li class="{{ Request::is('admin/product*')?'active':'' }}">
    <a href="{{ route('admin.product.index') }}">
        <i class="fa fa-tag"></i> Product
    </a>
</li>

<li class="{{ Request::is('admin/banner*')?'active':'' }}">
    <a href="{{ route('admin.banner.index') }}">
        <i class="fa fa-tag"></i> Banner Manage
    </a>
</li>

<li class="{{ Request::is('page/*')?'active current_page_li':'' }}">
    <a>
        <i class="fa fa-file"></i> Pages
        <span class="fa fa-chevron-down"></span>
    </a>
    <ul class="nav child_menu">
        @foreach(config('page.pages') as $page)
            <li class="{{ Request::is('admin/page/'.$page.'')?'active active_li':'' }}">
                <a class="active_a" href="{{ route('admin.page.index',$page) }}">{{ ucwords(str_replace('_',' ',$page)) }} {{ $page }}</a>
            </li>
        @endforeach
    </ul>
</li>
