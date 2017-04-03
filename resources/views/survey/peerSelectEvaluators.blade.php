@extends('master')
@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-12 col-md-offset-0">

    @include('message.fail')

    <div class="box-header with-border">
      <h2 class="box-title"><b>You have been invited to take part in a survey.</b></h2>
      <p><i>Below is the information of the survey you are going to take.
      </i></p>
    </div>
    <div class="box box-primary">
      <div class="box-body">
        <div class="panel panel-default">
          <div class="panel-body">

            <h2>Survey Results</h2>
            <ul>
              <li><h5><label>Survey title</label> : {!! $survey->title !!}</h5></li>
              <li><h5><label>Created by</label> : {!! \App\User::find($survey->user_id)->name !!}</h5></li>
              <li><h5><label>Open between</label> : {!! $survey->start_time.' - '.$survey->end_time !!}</h5></li>
              <li><h5><label>Survey Description</label>: {!! $survey->description !!}</h5></li>
              <li style="display:none;"><p id="surveyId">{!!$survey->id!!}</p></li>
              <li style="display:none;"><p id="userId">{!!Auth::User()->id!!}</p></li>
            </ul>
            <br><br>
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#tab1">Select who evaluate you</a></li>
              <li><a data-toggle="tab" href="#tab2">Who are evaluating you</a></li>
              <li><a data-toggle="tab" href="#tab3">People you are evaluating</a></li>
			  <li><a data-toggle="tab" href="#tab5">Invite External Evaluators</a></li>
			  <li><a data-toggle="tab" href="#tab6">External Evaluators who have confirmed</a></li>
			  <li><a data-toggle="tab" href="#tab7">External Evaluators who have not confirmed</a></li>
              <li id='getData'><a data-toggle="tab" href="#tab4">Results</a></li>
            </ul>

            <div class="tab-content">
              <div id="tab1" class="tab-pane fade in active">
                <br>
                @role('basic')
                {!! Form::open(['method'=>'POST', 'action'=>'basic\SurveyController@inviteEvaluators']) !!}
                @endrole
                @role('special')
                {!! Form::open(['method'=>'POST', 'action'=>'special\CompanySurveyController@inviteEvaluators']) !!}
                @endrole
				@role('admin')
                {!! Form::open(['method'=>'POST', 'action'=>'admin\CompanySurveyController@inviteEvaluators']) !!}
                @endrole
                {!! Form::hidden('survey_id',$survey->id) !!}
                <p class="panel-title">
                  <label>Please select a maximum of {{$survey->number_of_evaluators}} people you would like to evaluate you. If no participants is shown, you have had maximum participants as evaluators.</label>
                </p>
                @if(Session::has('message'))
                <h4 style="color:red;">{{Session::get('message')}}</h4>
                  @endif
                  <div class="panel-body">
                    <div class="form-group{!! $errors->has('usersToEvaluate') ? ' has-error':'' !!} has-feedback">
                      @if($errors->has('usersToEvaluate'))
                      <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('usersToEvaluate') !!}</label>
                      @endif

                      <table id="example7" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th><i class="fa fa-check-square-o" aria-hidden="true"></i> | User Name</th>
                            <th>Email Address</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(count($evaluators)<$survey->number_of_evaluators)
                          @foreach($participantsNotSelectedAsEvaluators as $user)
                          <tr>
                            <td>{!! Form::checkbox('usersToEvaluate[]',$user->id) !!} | {!! $user->name !!}</td>
                            <td>{!! $user->email !!}</td>
                          </tr>
                          @endforeach
                          @endif
                        </tbody>
                        <tfoot id='tfooter' align='center'>
                          <tr>
                            <td colspan="2">
                              <button type="button" id="externalEvaluator" class="btn btn-block btn-info" aria-hidden="true"><strong><b><label>Add external Evaluator</label></b></strong></button>
                            </td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>

                  <div class="modal fade" id="externalEvaluatorModal" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title"><b>Exceed maximum number of evaluators</b></h3>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="email">There is already {{ $survey->number_of_evaluators }} evaluators !!!</label>
                          <!-- <input class="form-control" id="email" type="text" placeholder="Enter the evaluator email address"> -->
                      </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <!-- <button type="button" id="inviteExternalEvaluator" class="btn btn-primary">Send Invitation</button> -->
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                  <button id="pickEvaluators" type="submit" class="btn btn-info btn-flat"><i class="fa fa-floppy-o" aria-hidden="true" ></i> Submit</button>

                  @if(count($evaluators)>=$survey->number_of_evaluators)
                  <script type="text/javascript">
                    document.getElementById('pickEvaluators').disabled=true;
                    document.getElementById('externalEvaluator').style.visibility="hidden";
                  </script>
                  @endif
                  {!! Form::close() !!}
                </div>


                <div id="tab2" class="tab-pane fade">
                  <br>
                  <p class="panel-title">
                    <label>People who you asked to evaluate you.</label>
                  </p>
                  <div class="panel-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Full Name</th>
                          <th>Email Address</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(count($evaluators)>0)
                        @foreach($evaluators as $user)
                        <tr>
                          <td>{!! $user->name !!}</td>
                          <td>{!! $user->email !!}</td>
                          @if(count($evaluatorsCompleted)>0)
                          @foreach($evaluatorsCompleted as $users)
                          @if($user->id == $users->id)
                          <td>
                            <button type="button" class="btn btn-success">Completed</button>
                          </td>
                          @endif
                          @endforeach
                          @endif
                          @if(count($evaluatorsNotCompleted)>0)
                          @foreach($evaluatorsNotCompleted as $users)
                          @if($user->id == $users->id)
                          <td>
                            <button type="button" class="btn btn-danger">Not Completed</button>
                          </td>
                          @endif
                          @endforeach
                          @endif
                        </tr>
                        @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>

                <div id="tab3" class="tab-pane fade">
                  <br>
                  <p class="panel-title">
                    <label>People who have asked you to evaluate them. The name link will be active if you have not completed evaluating them.</label>
                  </p>
                  <div class="panel-body">
                    <table id="example3" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Full Name</th>
                          <th>Email Address</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(count($evaluatees)>0)
                        @foreach($evaluatees as $user)
                        <tr>
                          @if(count($evaluated)>0)
                          @foreach($evaluated as $users)
                          @if($user->id == $users->id)
                          <td>{!! $user->name !!}</td>
                          <td>{!! $user->email !!}</td>
                          <td>
                            <button type="button" class="btn btn-success">Completed</button>
                          </td>
                          @endif
                          @endforeach
                          @endif

                          @if(count($evaluatedNot)>0)
                          @foreach($evaluatedNot as $users)
                          @if($user->id == $users->id)
                          @role('admin')
                          <td><a href="{!! url('admin/survey/evaluateUser/'.$survey->id).'/'.$user->id !!}">{!! $user->name !!}</a></td>
                          <td>{!! $user->email !!}</td>
                          @endrole

                          @role('special')
                          <td><a href="{!! url('special/survey/evaluateUser/'.$survey->id).'/'.$user->id !!}">{!! $user->name !!}</a></td>
                          <td>{!! $user->email !!}</td>
                          @endrole

                          @role('basic')
                          <td><a href="{!! url('basic/survey/evaluateUser/'.$survey->id).'/'.$user->id !!}">{!! $user->name !!}</a></td>
                          <td>{!! $user->email !!}</td>
                          @endrole
                          <td>
                            <button type="button" class="btn btn-danger">Not Completed</button>
                          </td>
                          @endif
                          @endforeach
                          @endif
                        </tr>
                        @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>

                <div id="tab4" class="tab-pane fade">
                  <br>

                  @role('special')
                  @if(count($evaluatorsCompleted)>1)
                  <script type="text/javascript">
                  $(document).ready(function(){
                    $('#getData').click(function(e) {
                      $userId = $('#userId').text();
                      $surveyId = $('#surveyId').text();

                      $url = 'viewPeerResults/'+$surveyId+'/'+$userId;

                      $.get($url,function(response){
                        content = $("#show",response);
                        $('#tab4').html(content);
                      })
                      .fail(function() {
                        $('#tab4').html('<h3>Errors occurs when retrieving your results. Please contact admin for more information.</h3>');
                      });
                    });
                  });
                  </script>
                  @endif
                  @if(count($evaluatorsCompleted)<=1)
                  <h3>You don't have enough evaluations to see your result.</h3>
                  @endif
                  @endrole

                  @role('basic')
                  @if(count($evaluatorsCompleted)>1)
                  <script type="text/javascript">
                  $(document).ready(function(){
                    $('#getData').click(function(e) {
                      $userId = $('#userId').text();
                      $surveyId = $('#surveyId').text();

                      $url = 'viewPeerResults/'+$surveyId+'/'+$userId;
                      $.get($url,function(response){
                        content = $("#show",response);
                        $('#tab4').html(content);
                      })
                      .fail(function() {
                        $('#tab4').html('<h3>Errors occurs when retrieving your results. Please contact admin for more information.</h3>');
                      });
                    });
                  });
                  </script>
                  @endif
                  @if(count($evaluatorsCompleted)<=1)
                  <h3>You don't have enough evaluations to get your result.</h3>
                  @endif
                  @endrole
                </div>


				<div id="tab5" class="tab-pane fade">
                <br>
                @role('basic')
                {!! Form::open(['method'=>'POST', 'action'=>'basic\SurveyController@inviteExternalEvaluators']) !!}
                @endrole

                {!! Form::hidden('survey_id',$survey->id) !!}
                <p class="panel-title">
                  <label>Please select a maximum of {{$survey->number_of_evaluators}} people you would like to evaluate you. If no participants is shown, you have had maximum participants as evaluators.</label>
                </p>
                <div id="numberOfEvaluators" data-field-id="{{$survey->number_of_evaluators}}" ></div>
                @if(Session::has('message'))
                <h4 style="color:red;">{{Session::get('message')}}</h4>
                  @endif
                  <div class="panel-body">
                    <div class="form-group{!! $errors->has('usersToEvaluate') ? ' has-error':'' !!} has-feedback">
                      @if($errors->has('usersToEvaluate'))
                      <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('usersToEvaluate') !!}</label>
                      @endif

                      <table id="example9" class="table table-bordered table-striped">
                        <tbody>
                          <tr>
                           <td>
							<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!} has-feedback">
                            <label>Email Address*</label><br>
							</td>
							<td>
                            @if($errors->has('company_code'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('email') !!}</label>
                            @endif
                            {!! Form::text('email1',old('email'),['class'=>'form-control','placeholder'=>'Email Address']) !!}
                            <span class="form-control-feedback"><i class="fa fa-lock" aria-hidden="true"></i></span>
							</td>
							</div>
                          </tr>
						  <tr>
                           <td>
							<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!} has-feedback">
                            <label>Email Address*</label><br>
							</td>
							<td>
                            @if($errors->has('company_code'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('email') !!}</label>
                            @endif
                            {!! Form::text('email2',old('email'),['class'=>'form-control','placeholder'=>'Email Address']) !!}
                            <span class="form-control-feedback"><i class="fa fa-lock" aria-hidden="true"></i></span>
							</td>
							</div>
                          </tr>
						  <tr>
                           <td>
							<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!} has-feedback">
                            <label>Email Address*</label><br>
							</td>
							<td>
                            @if($errors->has('company_code'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('email') !!}</label>
                            @endif
                            {!! Form::text('email3',old('email'),['class'=>'form-control','placeholder'=>'Email Address']) !!}
                            <span class="form-control-feedback"><i class="fa fa-lock" aria-hidden="true"></i></span>
							</td>
							</div>
                          </tr>
                        </tbody>
                      </table>
				    </div>
                  </div>

                  <button id="pickEvaluators" type="submit" class="btn btn-info btn-flat"><i class="fa fa-floppy-o" aria-hidden="true" ></i> Submit</button>
                  {!! Form::close() !!}
                </div>


              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- DataTables -->
<script src="{{URL::asset('datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('datatables/dataTables.bootstrap.min.js')}}"></script>

<script>
$(function () {
  $("#example1").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false
  });
  $("#example3").DataTable();
  $("#example4").DataTable();
  $("#example5").DataTable();
  $("#example7").DataTable();
});
</script>
@stop
