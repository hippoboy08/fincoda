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
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home">Participants</a></li>
                                    <li><a data-toggle="tab" href="#menu1">Individual Scores</a></li>
                                    <li><a data-toggle="tab" href="#menu2">Individual And Group Averages</a></li>
                                    <li><a data-toggle="tab" href="#menu3">Individual Scores And Indicator Groups</a></li>
                                    <li><a data-toggle="tab" href="#menu3">Individual Scores And Indicator Group Averages</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">
                                       <div class="row pull-right" >
                                          <i class="fa fa-print" aria-hidden="true"></i> <u>Print report (PDF)</u>
                                       </div>
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

                                    </div>
                                    <div id="menu1" class="tab-pane fade in active">
                                       <div class="row pull-right" >
                                          <i class="fa fa-print" aria-hidden="true"></i> <u>Print report (PDF)</u>
                                       </div>
                                        <table id="individual_scores" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Group ID</th>
                                                <th>Survey ID</th>
                                                <th>User ID</th>
                                                <th>Indicator ID</th>
                                                <th>Answer</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                              @if(count($surveyScoreAllUsers)==0)
                                                You have no surveys results to Display
                                              @else
                                              @foreach($surveyScoreAllUsers as $result)
                                              <tr>
                                              <td><b>{!! $result->Group_ID !!}</b></td>
                                              <td><b>{!! $result->Survey_ID !!}</b></td>
                                              <td><b>{!! $result->User_ID !!}</b></td>
                                              <td><b>{!! $result->Indicator_ID !!}</b></td>
                                              <td><b>{!! $result->Answer !!}</b></td>
                                              </tr>
                                              @endforeach
                                              @endif
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                              <th>Group ID</th>
                                              <th>Survey ID</th>
                                              <th>User ID</th>
                                              <th>Indicator ID</th>
                                              <th>Answer</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div id="menu2" class="tab-pane fade">
                                        <div class="row pull-right" >
                                            <i class="fa fa-print" aria-hidden="true"></i> <u>Print report (PDF)</u>
                                        </div>
                                        <table id="individual_scores" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Group ID</th>
                                                <th>Survey ID</th>
                                                <th>Indicator ID</th>
                                                <th>Indicator</th>
                                                <th>Group_Average</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                              @if(count($surveyGroupAveragePerIndicatorAllUsers)==0)
                                                You have no surveys results to Display
                                              @else
                                              @foreach($surveyGroupAveragePerIndicatorAllUsers as $result)
                                              <tr>
                                              <td><b>{!! $result->Group_ID !!}</b></td>
                                              <td><b>{!! $result->Survey_ID !!}</b></td>
                                              <td><b>{!! $result->Indicator_ID !!}</b></td>
                                              <td><b>{!! $result->Indicator !!}</b></td>
                                              <td><b>{!! $result->Group_Average !!}</b></td>
                                              </tr>
                                              @endforeach
                                              @endif
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                              <th>Group ID</th>
                                              <th>Survey ID</th>
                                              <th>User ID</th>
                                              <th>Indicator ID</th>
                                              <th>Answer</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div id="menu3" class="tab-pane fade">
                                        <div class="row pull-right" >
                                            <i class="fa fa-print" aria-hidden="true"></i> <u>Print report (PDF)</u>
                                        </div>
                                        <table id="individual_scores" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Group ID</th>
                                                <th>Survey ID</th>
                                                <th>User ID</th>
                                                <th>Indicator Group</th>
                                                <th>Indicator Group Average</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                              @if(count($surveyScoreGroupAvgPerIndicatorGroup)==0)
                                                You have no surveys results to Display
                                              @else
                                              @foreach($surveyScoreGroupAvgPerIndicatorGroup as $result)
                                              <tr>
                                              <td><b>{!! $result->Group_ID !!}</b></td>
                                              <td><b>{!! $result->Survey_ID !!}</b></td>
                                              <td><b>{!! $result->User_ID !!}</b></td>
                                              <td><b>{!! $result->Indicator_Group !!}</b></td>
                                              <td><b>{!! $result->Indicator_Group_Average !!}</b></td>
                                              </tr>
                                              @endforeach
                                              @endif
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                              <th>Group ID</th>
                                              <th>Survey ID</th>
                                              <th>User ID</th>
                                              <th>Indicator Group</th>
                                              <th>Indicator Group Average</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div id="menu4" class="tab-pane fade">
                                        <div class="row pull-right" >
                                            <i class="fa fa-print" aria-hidden="true"></i> <u>Print report (PDF)</u>
                                        </div>
                                        <table id="individual_scores" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Group ID</th>
                                                <th>Survey ID</th>
                                                <th>Indicator Group</th>
                                                <th>Indicator Group Average</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                              @if(count($surveyScorePerIndicatorGroup)==0)
                                                You have no surveys results to Display
                                              @else
                                              @foreach($surveyScorePerIndicatorGroup as $result)
                                              <tr>
                                              <td><b>{!! $result->Group_ID !!}</b></td>
                                              <td><b>{!! $result->Survey_ID !!}</b></td>
                                              <td><b>{!! $result->Indicator_Group !!}</b></td>
                                              <td><b>{!! $result->Indicator_Group_Average !!}</b></td>
                                              </tr>
                                              @endforeach
                                              @endif
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                              <th>Group ID</th>
                                              <th>Survey ID</th>
                                              <th>Indicator Group</th>
                                              <th>Indicator Group Average</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    @endrole
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop
