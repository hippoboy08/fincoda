<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{URL::asset('img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{!! ucfirst(Auth::user()->name) !!}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i>
                Admin


                </a>
            </div>
        </div>

              <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{!! url('admin') !!}"><i class="fa fa-tachometer" aria-hidden="true"></i> <span>Dashboard</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-building-o" aria-hidden="true"></i> <span>Company</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{!! url('admin/company') !!}"><i class="fa fa-list-alt" aria-hidden="true"></i>View Company Profile</a></li>
                    <li><a href="{!! url('admin/editCompanyProfile') !!}"><i class="fa fa-list-alt" aria-hidden="true"></i>Edit Company Profile</a></li>
                    <li><a href="{!! url('admin/deleteCompanyProfile') !!}"><i class="fa fa-list-alt" aria-hidden="true"></i>Delete Company Profile</a></li>
                    <li><a href="{!! url('admin/members') !!}"><i class="fa fa-spinner" aria-hidden="true"></i>Members</a></li>
                </ul>
            </li>


            <li class="treeview">
                <a href="#"><i class="fa fa-line-chart" aria-hidden="true"></i> <span>Survey</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{!! url('admin/survey/create') !!}"><i class="fa fa-list-alt" aria-hidden="true"></i>Create New</a></li>
                    <li><a href="{{url('admin/survey')}}"><i class="fa fa-pie-chart" aria-hidden="true"></i>Survey Results</a></li>

                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class="fa fa-users" aria-hidden="true"></i> <span>User Group</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('admin/usergroup/create')}}"><i class="fa fa-list-alt" aria-hidden="true"></i>Create New</a></li>
                    <li><a href="{{url('admin/usergroup')}}"><i class="fa fa-spinner" aria-hidden="true"></i>List All</a></li>

                </ul>
            </li>
            <li class="active"><a href="{!! url('admin/roles') !!}"><i class="fa fa-lock" aria-hidden="true"></i> <span>Permissions</span></a></li>

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
