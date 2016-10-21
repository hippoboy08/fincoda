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
                                  <li><h5 class="text-capitalize"><label>Title : </label> {!! $survey->title !!}</h5></li>
                                  <li><h5 class="text-capitalize"><label>Type : </label> {!! \App\Survey_Type::find($survey->type_id)->name !!}</h5></li>
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
                          							Alternate between the two buttons to view your scores only or in comparison with the company average score.
                          							Only your score are shown by default.</p>
                                    </div>

                                    <div>
                                      @include ('survey.resultContent.scoreTable')
                                    </div>

									@if(count($surveyGroupAveragePerIndicatorAllUsers)==34)
                                    <canvas id="myAnswerGraph" width="800" height="400"></canvas>
                                    <script src="{{URL::asset('js/displayChart.js')}}">
                                    </script>
                                    <script>
                                      createChart(
                                        document.getElementById("myAnswerGraph"),
                                        [{!!$surveyScoreAllUsers[0]->Indicator_ID!!}, {!!$surveyScoreAllUsers[1]->Indicator_ID!!}, {!!$surveyScoreAllUsers[2]->Indicator_ID!!}, {!!$surveyScoreAllUsers[3]->Indicator_ID!!}, {!!$surveyScoreAllUsers[4]->Indicator_ID!!},
                                          {!!$surveyScoreAllUsers[5]->Indicator_ID!!}, {!!$surveyScoreAllUsers[6]->Indicator_ID!!}, {!!$surveyScoreAllUsers[7]->Indicator_ID!!}, {!!$surveyScoreAllUsers[8]->Indicator_ID!!}, {!!$surveyScoreAllUsers[9]->Indicator_ID!!},
                                           {!!$surveyScoreAllUsers[10]->Indicator_ID!!}, {!!$surveyScoreAllUsers[11]->Indicator_ID!!}, {!!$surveyScoreAllUsers[12]->Indicator_ID!!}, {!!$surveyScoreAllUsers[13]->Indicator_ID!!}, {!!$surveyScoreAllUsers[14]->Indicator_ID!!},
                                            {!!$surveyScoreAllUsers[15]->Indicator_ID!!}, {!!$surveyScoreAllUsers[16]->Indicator_ID!!}, {!!$surveyScoreAllUsers[17]->Indicator_ID!!}, {!!$surveyScoreAllUsers[18]->Indicator_ID!!}, {!!$surveyScoreAllUsers[19]->Indicator_ID!!},
                                              {!!$surveyScoreAllUsers[20]->Indicator_ID!!}, {!!$surveyScoreAllUsers[21]->Indicator_ID!!}, {!!$surveyScoreAllUsers[22]->Indicator_ID!!}, {!!$surveyScoreAllUsers[23]->Indicator_ID!!}, {!!$surveyScoreAllUsers[24]->Indicator_ID!!},
                                                {!!$surveyScoreAllUsers[25]->Indicator_ID!!}, {!!$surveyScoreAllUsers[26]->Indicator_ID!!}, {!!$surveyScoreAllUsers[27]->Indicator_ID!!}, {!!$surveyScoreAllUsers[28]->Indicator_ID!!}, {!!$surveyScoreAllUsers[29]->Indicator_ID!!},
                                                  {!!$surveyScoreAllUsers[30]->Indicator_ID!!}, {!!$surveyScoreAllUsers[31]->Indicator_ID!!}, {!!$surveyScoreAllUsers[32]->Indicator_ID!!}, {!!$surveyScoreAllUsers[33]->Indicator_ID!!}],
                                        'Your score for each indicator',
                                        [{!!$surveyScoreAllUsers[0]->Answer!!}, {!!$surveyScoreAllUsers[1]->Answer!!}, {!!$surveyScoreAllUsers[2]->Answer!!}, {!!$surveyScoreAllUsers[3]->Answer!!}, {!!$surveyScoreAllUsers[4]->Answer!!},
                                          {!!$surveyScoreAllUsers[5]->Answer!!}, {!!$surveyScoreAllUsers[6]->Answer!!}, {!!$surveyScoreAllUsers[7]->Answer!!}, {!!$surveyScoreAllUsers[8]->Answer!!}, {!!$surveyScoreAllUsers[9]->Answer!!},
                                           {!!$surveyScoreAllUsers[10]->Answer!!}, {!!$surveyScoreAllUsers[11]->Answer!!}, {!!$surveyScoreAllUsers[12]->Answer!!}, {!!$surveyScoreAllUsers[13]->Answer!!}, {!!$surveyScoreAllUsers[14]->Answer!!},
                                            {!!$surveyScoreAllUsers[15]->Answer!!}, {!!$surveyScoreAllUsers[16]->Answer!!}, {!!$surveyScoreAllUsers[17]->Answer!!}, {!!$surveyScoreAllUsers[18]->Answer!!}, {!!$surveyScoreAllUsers[19]->Answer!!},
                                              {!!$surveyScoreAllUsers[20]->Answer!!}, {!!$surveyScoreAllUsers[21]->Answer!!}, {!!$surveyScoreAllUsers[22]->Answer!!}, {!!$surveyScoreAllUsers[23]->Answer!!}, {!!$surveyScoreAllUsers[24]->Answer!!},
                                                {!!$surveyScoreAllUsers[25]->Answer!!}, {!!$surveyScoreAllUsers[26]->Answer!!}, {!!$surveyScoreAllUsers[27]->Answer!!}, {!!$surveyScoreAllUsers[28]->Answer!!}, {!!$surveyScoreAllUsers[29]->Answer!!},
                                                  {!!$surveyScoreAllUsers[30]->Answer!!}, {!!$surveyScoreAllUsers[31]->Answer!!}, {!!$surveyScoreAllUsers[32]->Answer!!}, {!!$surveyScoreAllUsers[33]->Answer!!}],
                                        'rgba(0,0,255,1)'
                                      );
                                    </script>
									@else
										<div>You have no surveys results to display or your indicators count is not equal 34</div>
									@endif
                                    <div>
                                      <table class="table table-bordered table-striped">
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
                                  </div>

								  <div id="compared" class="tab-pane fade">
                                  @if(count($surveyScoreAllUsersCheckThreeParticipants)>3)
                                  <div class="report-caption">
                                      <h4><b>Description</b></h4>
                                      <p>The bar graph shows a comparison between your score and company average score in this survey.
                          							The table underneath this graph displays company average score in table format.
                          						</p>
                                    </div>

                                    <div>
                                      @include ('survey.resultContent.scoreTable')
                                    </div>
								@if(count($surveyGroupAveragePerIndicatorAllUsers)==34)
									@if(count($surveyScorePerIndicatorGroup)==5)
                                  <canvas id="comparedGraph" width="800" height="400"></canvas>
                                  <script src="{{URL::asset('js/displayChart.js')}}">
                                  </script>
                                  <script>
                                    var chartArea = document.getElementById('comparedGraph');
                                    var datasetOwnScore = {
                                      label: 'My score',
                                      data: [{!!$surveyScoreAllUsers[0]->Answer!!}, {!!$surveyScoreAllUsers[1]->Answer!!}, {!!$surveyScoreAllUsers[2]->Answer!!}, {!!$surveyScoreAllUsers[3]->Answer!!}, {!!$surveyScoreAllUsers[4]->Answer!!},
                                        {!!$surveyScoreAllUsers[5]->Answer!!}, {!!$surveyScoreAllUsers[6]->Answer!!}, {!!$surveyScoreAllUsers[7]->Answer!!}, {!!$surveyScoreAllUsers[8]->Answer!!}, {!!$surveyScoreAllUsers[9]->Answer!!},
                                         {!!$surveyScoreAllUsers[10]->Answer!!}, {!!$surveyScoreAllUsers[11]->Answer!!}, {!!$surveyScoreAllUsers[12]->Answer!!}, {!!$surveyScoreAllUsers[13]->Answer!!}, {!!$surveyScoreAllUsers[14]->Answer!!},
                                          {!!$surveyScoreAllUsers[15]->Answer!!}, {!!$surveyScoreAllUsers[16]->Answer!!}, {!!$surveyScoreAllUsers[17]->Answer!!}, {!!$surveyScoreAllUsers[18]->Answer!!}, {!!$surveyScoreAllUsers[19]->Answer!!},
                                            {!!$surveyScoreAllUsers[20]->Answer!!}, {!!$surveyScoreAllUsers[21]->Answer!!}, {!!$surveyScoreAllUsers[22]->Answer!!}, {!!$surveyScoreAllUsers[23]->Answer!!}, {!!$surveyScoreAllUsers[24]->Answer!!},
                                              {!!$surveyScoreAllUsers[25]->Answer!!}, {!!$surveyScoreAllUsers[26]->Answer!!}, {!!$surveyScoreAllUsers[27]->Answer!!}, {!!$surveyScoreAllUsers[28]->Answer!!}, {!!$surveyScoreAllUsers[29]->Answer!!},
                                                {!!$surveyScoreAllUsers[30]->Answer!!}, {!!$surveyScoreAllUsers[31]->Answer!!}, {!!$surveyScoreAllUsers[32]->Answer!!}, {!!$surveyScoreAllUsers[33]->Answer!!}],
                                       backgroundColor: 'rgba(255,0,0,1)'
                                    };
                                    var datasetGroupAvg = {
                                      label: 'Company average',
                                      data: [{!!$surveyGroupAveragePerIndicatorAllUsers[0]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[1]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[2]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[3]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[4]->Group_Average!!},
                                        {!!$surveyGroupAveragePerIndicatorAllUsers[5]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[6]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[7]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[8]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[9]->Group_Average!!},
                                         {!!$surveyGroupAveragePerIndicatorAllUsers[10]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[11]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[12]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[13]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[14]->Group_Average!!},
                                          {!!$surveyGroupAveragePerIndicatorAllUsers[15]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[16]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[17]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[18]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[19]->Group_Average!!},
                                            {!!$surveyGroupAveragePerIndicatorAllUsers[20]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[21]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[22]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[23]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[24]->Group_Average!!},
                                              {!!$surveyGroupAveragePerIndicatorAllUsers[25]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[26]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[27]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[28]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[29]->Group_Average!!},
                                                {!!$surveyGroupAveragePerIndicatorAllUsers[30]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[31]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[32]->Group_Average!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[33]->Group_Average!!}],
                                      backgroundColor: 'rgba(0,0,255,1)'
                                    };
                                    var labelArr = [{!!$surveyGroupAveragePerIndicatorAllUsers[0]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[1]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[2]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[3]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[4]->Indicator_ID!!},
                                      {!!$surveyGroupAveragePerIndicatorAllUsers[5]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[6]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[7]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[8]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[9]->Indicator_ID!!},
                                       {!!$surveyGroupAveragePerIndicatorAllUsers[10]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[11]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[12]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[13]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[14]->Indicator_ID!!},
                                        {!!$surveyGroupAveragePerIndicatorAllUsers[15]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[16]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[17]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[18]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[19]->Indicator_ID!!},
                                          {!!$surveyGroupAveragePerIndicatorAllUsers[20]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[21]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[22]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[23]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[24]->Indicator_ID!!},
                                            {!!$surveyGroupAveragePerIndicatorAllUsers[25]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[26]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[27]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[28]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[29]->Indicator_ID!!},
                                              {!!$surveyGroupAveragePerIndicatorAllUsers[30]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[31]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[32]->Indicator_ID!!}, {!!$surveyGroupAveragePerIndicatorAllUsers[33]->Indicator_ID!!}];
                                    createComparedChart(chartArea, labelArr, datasetOwnScore, datasetGroupAvg);

                                  </script>
										@else
											<div>You have no surveys results to display or your indicators group count is not equal 5</div>
										@endif
									@else
										<div>You have no surveys results to display or your indicators count is not equal 34</div>
									@endif

                                    <div>
                                      <table class="table table-bordered table-striped">
                                        <h4><b>Indicators Table</b></h4>
                                          <thead>
                                            <tr>
                                                <th>Indicator ID</th>
                                                <th>Indicator</th>
                                                <th>Your Score</th>
                                                <th>Company average</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @if(count($surveyScoreAllUsers)==0)
                                              <div>You have no surveys results to display</div>

                                            @else
                                              @foreach ($surveyGroupAveragePerIndicatorAllUsers as $avgResult)
                                                <tr>
                                                  <td>{!! $avgResult->Indicator_ID !!}</td>
                                                  <td>{!! $avgResult->Indicator !!}</td>
                                                  @foreach ($surveyScoreAllUsers as $result)
                                                    @if(($result->Indicator_ID)==($avgResult->Indicator_ID))
                                                        <td>{!! $result->Answer !!}</td>
                                                    @endif
                                                  @endforeach
                                                  <td>{!! $avgResult->Group_Average !!}</td>
                                                </tr>
                                              @endforeach

                                            @endif
                                          </tbody>
                                      </table>
                                    </div>
									@else
										<div>You have no survey results with enough participants to compare</div>
									@endif
                                  </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @stop
