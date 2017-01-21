<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Latest compiled and minified CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{URL::asset('css/custom.css')}}">

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>
    <script src="{{URL::asset('js/confirmation.js')}}" ></script>

    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::asset('css/AdminLTE.min.css')}}">

    <link rel="stylesheet" href="{{URL::asset('css/skins/skin-blue.min.css')}}">

    <script src="{{URL::asset('js/app.min.js')}}"></script>
    <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>


	<!-- Bootstrap WYSIHTML5 -->
	<script src="{{URL::asset('input-mask/jquery.inputmask.js')}}"></script>
	<script src="{{URL::asset('input-mask/jquery.inputmask.date.extensions.js')}}"></script>
	<script src="{{URL::asset('input-mask/jquery.inputmask.extensions.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
	<script src="{{URL::asset('bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
	<script src="{{URL::asset('timepicker/bootstrap-timepicker.min.js')}}"></script>
	<script src="{{URL::asset('daterangepicker/daterangepicker.js')}}"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">

            @include('message.fail')
            @include('message.errors_head')
            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <p>
                                <h2 style="text-align:center;">Survey Results</h2><br>
                                <!-- <label id="surveyId">{!! $survey->title !!}</label> -->
                                <ul class="survey-info">
								  {{App::setLocale(Session::get('language'))}}
								                  <li><h5><label>Id : </label> {!! $survey->id !!}</h5></li>
                                  <li><h5 class="text-capitalize"><label>Title : </label> {!! $survey->title !!}</h5></li>
                                  <li><h5 class="text-capitalize"><label>Type : </label> {!! \App\Survey_Type::find($survey->type_id)->name !!}</h5></li>
                                  <li><h5><label>Start time : </label> {!! $survey->start_time !!}</h5></li>
                                  <li><h5><label>Deadline : </label> {!! $survey->end_time !!}</h5></li>
                                  <li><h5><label>Total Participants : </label> {!! count($participants)!!}</h5></li>
                                  <li><h5><label>Total answers : </label> {!! $answers!!}</h5></li>
                                </ul>

                                @role ('admin')

                                <div class="tab-content">
                                  <div class="tab-pane fade in active">

                                    @role ('admin')
                                    <!-- Company average graph -->
                            				<div class="canvas-holder" style="width: 818px; height: 419px;">
                            				<h3 style="text-align:center;"><b>Indicators Chart</b></h3>
									@if(count($surveyGroupAveragePerIndicatorAllUsers)==34)
                                    <canvas id="companyAverage" width="800" height="400"></canvas>
                                    <script src="http://localhost/fincoda-phase2-complete/public/js/displayChart.js">
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
				            </div>

				                            <div>
                                      <table class="table table-bordered table-striped text-center">
                                        <h3 style="text-align:center;"><b>Indicators Table</b></h3>
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
                                    <br>
        <h3 style="text-align:center;"><b>Company average score per dimension</b></h3>
				<div class="canvas-holder" style="width: 818px; height: 409px;">
									@if(count($surveyScorePerIndicatorGroup)==5)
				    <canvas id="indicatorGroupAverage" width="800" height="400"></canvas>
                                    <script src="http://localhost/fincoda-phase2-complete/public/js/displayChart.js">
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
										<h3><b>You have no surveys results to display or your indicators group count is not equal 5</b></h3>
									@endif
				</div>

        <div>
          @include ('survey.resultContent.surveyScorePerIndicatorGroup')
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
</body>
</html>
