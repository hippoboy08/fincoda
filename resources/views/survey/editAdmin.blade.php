@extends('master')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12 col-md-offset-0">
            <!-- general form elements -->

            @role('admin')
            {!! Form::open(['method'=>'POST','action'=>'admin\SurveyController@updateSurvey']) !!}
            @endrole
            @role('special')
            {!! Form::open(['method'=>'POST','action'=>'special\GroupSurveyController@store']) !!}
            @endrole

            <div class="box-header with-border">
                <h3 class="box-title"><b>Create a new survey.</b></h3>
                <p><i>Please provide all the information below to create a new survey.</i></p>
            </div>

            @include('message.fail')
            @include('message.errors_head')
            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel panel-default">
                        <div class="panel-body">

						<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!} has-feedback">
                                <label><h3>Survey Id*:</h3></label>
                                 {!! Form::text('id',$survey->id,['class'=>'form-control','readonly']) !!}
                            </div><br>

                            <div class="form-group{!! $errors->has('title') ? ' has-error':'' !!} has-feedback">
                        <label><h3>Survey Title*:</h3></label>
                            <p>Provide a name/title for your survey</p>
                         @if($errors->has('title'))
                              <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('title') !!}</label>
                         @endif
                        {!! Form::text('title',$survey->title,['class'=>'form-control']) !!}
                                </div><br>

                            <div class="form-group{!! $errors->has('editor1') ? ' has-error':'' !!} has-feedback">
                                <label><h3>Survey Description*:</h3></label>
                                <p>Please give a description of the survey. This will appear to your survey's participant page once the participants starts taking the survey. </p>
                                @if($errors->has('editor1'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('editor1') !!}</label>
                                @endif
                                {!! Form::textarea('editor1',$survey->description,['id'=>'editor1','rows'=>'10','cols'=>'80']) !!}
                            </div><br>

                            <div class="form-group{!! $errors->has('date') ? ' has-error':'' !!} has-feedback">
                            <label><h3>Open data ane time range*:</h3></label>

							<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!} has-feedback">
                                <label><h3>Current Start Time:</h3></label>
                                 {!! Form::text('currentStartTime',$survey->start_time,['class'=>'form-control','readonly']) !!}
                            </div><br>

							<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!} has-feedback">
                                <label><h3>Current End Time:</h3></label>
                                 {!! Form::text('currentEndTime',$survey->end_time,['class'=>'form-control','readonly']) !!}
                            </div><br>

                            <p>Please choose the date and time range of the start and end of the survey: Current Date And Time On Server: {{\Carbon\Carbon::now()}}</p>
								@if($errors->has('startDate'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('startDate') !!}</label>
                                @endif
                            <div class="form-group">
                                <div class="input-group split-time">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    {!! Form::text('startDate',old('startDate'),['class'=>'form-control pull-left','id'=>'startTime', 'placeholder'=>'New Start Time']) !!}
								</div><!-- /.input group -->
                            </div>
							@if($errors->has('endDate'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('endDate') !!}</label>
                            @endif
                            <div class="form-group">
                                <div class="input-group split-time">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    {!! Form::text('endDate',old('endDate'),['class'=>'form-control pull-left','id'=>'endTime', 'placeholder'=>'New End Time']) !!}
                                </div><!-- /.input group -->
                            </div>
                          </div>


                            <br>
                            <label><h3>Select a Survey Type*:</h3></label><br>
							@if($survey->type_id == 1)
								{!! Form::radio('survey_type','1',true,['class'=>'form-group']) !!}
							@else
								{!! Form::radio('survey_type','1','',['class'=>'form-group']) !!}
							@endif
                            <label>Self Evaluation Survey</label><br>
							@if($survey->type_id == 2)
								{!! Form::radio('survey_type','2','true',['class'=>'form-group']) !!}
							@else
								{!! Form::radio('survey_type','2','',['class'=>'form-group']) !!}
							@endif
                            <label>Peer Evaluation Survey</label><br><br>



                            <p class="panel-title">
                                <a data-toggle="collapse" href="#collapse1"><i class="fa fa-sort-desc" aria-hidden="true"></i>
                                    <label>Indicators appearing in the survey</label></a>
                                <p>There are {!! count($indicators) !!} survey indicators. These indicators are fixed and can not be modified or edited.</p>
                            </p>


                        <div id="collapse1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Indicators</th>
                                        <th>Indicator Category</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($indicators as $question)
                                    <tr>
                                      <td>{!! $question->id !!}</td>
                                        <td>{!! $question->indicator !!}</td>
                                        <td>{!! strtoupper(\App\Indicator_Group::find($question->group_id)->name) !!}</td>
                                    </tr>

                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Indicators</th>
                                        <th>Indicator Category</th>
										</tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div><br>

						 <p class="panel-title">
                             <a data-toggle="collapse" href="#collapse4"><i class="fa fa-sort-desc" aria-hidden="true"></i>
                                    <label>Participants who have completed the survey</label></a>
                            </p>
                            <div id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
											<th>User ID</th>
                                            <th>Full Name</th>
                                            <th>Email Address</th>
                                         </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($participantsCompleted as $participant)
                                            <tr>
												<td>{!! $participant->id !!}</td>
                                                <td>{!! $participant->name !!}</td>
                                                <td>{!! $participant->email !!}</td>
                                            </tr>
                                            <p></p>
                                        @endforeach
                                        </tbody>
                                        </table>
                                </div>
                            </div>



                            <p class="panel-title">
                             <a data-toggle="collapse" href="#collapse2"><i class="fa fa-sort-desc" aria-hidden="true"></i>
                                    <label>Participants who have not yet completed the survey (you can remove from these)</label></a>
                            </p>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="form-group{!! $errors->has('usersToRemove') ? ' has-error':'' !!} has-feedback">
                                <label><h3>Remove users from the survey*:</h3></label>
                                <p>Please select users to remove from this group.</p>
                                @if($errors->has('usersToRemove'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('usersToRemove') !!}</label>
                                @endif
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th><i class="fa fa-check-square-o" aria-hidden="true"></i> | User ID</th>
									<th>Full Name</th>
                                    <th>Email Address</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($participantsNotCompleted as $user)
                                    <tr>
                                        <td>{!! Form::checkbox('usersToRemove[]',$user->id) !!} | {!! $user->id !!}</td>
										<td>{!! $user->name !!}</td>
                                        <td>{!! $user->email !!}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                                </table>
                                </div>
                                </div>
                            </div>



							<p class="panel-title">
                             <a data-toggle="collapse" href="#collapse3"><i class="fa fa-sort-desc" aria-hidden="true"></i>
                                    <label>Participants who were not part of the survey (you can add these)</label></a>
                            </p>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="form-group{!! $errors->has('usersToAdd') ? ' has-error':'' !!} has-feedback">
                                <label><h3>Add users to the survey*:</h3></label>
                                <p>Please select users to remove from this group.</p>
                                @if($errors->has('usersToAdd'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('usersToAdd') !!}</label>
                                @endif
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th><i class="fa fa-check-square-o" aria-hidden="true"></i> | User ID</th>
									<th>Full Name</th>
                                    <th>Email Address</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($participantsNot as $user)
                                    <tr>
                                        <td>{!! Form::checkbox('usersToAdd[]',$user->id) !!} | {!! $user->id !!}</td>
										<td>{!! $user->name !!}</td>
                                        <td>{!! $user->email !!}</td>

                                    </tr>
                                @endforeach
                                </tbody>


                                </table>
                                </div>
                                </div>
                            </div>



                            <br>

                            <div class="form-group{!! $errors->has('editor2') ? ' has-error':'' !!} has-feedback">
                            <label><h3>Survey completion text*:</h3></label>
                            <p>Survey Completion text is the text that appears after a participant has completed the survey. You could mention some thank you text for taking the survey. </p>
                                @if($errors->has('editor2'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('editor2') !!}</label>
                                @endif
                                {!! Form::textarea('editor2',$survey->end_message,['id'=>'editor2','rows'=>'10','cols'=>'80']) !!}</div><br>


                            <button type="submit" class="btn btn-info btn-flat" > Update Survey</button>

                        </div>
                    </div>
                </div>
            </div>

           {!! Form::close() !!}
    </div>
    </div>
@stop
