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
    .info p {
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

    /*comments*/
    .score {
      display: inline-block;
      width: 180px;
      height: 230px;
      margin: 10px;
      vertical-align: middle;
    }
    .scores {
      width: 100%;
      text-align:center;
      margin: 10px auto;
      margin-top: 80px;
      overflow: auto;
    }
    .below-avg {
      border: 3px solid #C55B11;
      background: #F7CBAE;
    }
    .below-avg h4 {
      color: #C55B11;
      margin: 0;
      padding: 10px 10px;
    }
    .below-avg p {
      margin: 0;
      padding: 10px;
    }
    .avg {
      border: 3px solid #77933F;
      background: #D8E4BE;
    }
    .avg h4 {
      color: 	#77933F;
      margin: 0;
      padding: 10px 10px;
    }
    .avg p {
      margin: 0;
      padding: 10px;
    }
    .above-avg {
      border: 3px solid #30859c;
      background: #c4e4ed;
    }
    .above-avg h4 {
      color: 	#30859c;
      margin: 0;
      padding: 10px 10px;
    }
    .above-avg p {
      margin: 0;
      padding: 10px;
    }
    .progress {
      margin: 100px 0;
    }
    .rec {
      margin: 100px 0;
    }
    .mastery {
      padding: 40px 0;
      margin-bottom: 0px;
    }
    /*progress bar has colors when printing*/
    @media print{
                .progress{
                    background-color: #F5F5F5 !important;
                    -ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#F5F5F5', endColorstr='#F5F5F5')" !important;
                }
                .progress-bar-info{
                    display: block !important;
                    background-color: #5BC0DE !important;
                    -ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#5BC0DE', endColorstr='#5BC0DE')" !important;
                }
                .progress-bar-success {
                  display: block !important;
                  background-color: #5cb85c !important;
                  -ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#5cb85c', endColorstr='#5cb85c')" !important;
                }
                .progress-bar-danger {
                  display: block !important;
                  background-color: #d9534f !important;
                  -ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#d9534f', endColorstr='#d9534f')" !important;
                }
                .progress, .progress > .progress-bar {
                    display: block !important;
                    -webkit-print-color-adjust: exact !important;

                    box-shadow: inset 0 0 !important;
                    -webkit-box-shadow: inset 0 0 !important;
                }
            }
  </style>
    
    <script>
    $(document).ready(function(){
      var x = $(".average"),
          y = $(".progress-bar"),
          z = $(".rec");
          console.log(x[0].innerHTML);

      //creativity: x[0] low <=3.22, medium: >3.22 <=3.89, high: > 3.89
      function evaluateCreativity(num) {
        var cr = $("#cr"),
            cr_rec = $("#cr-rec"),
            cr_above = $("#cr-above");
        y[0].setAttribute("aria-valuenow", num);
        y[0].setAttribute("style", "width: " + num/5*100 + "%");
        y[0].append(num);
        if( 1.00 <= num && num <= 3.22 ) {
          y[0].classList.add('progress-bar-danger');
          z[0].classList.add('below-avg');
          cr.append("<li>lack a creative perspective</li>");
          cr.append("<li>avoid changes to current products, services or processes</li>");
          cr.append("<li>be unaware of the potential benefits of new ideas</li>");
          cr_rec.text("Your tendency to avoid unconventional ideas may not allow you to show the valuable role you are capable of playing. As a consequence your contributions may not be as significant as they could be. As your score suggests a tendency to avoid creative change, ensure that you do not dismiss others’ creative ideas too soon.");
        }
        else if ( 3.22 < num && num <= 3.89 ) {
          y[0].classList.add('progress-bar-success');
          z[0].classList.add('avg');
          cr.append("<li>take a creative perspective at times</li>");
          cr.append("<li>to test out your knowledge and intuition extensively prior to implementing any actions</li>");
          cr.append("<li>be more cautious in identifying unconventional ways to enhance products, services or processes</li>");
          cr_rec.text("It could be worthwhile for you to identify comfortable ways of using your imagination and sharing your creative ideas. It could be wise for you to take advice or spend time with others who have a high degree of creativity.");
        }
        else if ( num > 3.89){
          y[0].classList.add('progress-bar-info');
          z[0].classList.add('above-avg');
          cr_above.text(" strong");
          cr.append("<li>take a creative perspective</li>");
          cr.append("<li>think differently and be open to new ideas</li>");
          cr.append("<li>refine ideas in order to use the available resources in an original way</li>");
          cr.append("<li>identify unconventional ways that processes, products or services might be improved</li>");
          cr_rec.text("Being so creative, you may have a tendency to lose sight of the end goal. To balance this, it could be wise for you to take advice from others who can share the practical perspective.");
        }
        else {
          cr.append("Errors happened when retrieving your results")
          cr_rec.text("Please contact your admin for more information.")
        }
      }

      function evaluateCriticalThinking(num) {
        var ct = $("#ct"),
            ct_rec = $("#ct-rec"),
            ct_above = $("#ct-above");
        y[1].setAttribute("aria-valuenow", num);
        y[1].setAttribute("style", "width: " + num/5*100 + "%");
        y[1].append(num);
        if( 1.00 <= num && num <= 3.17 ) {
          y[1].classList.add('progress-bar-danger');
          z[1].classList.add('below-avg');
          ct.append("<li>avoid taking a critical perspective</li>");
          ct.append("<li>use traditional methods for problem solving</li>");
          ct.append("<li>avoid developing and experimenting with new ways of problem solving, preferring to accept things as they are</li>");
          ct_rec.text("Your score suggests you are satisfied with the norm and may adopt a supportive role. However, a degree of critical thinking is necessary for successful innovation so it will be helpful to consider ways of improving your critical thinking and taking advice from others who frequently adopt a critical viewpoint.");
        }
        else if ( 3.17 < num && num <= 3.83 ) {
          y[1].classList.add('progress-bar-success');
          z[1].classList.add('avg');
          ct.append("<li>take a critical perspective at times</li>");
          ct.append("<li>consider different points of view when facing tasks, problems and opportunities</li>");
          ct.append("<li>be less likely to develop and experiment with new ways of problem solving</li>");
          ct_rec.text("It could be worthwhile for you to identify opportunities to develop your critical and analytic thinking. It may be helpful to take advice from others who frequently adopt and share a critical viewpoint.");
        }
        else if ( num > 3.83){
          y[1].classList.add('progress-bar-info');
          z[1].classList.add('above-avg');
          ct.append("<li>take a critical perspective</li>");
          ct.append("<li>face tasks, problems and opportunities from different points of view</li>");
          ct.append("<li>consider the impact different solutions may have</li>");
          ct.append("<li>develop and experiment with new ways of problem solving using a trial and error approach</li>");
          ct_above.text(" strong");
          ct_rec.text("Your score suggests a strong critical tendency which is likely to benefit you in the course of innovation. However, demonstrating an overly critical and analytical attitude to others may hamper their creativity. Consider how you may offer more of a balanced argument when outlining solutions with others.");
        }
        else {
          ct.append("Errors happened when retrieving your results")
          ct_rec.text("Please contact your admin for more information.")
        }
      }

      function evaluateInitiative(num) {
        var IN = $("#in"),
            in_rec = $("#in-rec"),
            in_above = $("#in-above");
        y[2].setAttribute("aria-valuenow", num);
        y[2].setAttribute("style", "width: " + num/5*100 + "%");
        y[2].append(num);
        if( 1.00 <= num && num <= 3.17 ) {
          y[2].classList.add('progress-bar-danger');
          z[2].classList.add('below-avg');
          IN.append("<li>do only what is required to meet expectations in an assignment, task, or job description you are responsible for</li>");
          IN.append("<li>only support new ideas when there is minimal risk</li>");
          IN.append("<li>let others take the lead in fostering improvements in your work organisation</li>");
          IN.append("<li>lack visibility in your team or organisation</li>");
          in_rec.text("Your profile is a benefit in some cases as you are not seen as threatening by others. Your reputation might improve, however, when you can once in a while visibly support the initiative of others.");
        }
        else if ( 3.17 < num && num <= 3.83 ) {
          y[2].classList.add('progress-bar-success');
          z[2].classList.add('avg');
          IN.append("<li>contribute to improvements in your work organisation</li>");
          IN.append("<li>take a degree of risk to support new ideas</li>");
          IN.append("<li>aim for a high impact in the assignment, task, or job description without being asked</li>");
          IN.append("<li>Support someone else in an innovative idea</li>");
          in_rec.text("Overall you support new ideas into work practices. You should consider how you can be more proactive in putting your ideas forward.");
        }
        else if (num > 3.83){
          y[2].classList.add('progress-bar-info');
          z[2].classList.add('above-avg');
          IN.append("<li>challenge yourself to go beyond expectations in the assignment, task, or job description without being asked</li>");
          IN.append("<li>foster improvements in your work organisation and convince people to support an innovative idea</li>");
          IN.append("<li>frequently introduce new ideas into work practices</li>");
          IN.append("<li>act quickly and energetically</li>");
          IN.append("<li>remain visible person in your team or organisation</li>");
          in_above.text(" strong");
          in_rec.text("You are really a visible person in your team or organisation. Take care that you when you showing initiative that you do not appear domineering.");
        }
        else {
          IN.append("Errors happened when retrieving your results")
          in_rec.text("Please contact your admin for more information.")
        }
      }

      function evaluateTeamwork(num) {
        var tw = $("#tw"),
            tw_rec = $("#tw-rec"),
            tw_above = $("#tw-above");
        y[3].setAttribute("aria-valuenow", num);
        y[3].setAttribute("style", "width: " + num/5*100 + "%");
        y[3].append(num);
        if( 1.00 <= num && num <= 3.43 ) {
          y[3].classList.add('progress-bar-danger');
          z[3].classList.add('below-avg');
          tw.append("<li>be less likely to work effectively within a team</li>");
          tw.append("<li>to put your personal goals above the innovative goals of the team</li>");
          tw.append("<li>be less likely to engage in active listening</li>");
          tw.append("<li>to avoid giving and receiving constructive feedback from others</li>");
          tw_rec.text("Your score suggests a preference for working autonomously. However, this may result in you becoming isolated from the innovative activities in your team. You may benefit from working more closely with others to implement innovative ideas.");
        }
        else if ( 3.43 < num && num <= 4.00 ) {
          y[3].classList.add('progress-bar-success');
          z[3].classList.add('avg');
          tw.append("<li>implement your own changes with some consideration of others’ viewpoints</li>");
          tw.append("<li>listen when others are speaking and respond effectively at times</li>");
          tw.append("<li>engage in constructive feedback conversations from time to time</li>");
          tw.append("<li>address conflict within the team if it becomes apparent</li>");
          tw_rec.text("Your score suggests an ability to work well with others in the team whilst still focusing on personal goals. At times, you may consider how to balance your own goals with the team’s in implementing innovative ideas.");
        }
        else if (num > 4.00){
          y[3].classList.add('progress-bar-info');
          z[3].classList.add('above-avg');
          tw.append("<li>consult about essential changes</li>");
          tw.append("<li>actively listen when others are speaking and respond effectively</li>");
          tw.append("<li>both obtain from and offer constructive feedback to colleagues</li>");
          tw.append("<li>identify sources of conflict within the team and take steps to overcome disharmony</li>");
          tw_above.text(" strong");
          tw_rec.text("Your score suggests a strong team work ethic and that you work supportively with others to implement an innovative idea. However, be wary of this tendency for team working to have a negative impact on the achievement of your own personal goals.");
        }
        else {
          tw.append("Errors happened when retrieving your results")
          tw_rec.text("Please contact your admin for more information.")
        }
      }

      function evaluateNetworking(num) {
        var nw = $("#nw"),
            nw_rec = $("#nw-rec"),
            nw_above = $("#nw-above");
        y[4].setAttribute("aria-valuenow", num);
        y[4].setAttribute("style", "width: " + num/5*100 + "%");
        y[4].append(num);
        if( 1.00 <= num && num <= 3.17 ) {
          y[4].classList.add('progress-bar-danger');
          z[4].classList.add('below-avg');
          nw.append("<li>avoid engaging with others outside of your immediate team</li>");
          nw.append("<li>be less likely to engage with unknown stakeholders</li>");
          nw.append("<li>rely on others to facilitate conversations with people from different backgrounds</li>");
          nw_rec.text("Your score suggests a tendency to avoid networking. However, it can be a vital exercise in implementing innovation. Therefore you may wish to consider developing your networking skills with your peers initially.");
        }
        else if ( 3.17 < num && num <= 3.83 ) {
          y[4].classList.add('progress-bar-success');
          z[4].classList.add('avg');
          nw.append("<li>establish new contacts and maintain existing ones at times</li>");
          nw.append("<li>you are less likely to independently engage contacts inside and outside of your work environment</li>");
          nw.append("<li>only communicate with people from different backgrounds if initiated by others</li>");
          nw_rec.text("Your score suggests you are happy to engage with others at times. However, you may rely on others to initiate these engagements. You make find it valuable to speak to someone you know internally who is a proven networker to support you.");
        }
        else if (num > 3.83){
          y[4].classList.add('progress-bar-info');
          z[4].classList.add('above-avg');
          nw.append("<li>frequently establish new contacts and maintain existing ones</li>");
          nw.append("<li>engage contacts inside and outside of your everyday environment</li>");
          nw.append("<li>work with individuals from different backgrounds</li>");
          nw.append("<li>respect others’ ideas and perspectives and the value they provide</li>");
          nw_above.text(" strong");
          nw_rec.text("Your score suggests you frequently engage with those around you, identifying different perspectives to support the implementation of innovation. Ensure you demonstrate the benefit to others of engaging with a variety of individuals.");
        }
        else {
          nw.append("Errors happened when retrieving your results")
          nw_rec.text("Please contact your admin for more information.")
        }
      }
      evaluateCreativity(x[0].innerHTML);
      evaluateCriticalThinking(x[1].innerHTML);
      evaluateInitiative(x[2].innerHTML);
      evaluateTeamwork(x[3].innerHTML);
      evaluateNetworking(x[4].innerHTML);
    });
    </script>
  
  </head>

  <body>
    <div id="content">
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
	
          <!-- hidden results for displaying evaluation -->
          <!-- get variables in here.-->
          <div class="test" style="display: none">
            <p class="average">{!!number_format((float)$surveyScoreGroupAvgPerIndicatorGroup[0]->Indicator_Group_Average,2,'.','')!!}</p>
            <p class="average">{!!number_format((float)$surveyScoreGroupAvgPerIndicatorGroup[1]->Indicator_Group_Average,2,'.','')!!}</p>
            <p class="average">{!!number_format((float)$surveyScoreGroupAvgPerIndicatorGroup[2]->Indicator_Group_Average,2,'.','')!!}</p>
            <p class="average">{!!number_format((float)$surveyScoreGroupAvgPerIndicatorGroup[3]->Indicator_Group_Average,2,'.','')!!}</p>
            <p class="average">{!!number_format((float)$surveyScoreGroupAvgPerIndicatorGroup[4]->Indicator_Group_Average,2,'.','')!!}</p>
          </div>
          
          <br><br><br><br><br><br><br><br><br><br><br><br>    
                                              @role ('admin')

        <h3 style="text-align:center;"><b>Organization scores per dimension</b></h3>
				<div class="canvas-holder" style="width: 818px; height: 409px;">
									@if(count($surveyScorePerIndicatorGroup)==5)
				    <canvas id="indicatorGroupAverage" width="800" height="400"></canvas>
                                    <script src="http://fincoda.dc.turkuamk.fi/js/displayChart.js">
                                    </script>
				    <script>
            var chartArea = document.getElementById('indicatorGroupAverage');
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
              label: 'Average Score',
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
	<br><br><br><br><br><br>
        <div>
          @include ('survey.resultContent.surveyScorePerIndicatorGroup')
        </div>


                                  </div>

                                  @endrole
        </div><!-- .pdf -->

      </div><!-- .container -->

</div>
    
  </body>
  </html>
