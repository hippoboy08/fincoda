<!DOCTYPE html>


    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>F</b>IN</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>FINCODA</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">

					<div class="pull-right" >
							<h5 class="select-users"><label></label>
								<select id="languageId">
									<option value="">language</option>
									<option value="fi">fi</option>
									<option value="en">en</option>
									<option value="de">de</option>
									<option value="nl">nl</option>
									<option value="sp">sp</option>
								</select>
							</h5>

							<script>
								  $(document).ready(function(){
								  $('#languageId').change(function(){
								  if($(this).val()==""){
								  return;
								  }
								  else{
										   $.ajaxSetup({
											 headers:{
											   'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
											 }
										   });
										   $.ajax({
											 method: 'POST',
											 url: window.location.protocol+"//"+window.location.host+"/"+"fincoda-phase2-complete/public/admin/language",
											 dataType: 'json',
											 data: {'languageId':$(this).val()},
											 success: function(data){
												 //alert(data.stri);
											 window.location.replace(window.location);
											},
										  error: function(result){
												var errors = result.responseJSON;
												console.log(result);
												console.log(errors);
										  }

									   });
									   }
									 });
								   });
							</script>
					</div>


                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->

                    <li class="dropdown messages-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">0</span>
                        </a>

                    </li><!-- /.messages-menu -->

                    <!-- Notifications Menu -->
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">0</span>
                        </a>

                    </li>
                    <!-- Tasks Menu -->
                    <li class="dropdown tasks-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">0</span>
                        </a>

                    </li>
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle action" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{URL::asset('img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{!! strtoupper(Auth::User()->name) !!}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{URL::asset('img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                                <p>
                                    {!! ucfirst(Auth::User()->name) !!}

                                    <small>{!!ucfirst(Auth::User()->company->name) !!}</small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{url('admin/members/'.Auth::id())}}" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{url('logout')}}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
