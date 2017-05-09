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

                                @role ('special')

                                <div class="tab-content">
                                  <div class="tab-pane fade in active">

                                    @role ('special')
                                    
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
