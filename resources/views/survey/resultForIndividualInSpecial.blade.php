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
                            <p>
                                <h2>Survey Results</h2><br>
                                <!-- <label id="surveyId">{!! $survey->title !!}</label> -->
                                <ul>
								  {{App::setLocale(Session::get('language'))}}
								  <li><h5><label>Title : </label> {!! $survey->title !!}</h5></li>
                                  <li><h5><label>Type : </label> {!! \App\Survey_Type::find($survey->type_id)->name !!}</h5></li>
                                  <li><h5><label>Start time : </label> {!! $survey->start_time !!}</h5></li>
                                  <li><h5><label>Deadline : </label> {!! $survey->end_time !!}</h5></li>
                                  <li><h5><label>Total Participants : </label> {!! count($participants)!!}</h5></li>
                                  <li><h5><label>Total answers : </label> {!! count($answers)!!}</h5></li>
                                </ul>

                                @role ('special')
                                <ul class="nav nav-tabs">
                                  <li><a data-toggle="tab" href="#overview">Overview</a></li>
                                  <li class="active"><a data-toggle="tab" href="#detailedview">Detailed View</a></li>
                                </ul>

                                <div class="tab-content">
                                  <div id="overview" class="tab-pane fade">
                                    <div class="row pull-right" >
                                       <i class="fa fa-print" aria-hidden="true"></i> <u><a href="{!! url('special/groupsurvey/downloadPdf/'.$survey->id) !!}">Print report (PDF)</a></u>
                                       &nbsp;
                                       <i class="fa fa-download" aria-hidden="true"></i> <u><a href="#">Download Excel</a></u>
                                    </div>
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

									@if(count($surveyScorePerIndicatorGroup)==5)
									<h3 style="text-align:center;"><b>Group average score per dimension</b></h3>
                                    <canvas id="indicatorGroupAverage" width="800" height="400"></canvas>
                                    <script src="{{URL::asset('js/displayChart.js')}}">
                                    </script>
                                    <script>
                                    var chartArea = document.getElementById('indicatorGroupAverage');
                                    var datasetMinCompany = {
                                      label: 'Minimum Group Average Each Dimension',
                                      data: [
                                              {!!number_format((float)$surveyScoreGroupAvgPerIndicatorGroupMinAndMax[0]->Minimum_User_Indicator_Group_Average,2,'.','')!!},
                                              {!!number_format((float)$surveyScoreGroupAvgPerIndicatorGroupMinAndMax[1]->Minimum_User_Indicator_Group_Average,2,'.','')!!},
                                              {!!number_format((float)$surveyScoreGroupAvgPerIndicatorGroupMinAndMax[2]->Minimum_User_Indicator_Group_Average,2,'.','')!!},
                                              {!!number_format((float)$surveyScoreGroupAvgPerIndicatorGroupMinAndMax[3]->Minimum_User_Indicator_Group_Average,2,'.','')!!},
                                              {!!number_format((float)$surveyScoreGroupAvgPerIndicatorGroupMinAndMax[4]->Minimum_User_Indicator_Group_Average,2,'.','')!!}
                                            ],
                                       backgroundColor: 'rgba(255,0,0,1)'
                                    };
                                    var datasetMaxCompany = {
                                      label: 'Maximum Group Average Each Dimension',
                                      data: [
                                        {!!number_format((float)$surveyScoreGroupAvgPerIndicatorGroupMinAndMax[0]->Maximum_User_Indicator_Group_Average,2,'.','')!!},
                                        {!!number_format((float)$surveyScoreGroupAvgPerIndicatorGroupMinAndMax[1]->Maximum_User_Indicator_Group_Average,2,'.','')!!},
                                        {!!number_format((float)$surveyScoreGroupAvgPerIndicatorGroupMinAndMax[2]->Maximum_User_Indicator_Group_Average,2,'.','')!!},
                                        {!!number_format((float)$surveyScoreGroupAvgPerIndicatorGroupMinAndMax[3]->Maximum_User_Indicator_Group_Average,2,'.','')!!},
                                        {!!number_format((float)$surveyScoreGroupAvgPerIndicatorGroupMinAndMax[4]->Maximum_User_Indicator_Group_Average,2,'.','')!!}
                                      ],
                                      backgroundColor: 'rgba(255,255,0,1)'
                                    };
                                    var datasetAvgCompany = {
                                      label: 'Group Average Each Dimension',
                                      data: [
                                        {!!number_format((float)$surveyScorePerIndicatorGroup[0]->Indicator_Group_Average,2,'.','')!!},
                                        {!!number_format((float)$surveyScorePerIndicatorGroup[1]->Indicator_Group_Average,2,'.','')!!},
                                        {!!number_format((float)$surveyScorePerIndicatorGroup[2]->Indicator_Group_Average,2,'.','')!!},
                                        {!!number_format((float)$surveyScorePerIndicatorGroup[3]->Indicator_Group_Average,2,'.','')!!},
                                        {!!number_format((float)$surveyScorePerIndicatorGroup[4]->Indicator_Group_Average,2,'.','')!!}
                                      ],
                                      backgroundColor: 'rgba(0,0,255,1)'
                                    };
                                    var labelArr = ["CREATIVITY", "CRITICAL THINKING", "INITIATIVE", "TEAMWORK", "NETWORKING"];
                                    createMaxMinChart(chartArea, labelArr, datasetMinCompany, datasetAvgCompany, datasetMaxCompany);
                                    </script>
									@else
										<h3><b>You have no surveys results to display or your indicators group count is not equal 5</b></h3>
									@endif

                                    <div>
                                      @include ('survey.resultContent.surveyScorePerIndicatorGroup')
                                    </div>
                                  </div>

                                  <div id="detailedview" class="tab-pane fade in active">

                                    <div class="tab-content">
                                        <div id="participants" class="tab-pane fade in active">

                                             <div class="pull-left" >
   										  <label id="surveyId" hidden>{!! $survey->id !!}</label>
                                               <h5 class="select-users"><label>Select User</label>
                                                 <select id="participantsIds">
                                                   <option>Select a user</option>
   													  @foreach($answers as $participant)
   														<option value="{!!$participant->id !!}">{!! $participant->email !!}</option>
   													  @endforeach
   											  </select>
                                               </h5>
                                             <script>
   											$(document).ready(function(){
   											  $('#participantsIds').change(function(){
   												  if($(this).val()==""){
   												  return;
                                                   }else{
                                                     var participant = $(this).val();
                                                     var url = window.location.pathname;
                                                     var value = url.substring(0,url.lastIndexOf('/')+1);
													 window.location.replace(value+participant);
                                                   }
                                                 });
                                               });
                                             </script>
   										</div>
                       <div class="row pull-right">
                          <i class="fa fa-print" aria-hidden="true"></i> <u><a href="#">Print report (PDF)</a></u>
                          &nbsp;
                          <i class="fa fa-print" aria-hidden="true"></i> <u><a href="{{route('downloadExcelSpecial',$survey->id)}}">Download Excel</a></u>
                       </div>

                                             <div>
                                               <br><br>
                                               <h5>User name: <label>{!! \App\User::find($user)->name !!}</label></h5>
                                               <h5>Email: <label>{!! \App\User::find($user)->email !!}</label><h5>
                                               <br>
                                             </div>

                                             <div>
											 @if(count($surveyScorePerIndicatorGroup)==0)
                                                     <h3><b>You have no surveys results to display</b></h3>
                                             @else
                                               <br>
                                               <h3 style="text-align: center"><b>User average per dimension VS Group average per dimension</b></h3>
                                               <canvas id="comparedGraphCategory" width="800" height="400"></canvas>
                                               <script src="{{URL::asset('js/displayChart.js')}}"></script>
                                               <script>
                                                 var chartArea = document.getElementById('comparedGraphCategory');
                                                 var datasetOwnScore = {
                                                   label: 'User average score per dimension',
                                                   data: [
                                                     {!! number_format((float)$surveyScoreGroupAvgPerIndicatorGroup[0]->Indicator_Group_Average,2,'.','') !!},
                                                     {!! number_format((float)$surveyScoreGroupAvgPerIndicatorGroup[1]->Indicator_Group_Average,2,'.','') !!},
                                                     {!! number_format((float)$surveyScoreGroupAvgPerIndicatorGroup[2]->Indicator_Group_Average,2,'.','') !!},
                                                     {!! number_format((float)$surveyScoreGroupAvgPerIndicatorGroup[3]->Indicator_Group_Average,2,'.','') !!},
                                                     {!! number_format((float)$surveyScoreGroupAvgPerIndicatorGroup[4]->Indicator_Group_Average,2,'.','') !!}],
                                                    backgroundColor: 'rgba(255,0,0,1)'
                                                 };
                                                 var datasetGroupAvg = {
                                                   label: 'Group average per dimension',
                                                   data: [
                                                     {!!number_format((float)$surveyScorePerIndicatorGroup[0]->Indicator_Group_Average,2,'.','')!!},
                                                     {!!number_format((float)$surveyScorePerIndicatorGroup[1]->Indicator_Group_Average,2,'.','')!!},
                                                     {!!number_format((float)$surveyScorePerIndicatorGroup[2]->Indicator_Group_Average,2,'.','')!!},
                                                     {!!number_format((float)$surveyScorePerIndicatorGroup[3]->Indicator_Group_Average,2,'.','')!!},
                                                     {!!number_format((float)$surveyScorePerIndicatorGroup[4]->Indicator_Group_Average,2,'.','')!!}],
                                                   backgroundColor: 'rgba(0,0,255,1)'
                                                 };
                                                 var labelArr = ["CREATIVITY", "CRITICAL THINKING", "INITIATIVE", "TEAMWORK", "NETWORKING"];
                                                 createComparedChart(chartArea, labelArr, datasetOwnScore, datasetGroupAvg);

                                               </script>
											    @endif
                                             </div>

                                             <div>
                                               <table id="indicator_group_average_scores" class="table table-bordered table-striped text-center">
                                                 <h3 style="text-align: center;"><b>User average per dimension VS Group average per dimension</h3>
                                                <thead>
                                                   <tr>
                                                     <th>Dimension</th>
                                                     <th>User Dimension Average</th>
                                                     <th>Group Dimension Average</th>
                                                   </tr>
                                                 </thead>
                                                 <tbody>
                                                   @if(count($surveyScorePerIndicatorGroup)==0)
                                                     <h3><b>You have no surveys results to display</b></h3>
                                                   @else
                                                     @foreach($surveyScorePerIndicatorGroup as $results)
                                                       <tr>
                                                         <td>{!! $results->Indicator_Group !!}</td>

                                                         @foreach($surveyScoreGroupAvgPerIndicatorGroup as $result)
                                                           @if($results->Indicator_Group_ID==$result->Indicator_Group_ID)
                                                             <td>{!! number_format((float)$result->Indicator_Group_Average,2,'.','') !!}</td>
                                                             <?php break; ?>
                                                           @endif
                                                         @endforeach

                                                         <td>{!! number_format((float)$results->Indicator_Group_Average,2,'.','') !!}</td>
                                                       </tr>
                                                     @endforeach
                                                   @endif
                                                 </tbody>
                                               </table>

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
