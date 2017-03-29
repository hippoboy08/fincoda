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
                  <li><h5><label>Total answers : </label> {!! $answers!!}</h5></li>
                </ul>

                <!-- <div id="show"> -->

                <div id="show">

                  @role ('admin')
                  <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#overview">Overview</a></li>
                    <li><a data-toggle="tab" href="#compared">Compared</a></li>
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

                        @role ('admin')
                        <h3 style="text-align: center;"><b>Your answer each indicator</b></h3>
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
                          'Your answer',
                          [{!!number_format((float)$surveyScoreAllUsers[0]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[1]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[2]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[3]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[4]->Answer,2,'.','')!!},
                            {!!number_format((float)$surveyScoreAllUsers[5]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[6]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[7]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[8]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[9]->Answer,2,'.','')!!},
                             {!!number_format((float)$surveyScoreAllUsers[10]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[11]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[12]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[13]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[14]->Answer,2,'.','')!!},
                              {!!number_format((float)$surveyScoreAllUsers[15]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[16]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[17]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[18]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[19]->Answer,2,'.','')!!},
                                {!!number_format((float)$surveyScoreAllUsers[20]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[21]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[22]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[23]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[24]->Answer,2,'.','')!!},
                                  {!!number_format((float)$surveyScoreAllUsers[25]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[26]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[27]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[28]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[29]->Answer,2,'.','')!!},
                                    {!!number_format((float)$surveyScoreAllUsers[30]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[31]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[32]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[33]->Answer,2,'.','')!!}],
                          'rgba(255,0,0,1)'
                        );
                        </script>
                        @else
                        <h3><b>You have no surveys results to display or your indicators count is not equal 34</b></h3>
                        @endif

                        <br>
                        <div>
                          <table class="table table-bordered table-striped text-center">
                            <h3 style="text-align: center;"><b>Indicators Table</b></h3>
                            <thead>
                              <tr>
                                <th>Indicator ID</th>
                                <th>Indicator</th>
                                <th>Answer</th>
                              </tr>
                            </thead>
                            <tbody>
                              @if(count($surveyScoreAllUsers)==0)
                              <h3><b>You have no surveys results to display</b></h3>
                              @else
                              @foreach($surveyScoreAllUsers as $result)
                              <tr>
                                <td>{!! $result->Indicator_ID !!}</td>
                                <td>{{Lang::get('indicators.'.$result->Indicator_ID,array(),App::getLocale())}}</td>
                                <td>{!! number_format((float)$result->Answer,2,'.','') !!}</td>
                              </tr>
                              @endforeach
                              @endif
                            </tbody>
                          </table>
                        </div>
                      </div>

                      <div id="compared" class="tab-pane fade">


                        <div class="tab-content">



                          @if(count($surveyScoreAllUsersCheckThreeParticipants)>2)
                          <div class="report-caption">
                            <h4><b>Description</b></h4>
                            <p>The bar graph shows a comparison between your score and company average score in this survey.
                              The table underneath this graph displays company average score in table format.
                            </p>
                          </div>

                          <div>
                            @include ('survey.resultContent.scoreTable')
                          </div>
                          <h3 style="text-align: center;"><b>Your answer VS Company average score</b></h3>
                          @if(count($surveyGroupAveragePerIndicatorAllUsers)==34)
                          @if(count($surveyScorePerIndicatorGroup)==5)
                          <canvas id="comparedGraph" width="800" height="400"></canvas>
                          <script src="{{URL::asset('js/displayChart.js')}}">
                          </script>
                          <script>
                          var chartArea = document.getElementById('comparedGraph');
                          var datasetOwnScore = {
                            label: 'Your answer',
                            data: [{!!number_format((float)$surveyScoreAllUsers[0]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[1]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[2]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[3]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[4]->Answer,2,'.','')!!},
                              {!!number_format((float)$surveyScoreAllUsers[5]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[6]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[7]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[8]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[9]->Answer,2,'.','')!!},
                               {!!number_format((float)$surveyScoreAllUsers[10]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[11]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[12]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[13]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[14]->Answer,2,'.','')!!},
                                {!!number_format((float)$surveyScoreAllUsers[15]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[16]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[17]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[18]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[19]->Answer,2,'.','')!!},
                                  {!!number_format((float)$surveyScoreAllUsers[20]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[21]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[22]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[23]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[24]->Answer,2,'.','')!!},
                                    {!!number_format((float)$surveyScoreAllUsers[25]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[26]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[27]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[28]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[29]->Answer,2,'.','')!!},
                                      {!!number_format((float)$surveyScoreAllUsers[30]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[31]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[32]->Answer,2,'.','')!!}, {!!number_format((float)$surveyScoreAllUsers[33]->Answer,2,'.','')!!}],
                            backgroundColor: 'rgba(255,0,0,1)'
                          };
                          var datasetGroupAvg = {
                            label: 'Company average',
                            data: [{!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[0]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[1]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[2]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[3]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[4]->Group_Average,2,'.','')!!},
                              {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[5]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[6]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[7]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[8]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[9]->Group_Average,2,'.','')!!},
                               {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[10]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[11]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[12]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[13]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[14]->Group_Average,2,'.','')!!},
                                {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[15]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[16]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[17]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[18]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[19]->Group_Average,2,'.','')!!},
                                  {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[20]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[21]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[22]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[23]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[24]->Group_Average,2,'.','')!!},
                                    {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[25]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[26]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[27]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[28]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[29]->Group_Average,2,'.','')!!},
                                      {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[30]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[31]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[32]->Group_Average,2,'.','')!!}, {!!number_format((float)$surveyGroupAveragePerIndicatorAllUsers[33]->Group_Average,2,'.','')!!}],
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
                          <h3><b>You have no surveys results to display or your indicators group count is not equal 5</b></h3>
                          @endif
                          @else
                          <h3><b>You have no surveys results to display or your indicators count is not equal 34</b></h3>
                          @endif

                          <div>
                            <table class="table table-bordered table-striped">
                              <h3 style="text-align: center;"><b>Indicators Table</b></h3>
                              <thead>
                                <tr>
                                  <th>Indicator ID</th>
                                  <th>Indicator</th>
                                  <th>Your answer</th>
                                  <th>Company average</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if(count($surveyScoreAllUsers)==0)
                                <h3><b>You have no surveys results to display</b></h3>

                                @else
                                @foreach ($surveyGroupAveragePerIndicatorAllUsers as $avgResult)
                                <tr>
                                  <td>{!! $avgResult->Indicator_ID !!}</td>
                                  <td>{{Lang::get('indicators.'.$avgResult->Indicator_ID,array(),App::getLocale())}}</td>
                                  @foreach ($surveyScoreAllUsers as $result)
                                  @if(($result->Indicator_ID)==($avgResult->Indicator_ID))
                                  <td>{!! number_format((float)$result->Answer,2,'.','') !!}</td>
                                  @endif
                                  @endforeach
                                  <td>{!! number_format((float)$avgResult->Group_Average,2,'.','') !!}</td>
                                </tr>
                                @endforeach

                                @endif
                              </tbody>
                            </table>
                          </div>
                          @else
                          <h3><b>You have no survey results with enough participants to compare</b></h3>
                          @endif
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
  </div>
  @stop