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
                        <p>
                          <?php echo 123; ?>
                        </p>
            </div>

            @include('message.fail')
            @include('message.errors_head')


            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <p>
                                <h2>Survey Results</h2><br>
                                <!-- <label id="surveyId">{!! $survey->title !!}</label> -->
                                <ul>
								  <li><h5><label>Id : </label> {!! $survey->id !!}</h5></li>
                                  <li><h5><label>Title : </label> {!! $survey->title !!}</h5></li>
                                  <li><h5><label>Type : </label> {!! \App\Survey_Type::find($survey->type_id)->name !!}</h5></li>
                                  <li><h5><label>Start time : </label> {!! $survey->start_time !!}</h5></li>
                                  <li><h5><label>Deadline : </label> {!! $survey->end_time !!}</h5></li>
                                  <li><h5><label>Total Participants : </label> {!! count($participants)!!}</h5></li>
                                  <li><h5><label>Total answers : </label> {!! $answers!!}</h5></li>
                                </ul>

                                @role ('special')
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
                                      @include ('survey.resultContent.scoreTable')
                                    </div>

                                    @role ('special')
									@if(count($surveyGroupAveragePerIndicatorAllUsers)==34)
                                    <!-- Company average graph -->
                                    <canvas id="companyAverage" width="800" height="400"></canvas>
                                    <script src="{{URL::asset('js/displayChart.js')}}">
                                    </script>
                                    <script>
                                      createChart(
                                        document.getElementById("companyAverage"),
                                        ["Ind 1", "Ind 2", "Ind 3", "Ind 4", "Ind 5", "Ind 6", "Ind 7", "Ind 8", "Ind 9", "Ind 10", "Ind 11", "Ind 12",
                                                "Ind 13", "Ind 14", "Ind 15", "Ind 16", "Ind 17", "Ind 18", "Ind 19", "Ind 20", "Ind 21", "Ind 22", "Ind 23", "Ind 24",
                                                "Ind 25", "Ind 26", "Ind 27", "Ind 28", "Ind 29", "Ind 30", "Ind 31", "Ind 32", "Ind 33", "Ind 34"],
                                        'Company average score of each indicator',
                                        [{!!$surveyGroupAveragePerIndicatorAllUsers[0]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[1]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[2]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[3]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[4]->Group_Average!!},
                                          {!!$surveyGroupAveragePerIndicatorAllUsers[5]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[6]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[7]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[8]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[9]->Group_Average!!},
                                           {!!$surveyGroupAveragePerIndicatorAllUsers[10]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[11]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[12]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[13]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[14]->Group_Average!!},
                                            {!!$surveyGroupAveragePerIndicatorAllUsers[15]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[16]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[17]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[18]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[19]->Group_Average!!},
                                              {!!$surveyGroupAveragePerIndicatorAllUsers[20]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[21]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[22]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[23]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[24]->Group_Average!!},
                                                {!!$surveyGroupAveragePerIndicatorAllUsers[25]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[26]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[27]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[28]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[29]->Group_Average!!},
                                                  {!!$surveyGroupAveragePerIndicatorAllUsers[30]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[31]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[32]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[33]->Group_Average!!}],
                                        'rgba(255,99,132,1)'
                                      );
                                    </script>
									@else
										<div>You have no surveys results to display or your indicators count is not equal 34</div>
									@endif

                                    <div>
                                      <table class="table table-bordered table-striped text-center">
                                        <h4><b>Indicators Table</b></h4>
                                          <thead>
                                            <tr>
                                                <th>Indicator ID</th>
                                                <th>Indicator</th>
                                                <th>Company Average</th>
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

									@if(count($surveyScorePerIndicatorGroup)==5)
                                    <canvas id="indicatorGroupAverage" width="800" height="400"></canvas>
                                    <script src="{{URL::asset('js/displayChart.js')}}">
                                    </script>
                                    <script>
                                      createChart(
                                        document.getElementById("indicatorGroupAverage"),
                                        ["CREATIVITY", "CRITICAL THINKING", "INITIATIVE", "TEAMWORK", "NETWORKING",],
                                        'Company average score of each indicator group',
                                        [{!!$surveyScorePerIndicatorGroup[0]->Indicator_Group_Average!!}, {!!$surveyScorePerIndicatorGroup[1]->Indicator_Group_Average!!}, {!!$surveyScorePerIndicatorGroup[2]->Indicator_Group_Average!!},
                                          {!!$surveyScorePerIndicatorGroup[3]->Indicator_Group_Average!!}, {!!$surveyScorePerIndicatorGroup[4]->Indicator_Group_Average!!}],
                                        'rgba(255,99,132,1)'
                                      );
                                    </script>
									@else
										<div>You have no surveys results to display or your indicators group count is not equal 5</div>
									@endif

                                    <div>
                                      @include ('survey.resultContent.surveyScorePerIndicatorGroup')
                                    </div>
                                  </div>

                                  <div id="detailedview" class="tab-pane fade">
                                      <ul class="nav nav-tabs">
                                          <li class="active"><a data-toggle="tab" href="#participants">Participants</a></li>
                                          <li><a data-toggle="tab" href="#menu1">Participants Scores</a></li>
                                          <li><a data-toggle="tab" href="#menu2">User Groups Indicator Averages</a></li>
                                          <li><a data-toggle="tab" href="#menu3">Participants Scores On Indicator Groups</a></li>
                                          <li><a data-toggle="tab" href="#menu4">User Groups And Indicator Group Averages</a></li>
                                          <li><a data-toggle="tab" href="#menu5">Admin View</a></li>
										  <li><a data-toggle="tab" href="#menu6">Minimum And Maximum User Indicator Group Average</a></li>
										  <li><a data-toggle="tab" href="#menu7">Downloads</a></li>
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
										                                  <label id="surveyId">{!! $survey->id !!}</label>
                                            <h5 class="select-users"><label>Select User</label>
                                              <select id="participantsIds">
                                                <option value="default">Select a user</option>
													  @foreach($participants as $participant)
														<option value="{!! \App\User::find($participant->user_id)->id !!}">{!! \App\User::find($participant->user_id)->email !!}</option>
													  @endforeach
											  </select>
                                            </h5>
                                          <script>
											$(document).ready(function(){
											  $('#participantsIds').change(function(){
												  if($(this).val()==""){
												  return;
                                                }else{
                                                $.ajaxSetup({
                                                  headers:{
                                                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                                                  }
                                                });
                                                $.ajax({
												  method: 'POST',
                                                  url: 'lookForParticipant',
												  dataType: 'json',
                                                  data: {'participantId':$(this).val(),'surveyId':$('#surveyId').text()},
												  success: function(data){
													window.location.replace(data.stri);
													//alert(data.stri);
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



										<div id="menu6" class="tab-pane fade">
                                            <div class="row pull-right" >
                                                <i class="fa fa-print" aria-hidden="true"></i> <u>Print report (PDF)</u>
                                            </div>

                                            <div>
                                              <table id="user_group_scores" class="table table-bordered table-striped text-center">
                                                  <thead>
                                                  <tr>

                                                      <th>Survey ID</th>
													  <th>Indicator Group ID</th>
                                                      <th>Indicator Group</th>
                                                      <th>Minimum User Indicator_Group Average</th>
													  <th>Maximum User Indicator_Group Average</th>
                                                  </tr>
                                                  </thead>
                                                  <tbody>
                                                    @if(count($surveyScoreGroupAvgPerIndicatorGroupMinAndMax)==0)
                                                      You have no surveys results to display
                                                    @else
                                                    @foreach($surveyScoreGroupAvgPerIndicatorGroupMinAndMax as $result)
                                                    <tr>

                                                    <td>{!! $result->Survey_ID !!}</td>
													<td>{!! $result->Indicator_Group_ID !!}</td>
                                                    <td>{!! $result->Indicator_Group !!}</td>
													<td>{!! $result->Minimum_User_Indicator_Group_Average !!}</td>
                                                    <td>{!! $result->Maximum_User_Indicator_Group_Average !!}</td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                  </tbody>
                                              </table>
                                            </div>
                                        </div>

										<div id="menu7" class="tab-pane fade">
                                            <div class="row pull-right" >
                                                <i class="fa fa-print" aria-hidden="true"></i> <u><a href="{{route('downloadExcelSpecial',$survey->id)}}">Download Excel</a></u>
                                            </div>
                                        </div>

                                    </div>
                                  </div>
                                  @endrole
                                </div>
                                    @else
                                    <ul>
                                        <li class="list-group-item list-group-item-danger"> <p style="font-size: 20px;">No any response has been received for this survey.</p></li>
                                    </ul>

                                    @endif
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
@stop
