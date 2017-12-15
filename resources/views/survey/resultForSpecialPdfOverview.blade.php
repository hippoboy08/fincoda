<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Latest compiled and minified CSS -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>

    <!-- Theme style -->

    <script src="{{URL::asset('js/app.min.js')}}"></script>
    <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>

  <style>
    body {
      -webkit-print-color-adjust: exact;
    }
    /*info style*/
    .info {
      text-align: center;
      /*padding-top: 10px;*/
    }
    img#fincoda, img#eu {
      margin: 50px auto;
      vertical-align: middle;
    }
    .info h1{
    }
    .info ul li {
      list-style: none;
    }
    .info ul {
      padding: 0;
      margin: 30px 0;
    }
    /*introduction*/
    .introduction {
      margin-top: 100px;
      margin-bottom: 80px;
    }
    .introduction h1 {
    }
    .introduction h4 {
    }
    .introduction p {
	line-height: 2em;
    }

 </style>
    
      
  </head>

<body>
      <div class="container">

        <div class="pdf">

          <div class="info">
            <img id="fincoda" src="{{URL::asset('img/FINCODA logo.png')}}" alt="Fincoda Logo">
            <h1>FINCODA Innovation Barometer</h1>
            
            <h1>Assessment Tool</h1>
            <ul>
              <li><b>Name: </b>{!! $survey->title !!}</li>
              <li><b>Date: </b>{!! $survey->start_time !!}</li>
            </ul>

            <img id="eu" src="{{URL::asset('img/EU logo.png')}}" alt="EU Logo"><br><br><br><br><br><br>
            <h3>The FINCODA Innovation Barometer Assessment Tool has been developed by the European Union through academic and business partnership.</h3>
            <h3>To find out more visit www.fincoda.eu</h3>
	    <br><br><br><br><br><br><br><br><br><br><br><br>
          </div><!-- .info -->
          
          <div class="introduction">
            <h1>Introduction</h1>
            <p>Thank you for completing the FINCODA barometer Innovation Assessment Tool which assesses an individual’s capacity to be innovative within their work environment. This report summarises your scores with an interpretative description. The scores and the accompanying descriptions will give you an indication of possible directions in which you can develop your innovative capacity.</p>
            <p>You may find it valuable to share and discuss your profile with your peers or a manager when considering how to increase your innovative capacity. If your manager administered the survey for you to complete then they will also receive a copy of this report.</p>
            <p>Within this report, there are five ‘dimensions’ – for each dimension you will be provided with your score and an interpretative description for that score. The dimensions are as follows:</p>
            <br>
            <h4>Creativity</h4>
            <p>Your ability to think beyond tradition to generate or adapt meaningful alternatives (regardless of their possible practicality or future added value)</p>
            <br>
            <h4>Critical Thinking</h4>
            <p>Your ability to deconstruct and analyse ideas (to evaluate advantages and disadvantages, foresee how events will develop and estimate risk)</p>
            <br>
            <h4>Initiative</h4>
            <p>Your ability to make decisions or carry out actions to operationalise your ideas, as well as mobilise and manage those who have to implement the ideas.</p>
            <br>
            <h4>Teamwork</h4>
            <p>Your ability to work efficiently with others in a group</p>
            <br>
            <h4>Networking</h4>
            <p>Your ability to involve internal / external stakeholders</p>
            <br>
            <p>An innovator is defined as someone who has a <u><b>high mastery on one or more</b></u> of the basic innovation competencies.</p>
          </div> <!-- .introduction -->
          
          <br><br><br><br><br><br><br><br><br><br><br><br>    

        @role ('special')

        <h3 style="text-align:center;"><b>Group scores per dimension</b></h3>
				<div class="canvas-holder" style="width: 818px; height: 409px;">

          @if(count($surveyScorePerIndicatorGroup)==5)
			    <canvas id="indicatorGroupAverage1" width="800" height="400"></canvas>
          <script src="http://fincoda.dc.turkuamk.fi/js/displayChart.js"></script>
			    <script>
            var chartArea = document.getElementById('indicatorGroupAverage1');
            var datasetMinCompany = {
              label: 'Minimum Score',
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
              label: 'Maximum Score',
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
              label: 'Group Score',
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
				</div><!--.canvas-holder -->
        
	<br><br><br><br><br><br>

          @include ('survey.resultContent.surveyScorePerIndicatorGroup')

        @endrole        
	    </div><!-- .pdf -->

    </div><!-- .container -->    
</body>
  </html>
