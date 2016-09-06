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
                            <div>
                                <h2>Survey Results</h2><br>
                                <!-- <label id="surveyId">{!! $survey->title !!}</label> -->
                                <ul>
                                  <li><h5><label>Title : </label> {!! $survey->title !!}</h5></li>
                                  <li><h5><label>Type : </label> {!! \App\Survey_Type::find($survey->type_id)->name !!}</h5></li>
                                  <li><h5><label>Start time : </label> {!! $survey->start_time !!}</h5></li>
                                  <li><h5><label>Deadline : </label> {!! $survey->end_time !!}</h5></li>
                                  <li><h5><label>Total Participants : </label> {!! count($participants)!!}</h5></li>
                                  <li><h5><label>Total answers : </label> {!! $answers!!}</h5></li>
                                </ul>

                                <ul class="nav nav-tabs">
                                  <li class="active"><a data-toggle="tab" href="#overview">Overview</a></li>
                                  <li><a data-toggle="tab" href="#detailedview">Detailed View</a></li>
                                </ul>

                                <div class="tab-content">
                                  <div id="overview" class="tab-pane fade in active">
                                    <div class="report-caption">
                                      <h4><b>Description</b></h4>
                                      <p>The bar graph shows your answers in this survey.
                          							The table underneath this graph displayed the same data in table format.
                          							Alternate between the two buttons to view your scores only or in comparison with the group average.
                          							Only your score are shown by default.</p>
                                    </div>
                                    <div>
                                      <table class="table table-bordered table-striped text-center">
                                        <h4><b>Score</b></h4>
                                          <thead>
                                          <tr>
                                              <th>0</th>
                                              <th>1</th>
                                              <th>2</th>
                                              <th>3</th>
                                              <th>4</th>
                                              <th>5</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                                <td>Not observed</td>
                                                <td>Very poor</td>
                                                <td>Need to improve</td>
                                                <td>Pass</td>
                                                <td>Good</td>
                                                <td>Excellent</td>
                                            </tr>
                                          </tbody>
                                        </table>
                                    </div>

                                    <div>
                                      <table class="table table-bordered table-striped text-center">
                                        <h4><b>Indicators</b></h4>
                                          <thead>
                                          <tr>

                                              <th>ID</th>
                                              <th>Indicator</th>
                                              <th>Group_Average</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                            @if(count($surveyScoreAllUsers)==0)
                                              <div>You have no surveys results to display</div>
                                            @else
                                              @foreach($surveyGroupAveragePerIndicatorAllUsers as $result)
                                                <tr>

                                                  <td>{!! $result->Indicator_ID !!}</td>
                                                  <td>{!! $result->Indicator !!}</td>
                                                  <td>{!! $result->Group_Average !!}</td>
                                                </tr>
                                              @endforeach
                                            @endif
                                          </tbody>
                                      </table>
                                    </div>

                                    <div>
                                      @include ('survey.resultContent.surveyScorePerIndicatorGroup')
                                    </div> 
                                  </div>


                                  <div id="detailedview" class="tab-pane fade">
                                    @role ('basic')
                                      <div>This content is available only for Administrators.</div>
                                    @endrole

                                    @role ('admin')
                                      <ul class="nav nav-tabs">
                                          <li class="active"><a data-toggle="tab" href="#participants">Participants</a></li>
                                          <li><a data-toggle="tab" href="#menu1">Participants Scores</a></li>
                                          <li><a data-toggle="tab" href="#menu2">User Groups Indicator Averages</a></li>
                                          <li><a data-toggle="tab" href="#menu3">Participants Scores On Indicator Groups</a></li>
                                          <li><a data-toggle="tab" href="#menu4">User Groups And Indicator Group Averages</a></li>
                                          <li><a data-toggle="tab" href="#menu5">Admin View</a></li>
                                      </ul>

                                    <div class="tab-content">
                                        <div id="participants" class="tab-pane fade in active">
                                           <div class="row pull-right" >
                                              <i class="fa fa-print" aria-hidden="true"></i> <u>Print report (PDF)</u>
                                           </div>

                                           <div>
                                             <table id="Participants" class="table table-bordered table-striped text-center">
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
                                             </table>
                                         </div>
                                        </div>
                                        <div id="menu1" class="tab-pane fade">
                                           <div class="row pull-right" >
                                              <i class="fa fa-print" aria-hidden="true"></i> <u>Print report (PDF)</u>
                                           </div>

                                           <div>
                                            <table id="Participants_scores" class="table table-bordered table-striped text-center">
                                                <thead>
                                                <tr>

                                                    <th>Survey ID</th>
                                                    <th>User ID</th>
                                                    <th>Indicator ID</th>
                                                    <th>Indicator </th>
                                                    <th>Answer</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                  @if(count($surveyScoreAllUsers)==0)
                                                    <div>You have no surveys results to display</div>
                                                  @else
                                                  @foreach($surveyScoreAllUsers as $result)
                                                  <tr>

                                                    <td>{!! $result->Survey_ID !!}</td>
                                                    <td>{!! $result->User_ID !!}</td>
                                                    <td>{!! $result->Indicator_ID !!}</td>
                                                    <td>{!! $result->Indicator !!}</td>
                                                    <td>{!! $result->Answer !!}</td>
                                                  </tr>
                                                  @endforeach
                                                  @endif
                                                </tbody>
                                            </table>
                                          </div>
                                        </div>

                                        <div id="menu2" class="tab-pane fade">
                                            <div class="row pull-right" >
                                                <i class="fa fa-print" aria-hidden="true"></i> <u>Print report (PDF)</u>
                                            </div>

                                            <div>
                                              <table id="user_group_scores" class="table table-bordered table-striped text-center">
                                                  <thead>
                                                  <tr>

                                                      <th>Survey ID</th>
                                                      <th>Indicator ID</th>
                                                      <th>Indicator</th>
                                                      <th>Group_Average</th>
                                                  </tr>
                                                  </thead>
                                                  <tbody>
                                                    @if(count($surveyGroupAveragePerIndicatorAllUsers)==0)
                                                      You have no surveys results to display
                                                    @else
                                                    @foreach($surveyGroupAveragePerIndicatorAllUsers as $result)
                                                    <tr>

                                                    <td>{!! $result->Survey_ID !!}</td>
                                                    <td>{!! $result->Indicator_ID !!}</td>
                                                    <td>{!! $result->Indicator !!}</td>
                                                    <td>{!! $result->Group_Average !!}</td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                  </tbody>
                                              </table>
                                            </div>
                                        </div>

                                        <div id="menu3" class="tab-pane fade">
                                            <div class="row pull-right" >
                                                <i class="fa fa-print" aria-hidden="true"></i> <u>Print report (PDF)</u>
                                            </div>

                                            <div>
                                              <table id="indicator_group_scores" class="table table-bordered table-striped text-center">
                                                  <thead>
                                                  <tr>

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

                                                    <td>{!! $result->Survey_ID !!}</td>
                                                    <td>{!! $result->User_ID !!}</td>
                                                    <td>{!! $result->Indicator_Group !!}</td>
                                                    <td>{!! $result->Indicator_Group_Average !!}</td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                  </tbody>
                                              </table>
                                            </div>
                                        </div>

                                        <div id="menu4" class="tab-pane fade">
                                            <div class="row pull-right" >
                                                <i class="fa fa-print" aria-hidden="true"></i> <u>Print report (PDF)</u>
                                            </div>

                                            <div>
                                              <table id="indicator_group_average_scores" class="table table-bordered table-striped text-center">
                                                  <thead>
                                                  <tr>

                                                      <th>Survey ID</th>
                                                      <th>Indicator Group</th>
                                                      <th>Indicator Group Average</th>
                                                  </tr>
                                                  </thead>
                                                  <tbody>
                                                    @if(count($surveyScorePerIndicatorGroup)==0)
                                                      <div>You have no surveys results to Display</div>
                                                    @else
                                                    @foreach($surveyScorePerIndicatorGroup as $result)
                                                    <tr>

                                                    <td>{!! $result->Survey_ID !!}</td>
                                                    <td>{!! $result->Indicator_Group !!}</td>
                                                    <td>{!! $result->Indicator_Group_Average !!}</td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                  </tbody>
                                              </table>
                                            </div>
                                        </div>

                                        <div id="menu5" class="tab-pane fade">

                                          <div class="pull-left" >
                                            <h5 class="select-users"><label>Select User</label>
                                              <select id="participants">
                                                 @foreach($participants as $participant)
                                                  <option value="{!! \App\User::find($participant->user_id)->id !!}">{!! \App\User::find($participant->user_id)->email !!}</option>
                                                 @endforeach
                                              </select>
                                            </h5>
                                          </div>

                                          <script>
                                            $(document).ready(function(){
                                              $('#participants').change(function(){
                                                if($(this).val()==""){
                                                  return;
                                                }else{
                                                alert($(this).val());
                                                $ajaxSetup({
                                                  headers:{
                                                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                                                  }
                                                });
                                                $.ajax({
                                                  method: 'POST',
                                                  url: 'admin/survey/getParticipantDetails',
                                                  data: {'participantId':$(this).val()}
                                                });
                                                }
                                              });
                                            });
                                          </script>

                                         <div class="pull-right" >
                                            <i class="fa fa-print" aria-hidden="true"></i> <u>Print report (PDF)</u>
                                         </div>

                                         <div>
                                            <table id="Participants_scores" class="table table-bordered table-striped table-responsive text-center" >
                                                <thead>
                                                <tr>

                                                    <th>Survey ID</th>
                                                    <th>User ID</th>
                                                    <th>Indicator ID</th>
                                                    <th>Indicator </th>
                                                    <th>Answer</th>
                                                    <th>Group Average</th>
                                                    <th>Indicator Group</th>
                                                    <th>Indicator Group Average</th>
                                                    <th>Indicator Group</th>
                                                    <th>Survey Indicator Group Average</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                  @if(count($surveyScoreAllUsers)==0)
                                                    <div>You have no surveys results to display</div>
                                                  @else
                                                  @foreach($surveyScoreAllUsers as $results)
                                                    <tr>

                                                      <td>{!! $results->Survey_ID !!}</td>
                                                      <td>{!! $results->User_ID !!}</td>
                                                      <td>{!! $results->Indicator_ID !!}</td>
                                                      <td>{!! $results->Indicator !!}</td>
                                                      <td>{!! $results->Answer !!}</td>

                                                        <!--This is group average per indicator -->
                                                        @if(count($surveyGroupAveragePerIndicatorAllUsers)==0)
                                                          You have no surveys indicator averages to display
                                                        @else
                                                        @foreach($surveyGroupAveragePerIndicatorAllUsers as $resulti)
                                                          @if($results->Indicator_ID==$resulti->Indicator_ID)
                                                            <td>{!! $resulti->Group_Average !!}</td>
                                                            <?php break; ?>
                                                          @endif
                                                        @endforeach
                                                        @endif


                                                        <!--This is group average per indicator -->
                                                        <td>{!! $results->Indicator_Group !!}</td>
                                                        @if(count($surveyScoreGroupAvgPerIndicatorGroup)==0)
                                                          You have no surveys indicator group averages to display
                                                        @else
                                                        @foreach($surveyScoreGroupAvgPerIndicatorGroup as $result)
                                                          @if($results->Indicator_Group_ID==$result->Indicator_Group_ID)
                                                            <td>{!! $result->Indicator_Group_Average !!}</td>
                                                            <?php break; ?>
                                                          @endif
                                                        @endforeach
                                                        @endif


                                                        <td>{!! $results->Indicator_Group !!}</td>
                                                        @if(count($surveyScorePerIndicatorGroup)==0)
                                                          You have no surveys indicator group averages to display
                                                        @else
                                                        @foreach($surveyScorePerIndicatorGroup as $resulte)
                                                          @if($results->Indicator_Group_ID==$resulte->Indicator_Group_ID)
                                                            <td>{!! $resulte->Indicator_Group_Average !!}</td>
                                                            <?php break; ?>
                                                          @endif
                                                        @endforeach
                                                        @endif
                                                    </tr>

                                                  @endforeach
                                                  @endif
                                                </tbody>
                                            </table>
                                          </div>
                                        </div>
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
        </div>
@stop
