@extends('master')
@section('content')

    <div class="row">
        <!-- left column -->
        <div class="col-md-12 col-md-offset-0">

            @include('message.success')
			@if(Session::has('message'))
                <h4 style="color:red;">{{Session::get('message')}}</h4>
            @endif

            <div class="box-header with-border">
			
			
                @if(Route::current()->getName()=='special.survey.index')
                    <h3 class="box-title"><b>Organization Group Dashboard.</b></h3>
                    <p><i>Below is the list of all the surveys in your group.</i></p>
                    @else
                    <h3 class="box-title"><b>Dashboard.</b></h3>
                    <p><i>Below is a list of all the surveys that you have been registered to complete.  If there is an open survey, please click to answer it. Also, you can view the results of all the closed surveys you have participated in.</i></p>
                    @endif
					
            </div>
            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel panel-default">
                        @role('admin')
                       @include('survey.pending')
                       @include('survey.open')
                       @include('survey.closed')
                        @endrole

                        @role('basic')
                        @include('survey.open')
                        @include('survey.closed')
                        @endrole
						
						@role('external')
                        @include('survey.open')
                        @endrole
						
                        @role('special')
                        @if(Route::current()->getName()=='special.groupsurvey.index')
                            @include('survey.pending')
                            @include('survey.open')
                            @include('survey.closed')
                            @else
                            @include('survey.open')
                            @include('survey.closed')
                            @endif

                        @endrole

                    </div>

                    </div>
                </div>
    </div>
    </div>
    <!-- DataTables -->
    <script src="{{URL::asset('datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('datatables/dataTables.bootstrap.min.js')}}"></script>

    <script>
        $(function () {
            $("#example1").DataTable();
            $("#example2").DataTable();
            $("#example3").DataTable();


        });
    </script>

    @stop