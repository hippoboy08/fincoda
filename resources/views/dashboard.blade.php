@extends('master')
@section('content')

    <div class="row">
        <!-- left column -->
        <div class="col-md-12 col-md-offset-0">

            @include('message.success')

            <div class="box-header with-border">
                <h3 class="box-title"><b>User Dashboard.</b></h3>
                <p><i>Below is the list of all the surveys that you have been requested. If there is any open survey, please open it to answer.
                    Also, you can view the results of all the closed surveys you have participated in.</i></p>
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

                        @role('special')
                        @include('survey.open')
                        @include('survey.closed')
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