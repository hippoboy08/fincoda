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
                    Special User


                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{!! url('special') !!}"><i class="fa fa-tachometer" aria-hidden="true"></i> <span>Dashboard</span></a></li>
            <li class="active"><a href="{!! url('special/profile') !!}"><i class="fa fa-user" aria-hidden="true"></i> <span>Profile</span></a></li>

            <li class="treeview">
                <a href="#"><i class="fa fa-line-chart" aria-hidden="true"></i> <span>Organization Survey</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{action('special\CompanySurveyController@index')}}"><i class="fa fa-pie-chart" aria-hidden="true"></i>Survey Results</a></li>

                </ul>
            </li>


            <li class="treeview">
                <a href="#"><i class="fa fa-users" aria-hidden="true"></i> <span>User Group</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('special/usergroup')}}"><i class="fa fa-info-circle" aria-hidden="true"></i>Group info</a></li>
                    <li><a href="{{url('special/groupsurvey')}}"><i class="fa fa-tachometer" aria-hidden="true"></i>Group Dashboard</a></li>
                    <li><a href="{!! url('special/groupsurvey/create') !!}"><i class="fa fa-list-alt" aria-hidden="true"></i>Create group survey</a></li>
                    <li><a href="{!! url('special/groupsurveyresult') !!}"><i class="fa fa-pie-chart" aria-hidden="true"></i>Survey Results</a></li>
					<li hidden><a href="{{url('special/usergroup/create')}}"><i class="fa fa-list-alt" aria-hidden="true"></i>Create New Group</a></li>
                </ul>

                
            <li class = "logOut">
                <a href="http://localhost:8000/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> <span>Sign Out</span></a>
            </li>
            
            </li>



        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
