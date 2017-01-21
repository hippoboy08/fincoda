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
								  <li><h5 class="text-capitalize"><label>Title : </label> {!! $survey->title !!}</h5></li>
                                  <li><h5 class="text-capitalize"><label>Type : </label> {!! \App\Survey_Type::find($survey->type_id)->name !!}</h5></li>
                                  <li><h5><label>Start time : </label> {!! $survey->start_time !!}</h5></li>
                                  <li><h5><label>Deadline : </label> {!! $survey->end_time !!}</h5></li>
                                  <li><h5><label>Total Participants : </label> {!! count($participants)!!}</h5></li>
                                  <li><h5><label>Total answers : </label> {!! count($answers)!!}</h5></li>
                                </ul>

                                @role ('admin')
                                <ul class="nav nav-tabs">
                                  <li class="active"><a data-toggle="tab" href="#overview">Overview</a></li>
                                  <li><a data-toggle="tab" href="#detailedview">Detailed View</a></li>
                                </ul>

                                <div class="tab-content">
                                  <div id="overview" class="tab-pane fade in active">
                                    <div class="row pull-right" >
                                       <i class="fa fa-print" aria-hidden="true"></i> <u><a href="{!! url('admin/survey/downloadPdf/'.$survey->id) !!}">Print report (PDF)</a></u>
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

                                    @role ('admin')
                                    <!-- Company average graph -->
									@if(count($surveyGroupAveragePerIndicatorAllUsers)==34)
									<h3 style="text-align:center;"><b>Company average score per indicator</b></h3>
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
									                      [{!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[0]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[1]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[2]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[3]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[4]->Group_Average,2,'.','')!!},
                                          {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[5]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[6]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[7]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[8]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[9]->Group_Average,2,'.','')!!},
                                           {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[10]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[11]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[12]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[13]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[14]->Group_Average,2,'.','')!!},
                                            {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[15]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[16]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[17]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[18]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[19]->Group_Average,2,'.','')!!},
                                              {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[20]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[21]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[22]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[23]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[24]->Group_Average,2,'.','')!!},
                                                {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[25]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[26]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[27]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[28]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[29]->Group_Average,2,'.','')!!},
                                                  {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[30]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[31]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[32]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[33]->Group_Average,2,'.','')!!}],
                                    	'rgba(0,0,255,1)'
                                      );
                                    </script>
									@else
										<h3><b>You have no surveys results to display or your indicators count is not equal 34</b></h3>
									@endif

                                    <div>
                                      <table class="table table-bordered table-striped text-center">
                                        <h3 style="text-align: center;"><b>Indicators Table</b></h3>
                                          <thead>
                                            <tr>
                                                <th>Indicator ID</th>
                                                <th>Indicator</th>
                                                <th>Company Average</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @if(count($surveyScoreAllUsers)==0)
                                              <h3><b>You have no surveys results to display</b></h3>
                                            @else
                                              @foreach($surveyGroupAveragePerIndicatorAllUsers as $result)
                                                <tr>
                                                  <td>{!! $result->Indicator_ID !!}</td>
                                                  <td>{{Lang::get('indicators.'.$result->Indicator_ID,array(),App::getLocale())}}</td>
                                                  <td>{!! number_format((float)$result->Group_Average,2,'.','') !!}</td>
                                                </tr>
                                              @endforeach
                                            @endif
                                          </tbody>
                                      </table>
                                    </div>

                  <h3 style="text-align:center;"><b>Company average score per dimension</b></h3>
									@if(count($surveyScorePerIndicatorGroup)==5)
                                    <canvas id="indicatorGroupAverage" width="800" height="400"></canvas>
                                    <script src="{{URL::asset('js/displayChart.js')}}">
                                    </script>
                                    <script>
                                    var chartArea = document.getElementById('indicatorGroupAverage');
                                    var datasetMinCompany = {
                                      label: 'Minimum Average Score Each Dimension',
                                      data: [
                                              {!! number_format($surveyScoreGroupAvgPerIndicatorGroupMinAndMax[0]->Minimum_User_Indicator_Group_Average, 2, '.','') !!},
                                              {!!number_format((float)$surveyScoreGroupAvgPerIndicatorGroupMinAndMax[1]->Minimum_User_Indicator_Group_Average,2,'.','')!!},
                                              {!!number_format((float)$surveyScoreGroupAvgPerIndicatorGroupMinAndMax[2]->Minimum_User_Indicator_Group_Average,2,'.','')!!},
                                              {!!number_format((float)$surveyScoreGroupAvgPerIndicatorGroupMinAndMax[3]->Minimum_User_Indicator_Group_Average,2,'.','')!!},
                                              {!!number_format((float)$surveyScoreGroupAvgPerIndicatorGroupMinAndMax[4]->Minimum_User_Indicator_Group_Average,2,'.','')!!}
                                            ],
                                       backgroundColor: 'rgba(255,0,0,1)'
                                    };
                                    var datasetMaxCompany = {
                                      label: 'Maximum Average Score Each Dimension',
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
                                      label: 'Company Average Score Each Dimension',
                                      data: [
                                        {!!number_format((float)$surveyScorePerIndicatorGroup[0]->Indicator_Group_Average,2,'.','')!!}, {!!number_format((float)$surveyScorePerIndicatorGroup[1]->Indicator_Group_Average,2,'.','')!!}, {!!number_format((float)$surveyScorePerIndicatorGroup[2]->Indicator_Group_Average,2,'.','')!!},
                                          {!!number_format((float)$surveyScorePerIndicatorGroup[3]->Indicator_Group_Average,2,'.','')!!}, {!!number_format((float)$surveyScorePerIndicatorGroup[4]->Indicator_Group_Average,2,'.','')!!}
                                      ],
                                      backgroundColor: 'rgba(0,0,255,1)'
                                    };
                                    var labelArr = ["CREATIVITY", "CRITICAL THINKING", "INITIATIVE", "TEAMWORK", "NETWORKING"];
                                    createMaxMinChart(chartArea, labelArr, datasetMinCompany, datasetAvgCompany, datasetMaxCompany);
                                    </script>
									@else
										<h3><b>You have no surveys results to display or your indicators group count is not equal 5<b></h3>
									@endif


                                    <div>

                                      @include ('survey.resultContent.surveyScorePerIndicatorGroup')
                                    </div>
                                  </div>

                                  <div id="detailedview" class="tab-pane fade">

                                    <div class="tab-content">
                                        <div id="participants" class="tab-pane fade in active">

                                           <div class="pull-left" >
 										  <span style="visibility: hidden;"><label id="surveyId">{!! $survey->id !!}</label></span>
                                             <h5 class="select-users"><label>Select User</label>
                                               <select id="participantsIds">
                                                 <option>Select a user</option>
 													  @foreach($answers as $participant)
														<option value="{!! $participant->id !!}">{!! $participant->email !!}</option>
 													  @endforeach
 											  </select>
                                             </h5>
										<script>
 											$(document).ready(function(){
 											  $('#participantsIds').change(function(){
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
													 url: 'lookForParticipant',
																		  dataType: 'json',
													 data: {'participantId':$(this).val(),'surveyId':$('#surveyId').text()},
   												  success: function(data){
   												  window.location.replace(data.stri);
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
