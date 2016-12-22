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
                   Basic


                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{!! url('basic') !!}"><i class="fa fa-tachometer" aria-hidden="true"></i> <span>Dashboard</span></a></li>
            <li class="active"><a href="{!! url('basic/profile') !!}"><i class="fa fa-user" aria-hidden="true"></i> <span>Profile</span></a></li>

            <li class="treeview">
                <a href="#"><i class="fa fa-line-chart" aria-hidden="true"></i> <span>Survey</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{action('basic\SurveyController@index')}}"><i class="fa fa-pie-chart" aria-hidden="true"></i>Survey Results</a></li>

                </ul>
            </li>

            <li class="treeview">
                <a href=""><i class="fa fa-users" aria-hidden="true"></i> <span>User Group</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{!! url('basic/usergroup') !!}"><i class="fa fa-users" aria-hidden="true"></i>My Groups</a></li>

                </ul>
            </li>


        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>