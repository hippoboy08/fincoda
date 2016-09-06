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

                                @role('basic')
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home">Participants</a></li>
                                    <li><a data-toggle="tab" href="#menu1">Participants Scores</a></li>
                                    <li><a data-toggle="tab" href="#menu2">User Groups Indicator Averages</a></li>
                                    <li><a data-toggle="tab" href="#menu3">Participants Scores On Indicator Groups</a></li>
                                    <li><a data-toggle="tab" href="#menu4">User Groups And Indicator Group Averages</a></li>
                                    <li><a data-toggle="tab" href="#menu5">Admin View</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">
                                       <div class="row pull-right" >
                                          <i class="fa fa-print" aria-hidden="true"></i> <u>Print report (PDF)</u>
                                       </div>
                                       <table id="Participants" class="table table-bordered table-striped">
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
                                        <table id="Participants_scores" class="table table-bordered table-striped">
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
                                                You have no surveys results to Display
                                              @else
                                              @foreach($surveyScoreAllUsers as $result)
                                              <tr>
                                              <td><b>{!! $result->Survey_ID !!}</b></td>
                                              <td><b>{!! $result->User_ID !!}</b></td>
                                              <td><b>{!! $result->Indicator_ID !!}</b></td>
                                              <td><b>{!! $result->Indicator !!}</b></td>
                                              <td><b>{!! $result->Answer !!}</b></td>
                                              </tr>
                                              @endforeach
                                              @endif
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                              <th>Survey ID</th>
                                              <th>User ID</th>
                                              <th>Indicator ID</th>
                                              <th>Indicator </th>
                                              <th>Answer</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div id="menu2" class="tab-pane fade">
                                        <div class="row pull-right" >
                                            <i class="fa fa-print" aria-hidden="true"></i> <u>Print report (PDF)</u>
                                        </div>
                                        <table id="user_group_scores" class="table table-bordered table-striped">
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
                                                You have no surveys results to Display
                                              @else
                                              @foreach($surveyGroupAveragePerIndicatorAllUsers as $result)
                                              <tr>
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
                                        <table id="indicator_group_scores" class="table table-bordered table-striped">
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
                                        <table id="indicator_group_average_scores" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
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
                                              <td><b>{!! $result->Survey_ID !!}</b></td>
                                              <td><b>{!! $result->Indicator_Group !!}</b></td>
                                              <td><b>{!! $result->Indicator_Group_Average !!}</b></td>
                                              </tr>
                                              @endforeach
                                              @endif
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                              <th>Survey ID</th>
                                              <th>Indicator Group</th>
                                              <th>Indicator Group Average</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div id="menu5" class="tab-pane fade in active">
                                      <div class="row pull-left" >
                                        <label id="surveyId">{!! $survey->id !!}</label>
                                        <b>Select User</b>
                                        <select id="participants1">
                                           @foreach($participants as $participant)
                                            <option value="{!! \App\User::find($participant->user_id)->id !!}">{!! \App\User::find($participant->user_id)->email !!}</option>
                                           @endforeach
                                        </select>
                                      </div>

                                      <script>
                                        $(document).ready(function(){
                                          $('#participants1').change(function(){
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
                                              url: '{id}/getParticipantDetails',
                                              
                                              data: {'surveyId':$('#surveyId').text(),'participantId':$(this).val() },
                                              success: function(data){
                                                window.location.replace('{id}/getParticipantDetails');
                                                //location.reload();
                                                alert(data.survey);
                                              },
                                              error: function(result){
                                                //window.location.replace('13');
                                                var errors = result.responseJSON;
                                                //window.location.replace('survey');
                                                console.log(result);
                                                console.log(errors);
                                              }
                                              });

                                            }
                                          });
                                        });
                                      </script>


                                     <div class="row pull-right" >
                                          <i class="fa fa-print" aria-hidden="true"></i> <u>Print report (PDF)</u>
                                       </div>
                                        <table id="Participants_scores" class="table table-bordered table-striped">
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
                                                You have no surveys results to Display
                                              @else
                                              @foreach($surveyScoreAllUsers as $results)
                                                <tr>
                                                  <td><b>{!! $results->Survey_ID !!}</b></td>
                                                  <td><b>{!! $results->User_ID !!}</b></td>
                                                  <td><b>{!! $results->Indicator_ID !!}</b></td>
                                                  <td><b>{!! $results->Indicator !!}</b></td>
                                                  <td><b>{!! $results->Answer !!}</b></td>

                                                    <!--This is group average per indicator -->
                                                    @if(count($surveyGroupAveragePerIndicatorAllUsers)==0)
                                                      You have no surveys indicator averages to Display
                                                    @else
                                                    @foreach($surveyGroupAveragePerIndicatorAllUsers as $resulti)
                                                      @if($results->Indicator_ID==$resulti->Indicator_ID)
                                                        <td><b>{!! $resulti->Group_Average !!}</b></td>
                                                        <?php break; ?>
                                                      @endif
                                                    @endforeach
                                                    @endif


                                                    <!--This is group average per indicator -->
                                                    <td><b>{!! $results->Indicator_Group !!}</b></td>
                                                    @if(count($surveyScoreGroupAvgPerIndicatorGroup)==0)
                                                      You have no surveys indicator group averages to Display
                                                    @else
                                                    @foreach($surveyScoreGroupAvgPerIndicatorGroup as $result)
                                                      @if($results->Indicator_Group_ID==$result->Indicator_Group_ID)
                                                        <td><b>{!! $result->Indicator_Group_Average !!}</b></td>
                                                        <?php break; ?>
                                                      @endif
                                                    @endforeach
                                                    @endif


                                                    <td><b>{!! $results->Indicator_Group !!}</b></td>
                                                    @if(count($surveyScorePerIndicatorGroup)==0)
                                                      You have no surveys indicator group averages to Display
                                                    @else
                                                    @foreach($surveyScorePerIndicatorGroup as $resulte)
                                                      @if($results->Indicator_Group_ID==$resulte->Indicator_Group_ID)
                                                        <td><b>{!! $resulte->Indicator_Group_Average !!}</b></td>
                                                        <?php break; ?>
                                                      @endif
                                                    @endforeach
                                                    @endif
                                                </tr>

                                              @endforeach
                                              @endif
                                            </tbody>
                                            <tfoot>
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
