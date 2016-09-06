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
                                  <li class="active"><a data-toggle="tab" href="#myAnswer">My Answer</a></li>
                                  <li><a data-toggle="tab" href="#compared">Compared</a></li>
                                </ul>

                                <div class="tab-content">
                                  <div id="myAnswer" class="tab-pane fade in active">
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
<!--
                                    <canvas id="myAnswer" width="800" height="400"></canvas>
                                    <script src="{{URL::asset('js/displayChart.js')}}">
                                    </script>
                                    <script>
                                      createChart(
                                        document.getElementById("myAnswer"),
                                        ["Ind 1", "Ind 2", "Ind 3", "Ind 4", "Ind 5", "Ind 6", "Ind 7", "Ind 8", "Ind 9", "Ind 10", "Ind 11", "Ind 12",
                                                "Ind 13", "Ind 14", "Ind 15", "Ind 16", "Ind 17", "Ind 18", "Ind 19", "Ind 20", "Ind 21", "Ind 22", "Ind 23", "Ind 24",
                                                "Ind 25", "Ind 26", "Ind 27", "Ind 28", "Ind 29", "Ind 30", "Ind 31", "Ind 32", "Ind 33", "Ind 34"],
                                        'Your score of each indicator',
                                        [{!!$surveyScoreAllUsers[0]->Answer!!}, {!!$surveyScoreAllUsers[1]->Answer!!}, {!!$surveyScoreAllUsers[2]->Answer!!}, {!!$surveyScoreAllUsers[3]->Answer!!}, {!!$surveyScoreAllUsers[4]->Answer!!},
                                          {!!$surveyScoreAllUsers[5]->Answer!!}, {!!$surveyScoreAllUsers[6]->Answer!!}, {!!$surveyScoreAllUsers[7]->Answer!!}, {!!$surveyScoreAllUsers[8]->Answer!!}, {!!$surveyScoreAllUsers[9]->Answer!!},
                                           {!!$surveyScoreAllUsers[10]->Answer!!}, {!!$surveyScoreAllUsers[11]->Answer!!}, {!!$surveyScoreAllUsers[12]->Answer!!}, {!!$surveyScoreAllUsers[13]->Answer!!}, {!!$surveyScoreAllUsers[14]->Answer!!},
                                            {!!$surveyScoreAllUsers[15]->Answer!!}, {!!$surveyScoreAllUsers[16]->Answer!!}, {!!$surveyScoreAllUsers[17]->Answer!!}, {!!$surveyScoreAllUsers[18]->Answer!!}, {!!$surveyScoreAllUsers[19]->Answer!!},
                                              {!!$surveyScoreAllUsers[20]->Answer!!}, {!!$surveyScoreAllUsers[21]->Answer!!}, {!!$surveyScoreAllUsers[22]->Answer!!}, {!!$surveyScoreAllUsers[23]->Answer!!}, {!!$surveyScoreAllUsers[24]->Answer!!},
                                                {!!$surveyScoreAllUsers[25]->Answer!!}, {!!$surveyScoreAllUsers[26]->Answer!!}, {!!$surveyScoreAllUsers[27]->Answer!!}, {!!$surveyScoreAllUsers[28]->Answer!!}, {!!$surveyScoreAllUsers[29]->Answer!!},
                                                  {!!$surveyScoreAllUsers[30]->Answer!!}, {!!$surveyScoreAllUsers[31]->Answer!!}, {!!$surveyScoreAllUsers[32]->Answer!!}, {!!$surveyScoreAllUsers[33]->Answer!!}],
                                        'rgba(255,99,132,1)'
                                      );
                                    </script>
-->
                                    <div>
                                      <table class="table table-bordered table-striped text-center">
                                        <h4><b>Indicators Table</b></h4>
                                          <thead>
                                            <tr>
                                                <th>Indicator ID</th>
                                                <th>Indicator</th>
                                                <th>Your Score</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @if(count($surveyScoreAllUsers)==0)
                                              <div>You have no surveys results to display</div>
                                            @else
                                              @foreach($surveyScoreAllUsers as $result)
                                                <tr>
                                                  <td>{!! $result->Indicator_ID !!}</td>
                                                  <td>{!! $result->Indicator !!}</td>
                                                  <td>{!! $result->Answer !!}</td>
                                                </tr>
                                              @endforeach
                                            @endif
                                          </tbody>
                                      </table>
                                    </div>
<!--
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

                                    <div>
                                      @include ('survey.resultContent.surveyScorePerIndicatorGroup')
                                    </div>
                                  </div>

                                  <div id="compared" class="tab-pane fade">
-->
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @stop
