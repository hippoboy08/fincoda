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
								  <li><h5><label>Id : </label> {!! $survey->id !!}</h5></li>
                                  <li><h5><label>Title : </label> {!! $survey->title !!}</h5></li>
                                  <li><h5><label>Type : </label> {!! \App\Survey_Type::find($survey->type_id)->name !!}</h5></li>
                                  <li><h5><label>Start time : </label> {!! $survey->start_time !!}</h5></li>
                                  <li><h5><label>Deadline : </label> {!! $survey->end_time !!}</h5></li>
                                  <li><h5><label>Total Participants : </label> {!! count($participants)!!}</h5></li>
                                  <li><h5><label>Total answers : </label> {!! count($answers)!!}</h5></li>
                                </ul>

                                @role ('special')
                                <ul class="nav nav-tabs">
                                  <li class="active"><a data-toggle="tab" href="#overview">Overview</a></li>
                                </ul>

                                <div class="tab-content">
                                  <div class="tab-pane fade in active">
								  
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
                                        'rgba(0,0,255,1)'
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
                                                  <td>{{Lang::get('indicators.'.$result->Indicator_ID,array(),App::getLocale())}}</td>
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
                                        'rgba(0,0,255,1)'
                                      );
                                    </script>
									@else
										<div>You have no surveys results to display or your indicators group count is not equal 5</div>
									@endif

                                    <div>
                                      @include ('survey.resultContent.surveyScorePerIndicatorGroup')
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
