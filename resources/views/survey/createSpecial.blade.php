@extends('master')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12 col-md-offset-0">
            <!-- general form elements -->

            @role('admin')
            {!! Form::open(['method'=>'POST','action'=>'admin\SurveyController@store']) !!}
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
                            <div class="form-group{!! $errors->has('title') ? ' has-error':'' !!} has-feedback">
                        <label><h3>Survey Title*:</h3></label>
                            <p>Provide a name/title for your survey</p>
                         @if($errors->has('title'))
                              <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('title') !!}</label>
                         @endif
                        {!! Form::text('title',old('title'),['class'=>'form-control','placeholder'=>'Title of your Survey']) !!}
                                </div><br>

                            <div class="form-group{!! $errors->has('editor1') ? ' has-error':'' !!} has-feedback">
                                <label><h3>Survey Description*:</h3></label>
                                <p>Please give a description of the survey. This will appear to your survey's participant page once the participants starts taking the survey. </p>
                                @if($errors->has('editor1'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('editor1') !!}</label>
                                @endif
                                {!! Form::textarea('editor1',old('editor1'),['id'=>'editor1','rows'=>'10','cols'=>'80']) !!}
                            </div><br>


                            <div class="form-group{!! $errors->has('date') ? ' has-error':'' !!} has-feedback">

							<div class="form-group{!! $errors->has('date') ? ' has-error':'' !!} has-feedback">

                            <label><h3>Open and Close dates*:</h3></label>
                            <p>Please, choose the proper date and time to open the survey and to close it.</p>
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
                            {!! Form::radio('survey_type','1',true,['class'=>'form-group']) !!}
                            <label>Self Evaluation Survey</label><br>
                            {!! Form::radio('survey_type','2','',['class'=>'form-group']) !!}
                            <label>Peer Evaluation Survey</label><br><br>

                            <div hidden class="form-group{!! $errors->has('numberOfEvaluators') ? ' has-error':'' !!} has-feedback">
                                      <label><h3>Number Of Evaluators:</h3></label>
                                          <p>Provide the number of peer evaluators for your survey</p>
                                       @if($errors->has('numberOfEvaluators'))
                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('numberOfEvaluators') !!}</label>
                                       @endif
                                      {!! Form::text('numberOfEvaluators',old('numberOfEvaluators'),['class'=>'form-control','placeholder'=>'Number Of Evaluators']) !!}
                                              </div><br>


              <div class="form-group">
                                <label><h3>Select a group for this survey*:</h3></label>
                                <p>Please select a group. The special users of the company are the administrators for the user groups.</p>
                               {!! Form::select('group',$groups,null,['class'=>'form-control']) !!}
                               <?php foreach($groups as $key => $value) {
                                 echo "Group '".$value."' has ".count(\App\User_In_Group::where('user_group_id',$key)->get())." members.\n";
                               } ?>
                            </div>

                            <p class="panel-title">
                                <a data-toggle="collapse" href="#collapse1"><i class="fa fa-sort-desc" aria-hidden="true"></i>
                                    <label>View indicators</label></a>
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

                           <div class="form-group{!! $errors->has('editor2') ? ' has-error':'' !!} has-feedback">
                            <label><h3>Survey completion text*:</h3></label>
                            <p>Survey Completion text is the text that appears after a participant has completed the survey. You could mention some thank you text for taking the survey. </p>
                                @if($errors->has('editor2'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('editor2') !!}</label>
                                @endif
                                {!! Form::textarea('editor2',old('editor2'),['id'=>'editor2','rows'=>'10','cols'=>'80']) !!}</div><br>


                            <button type="submit" class="btn btn-info btn-flat" > Create Survey</button>

                        </div>
                    </div>
                </div>
            </div>

           {!! Form::close() !!}
    </div>
    </div>
@stop
