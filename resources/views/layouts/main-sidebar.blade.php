<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- Dashboard menu item-->
                    <li>
                        <a href="{{route('dashboard')}}"  >
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">Home</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- menu title -->
                    <!-- Elements menu item-->
                    <li>
                    <a href="{{route('getCategory')}}"  >
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">Category</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- calendar menu item-->
                    <li>
                    <a href="{{route('getSubCategory')}}"  >
                            <div class="pull-left"><i class="fa fa-sitemap"></i><span
                                    class="right-nav-text">SubCategory</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                    <a href="{{route('getGallery')}}">
                            <div class="pull-left"><i class="fa fa-picture-o"></i><span
                                    class="right-nav-text">Gallery</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                    <a href="{{route('admin.providers.index')}}">
                            <div class="pull-left"><i class="fa fa-user"></i><span
                                    class="right-nav-text">Users</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                
                   
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

