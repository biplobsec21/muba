<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="{{ url('admin/dashboard') }}" class="site_title">
                   <!-- <i class="fa fa-paw"></i> -->
            <!-- <span>Pharmexx!</span> -->
            <b style="color:black;">IMAGE PANEL</b>
        </a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    
    <!-- /menu profile quick info -->
    <br />
    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <ul class="nav side-menu">
                <li class="">
                    <a href="{{ url('admin/dashboard') }}" class="{{ $page['active'] == 'dashboard' ? 'active' : '' }}">
                        <i class="fa fa-tachometer"></i> 
                        Dashboard 
                    </a>
                </li>
                <li class="{{ $page['active'] == 'adminuser' ? 'active' : '' }}">
                    <a href="{{ url('admin/adminuser') }}">
                        <i class="fa fa-user"></i> User 
                    </a>
                </li>
              

                <li class="{{ $page['active'] == 'content' ? 'active' : '' }}">
                    <a href="{{ url('admin/content') }}">
                        <i class="fa fa-file"></i> Content 
                    </a>
                </li>

                
                <li>
                    <a><i class="fa fa-cog"></i> Settings <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li class="{{  $page['active'] == 'category' ? 'active' : '' }}">
                            <a href="{{ url('admin/settings/category') }}"> Category </a>
                        </li>
                        
                        
                    </ul>
                </li>
                

            </ul>
        </div>

    </div>
    <!-- /sidebar menu -->
</div>
