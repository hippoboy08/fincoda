@extends('master')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12 col-md-offset-0">
            <!-- general form elements -->


            <div class="box-header with-border">
                <h3 class="box-title"><b>Survey Result.</b></h3>
                <p><i>Below is the information about the pending survey you requested.
                        You can make changes or abort it before it is open to the participants.</i></p>
            </div>

            @include('message.fail')
            @include('message.errors_head')
            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="container">
                                <h2>Survey Results</h2><br>
                                <h5><label>Title : </label> {!! $survey->title !!}</h5>
                                <h5><label>Type : </label> {!! \App\Survey_Type::find($survey->type_id)->name !!}</h5>
                                <h5><label>Open : </label> {!! $survey->start_time .' TO '. $survey->end_time !!}</h5>
                                <h5><label>Total Participants : </label> {!! count($participants)!!}</h5>
                                <h5><label>Total answers : </label> {!! $answers!!}</h5>

                                @role('admin')

                                <p class="panel-title">
                                    <a data-toggle="collapse" href="#collapse1"><i class="fa fa-sort-desc" aria-hidden="true"></i>
                                        <label>Participants of the survey</label></a>
                                <p>Below is the list of all the company members invited to take part in this survey.</p>
                                </p>


                                <div id="collapse1" class="panel-collapse collapse">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Email Address</th>
                                            <th>Survey Status</th>


                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($participants as $participant)
                                            <tr>
                                            <td>{!! \App\User::find($participant->user_id)->name !!}</td>
                                            <td>{!! \App\User::find($participant->user_id)->email  !!}</td>
                                                @if($participant->completed==0)
                                                    <td><span class="label label-danger">Not completed</span></td>
                                                    @else
                                                    <td><span class="label label-success">Completed</span></td>
                                                @endif
                                            </tr>

                                            @endforeach


                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Email Address</th>
                                            <th>Survey Status</th>
                                        </tr>
                                        </tfoot>
                                    </table>

                                </div><br>
                                @endrole

                                @role('special')
                                @if(Route::current()->getName()=='special.groupsurvey.show')
                                <p class="panel-title">
                                    <a data-toggle="collapse" href="#collapse1"><i class="fa fa-sort-desc" aria-hidden="true"></i>
                                        <label>Participants of the survey</label></a>
                                <p>Below is the list of all the company members invited to take part in this survey.</p>
                                </p>


                                <div id="collapse1" class="panel-collapse collapse">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Email Address</th>
                                            <th>Survey Status</th>


                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($participants as $participant)
                                            <tr>
                                                <td>{!! \App\User::find($participant->user_id)->name !!}</td>
                                                <td>{!! \App\User::find($participant->user_id)->email  !!}</td>
                                                @if($participant->completed==0)
                                                    <td><span class="label label-danger">Not completed</span></td>
                                                @else
                                                    <td><span class="label label-success">Completed</span></td>
                                                @endif
                                            </tr>

                                        @endforeach


                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Email Address</th>
                                            <th>Survey Status</th>
                                        </tr>
                                        </tfoot>
                                    </table>

                                </div><br>
                                @endif
                                @endrole


                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home">Categories</a></li>
                                    <li><a data-toggle="tab" href="#menu1">Indicators</a></li>

                                </ul>

                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">


                                       <div class="row pull-right" >
                                          <i class="fa fa-print" aria-hidden="true"></i> <u>Print report (PDF)</u>
                                       </div>


                                        <h3>HOME</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

                                    </div>
                                    <div id="menu1" class="tab-pane fade">

                                        <div class="row pull-right" >
                                            <i class="fa fa-print" aria-hidden="true"></i> <u>Print report (PDF)</u>
                                        </div>


                                        <h3>Menu 1</h3>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>

                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




@stop