@extends('master')
@section('content')



<div class="row">
  <!-- left column -->
  <div class="col-md-12 col-md-offset-0">

    @include('message.fail')

    <div class="box-header with-border">
      <h2 class="box-title"><b>Take survey.</b></h2>
      <p><i>Below is the information of the survey you are going to take.
      </i></p>
    </div>

    <div class="box box-primary">
      <div class="box-body">
        {{App::setLocale(Session::get('language'))}}
        <h2>{!! $survey->title !!}</h2>
        <h3><b>Created by:</b></h3>{!! \App\User::find($survey->user_id)->name !!}
        <h3><b>Open duration:</b></h3>{!! $survey->start_time.' - '.$survey->end_time !!}
        <h4><b>Survey Description:</b></h4></label><p>{!! $survey->description !!}</p>

        <!-- The Modal -->
        <div id="myModal" class="agree">

          <!-- Modal content -->
          <div class="agree-content">
            <h4><b>Introduction</b></h4>
            <p>Innovation encourages an organisation to develop a knowledge-based competitive advantage. Innovation is often a critical component for success in today’s working world and so the FINCODA Innovation Barometer Assessment Tool gives organisations and individuals the ability to assess their capacity for innovation – by assessing individual levels of innovativeness. Innovation is a process that allows for the introduction of a new product or service, new production methods, opens up new markets, identifies new suppliers, and business or management models that result in enhanced performance by, or within, the organization. Therefore, innovation starts with the generation of new ideas and finishes with the use or commercial exploitation of the outcomes.</p>
            <p>The Fincoda Barometer includes five Innovation competencies that span the process of innovation from idea to outcome. The following five dimensions are measured using the FINCODA Barometer: creativity, critical thinking, initiative, teamwork and networking. As it is unlikely that an individual would show a high mastery on all five innovation competencies, an innovator is defined as someone who has a high mastery on one or more of the five innovation competencies.</p>

            <h4><b>The self-assessment tool</b></h4>
            <p>The FINCODA (Framework for Innovation Competencies Development and Assessment) barometer Innovation Assessment Tool is a reliable and valid tool for innovation competencies measurement. It measures innovation capacity in both education and practice and takes around 30 minutes to complete following which a report will be available to download.</p>
            <br><br>
            <p>Initially the report will only be available for the person who completes the survey. However, if your manager has administered this survey then a copy will also be made available to them.</p>
            <p>By clicking ‘next’ you are providing your consent to take part in the survey.</p>
            <input type="checkbox" name="agreement" value="yes" id="myCheck" onclick="verify()">  I agree<br><br>
            <button class="btn btn-info" type="submit" id="agree" disabled>Submit</button>
          </div>

        </div>

        <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the button that opens the modal
        var btn = document.getElementById("agree");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];


        modal.style.display = "block";

        function verify() {
          if( document.getElementById("myCheck").checked === true ) {
            btn.disabled = false;
          }
          else {
            btn.disabled = true;
          }
        }

        // When the user submits with checkbox checked, close the modal
        btn.onclick = function() {
          if( document.getElementById("myCheck").checked === true ) {
            modal.style.display = "none";
          }
        }
        </script>

        <h4><b>Marking your indicator:</b></h4>
        <p> The marking of the indicators is from value 1 to 5.
          If you prefer not to respond to a particular indicator, please mark 0. All the indicators should be marked.
        </p>
        <p><b>0=Not observed, 1=Very poor, 2=Need to improve, 3=Pass, 4=Good, 5=Excellent</b></p>


        @role('basic')
        {!! Form::open(['method'=>'POST', 'action'=>'basic\SurveyController@store']) !!}
        @endrole
        @role('external')
        {!! Form::open(['method'=>'POST', 'action'=>'external\SurveyController@store']) !!}
        @endrole
        @role('special')
        {!! Form::open(['method'=>'POST', 'action'=>'special\CompanySurveyController@store']) !!}
        @endrole
		@role('admin')
        {!! Form::open(['method'=>'POST', 'action'=>'admin\CompanySurveyController@store']) !!}
        @endrole
        {!! Form::hidden('survey_id',$survey->id) !!}
        @if(!empty($user_id))
        {!! Form::hidden('user_id',$user_id) !!}
        @endif
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No.</th>
              <th>Survey Indicators</th>
              <th>0</th>
              <th>1</th>
              <th>2</th>
              <th>3</th>
              <th>4</th>
              <th>5</th>
            </tr>
          </thead>
          <tbody>
            <ol type="1" start="1">
              @foreach($indicators->shuffle() as $indicator)
              <tr>
                <td hidden>{!! $indicator->id !!}</td>
                <td>{{Lang::get('indicators.'.$indicator->id,array(),App::getLocale())}}</td>
                <td>{!! Form::radio('radio['.$indicator->id.']',0) !!}</td>
                <td>{!! Form::radio('radio['.$indicator->id.']',1) !!}</td>
                <td>{!! Form::radio('radio['.$indicator->id.']',2) !!}</td>
                <td>{!! Form::radio('radio['.$indicator->id.']',3) !!}</td>
                <td>{!! Form::radio('radio['.$indicator->id.']',4) !!}</td>
                <td>{!! Form::radio('radio['.$indicator->id.']',5) !!}</td>
              </tr>
              @endforeach
            </ol>
            <!--/// Create an ordered numbers for the indicators list ///-->
            <script type="text/javascript">
            $(function () {
              var i = 0;
              // $('table thead tr').prepend('<th>S.No</th>');
              $('table tbody tr').each(function () {
                i += 1;
                $(this).prepend('<td style="text-align:center;">'+i+'</td>');
              });
            });

            </script>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Survey Indicator</th>
                <th>0</th
                  ><th>1</th>
                  <th>2</th>
                  <th>3</th>
                  <th>4</th>
                  <th>5</th>
                </tr>
              </tfoot>
            </tbody>
          </table>
          <button type="submit" class="btn btn-info btn-flat" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Submit Survey</button>
          {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>

  @stop
