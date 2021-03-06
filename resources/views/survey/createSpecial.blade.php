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
                <p><i>. Please provide the required information below to create a new survey.</i></p>
            </div>

            @include('message.fail')
            @include('message.errors_head')
            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-group{!! $errors->has('title') ? ' has-error':'' !!} has-feedback">
                        <label><h3>Survey title*:</h3></label>
                            <p>Provide a name/title for your survey</p>
                         @if($errors->has('title'))
                              <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('title') !!}</label>
                         @endif
                        {!! Form::text('title',old('title'),['class'=>'form-control','placeholder'=>'Title of your Survey']) !!}
                                </div><br>
                                <!-- <label><h3>Survey Language*:</h3></label>
                                <div class="form-group" >
                      							<h5 class="select-users">
                                      <label for="languageId"></label>
                                        <select id="languageId" class="selectpicker show-tick" data-style = 'btn-info' data-width = 'auto'>
                                            <option value="">Please select required language</option>
                                            <option value="fi" data-content='<span class="flag-icon flag-icon-fi"></span> Finnish'></option>
                                            <option value="en" data-content='<span class="flag-icon flag-icon-us"></span> English'></option>
                                            <option value="de" data-content='<span class="flag-icon flag-icon-de"></span> German'></option>
                                            <option value="nl" data-content='<span class="flag-icon flag-icon-nl"></span> Dutch'></option>
                                            <option value="sp" data-content='<span class="flag-icon flag-icon-es"></span> Spanish'></option>
                                        </select>
                      							</h5>

                                    <script>
                      								  $(document).ready(function(){
                      								  $('#languageId').change(function(){
                      									  //alert('success');
                      								  if($(this).val()==""){
                      								  return;
                      								  }
                      								  else{
                      										   $.ajaxSetup({
                      											 headers:{
                      											   'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                      											 }
                      										   });
                      										   $.ajax({
                      											 method: 'POST',
                      											 url: window.location.protocol+"//"+window.location.host+"/"+"fincoda-new-folder/fincoda-phase2-complete/public/special/language",
                      											 dataType: 'json',
                      											 data: {'languageId':$(this).val()},
                      											 success: function(data){
                      												 //alert(data.stri);
                      											 window.location.replace(window.location);
                      											},
                      										  error: function(result){
                      												var errors = result.responseJSON;
                      												console.log(result);
                      												console.log(errors);
                      										  }

                      									   });
                      									   }
                      									 });
                      								   });
                      							</script>
                      					</div> -->

                            <div class="form-group{!! $errors->has('editor1') ? ' has-error':'' !!} has-feedback">
                                <label><h3>Survey description*:</h3></label>
                                <p>This will appear on users’ dashboards once they start taking the survey.</p>
                                @if($errors->has('editor1'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('editor1') !!}</label>
                                @endif
                                {!! Form::textarea('editor1',old('editor1'),['id'=>'editor1','rows'=>'10','cols'=>'80']) !!}
                            </div><br>


                            <div class="form-group{!! $errors->has('date') ? ' has-error':'' !!} has-feedback">

							<div class="form-group{!! $errors->has('date') ? ' has-error':'' !!} has-feedback">

                            <label><h3>Survey start and end times:*:</h3></label>
                            <br>
                            <label><b>The system is using Finnish time zone GTM+2.</b></label>
                            <p>Please choose the start and end dates and times for the survey.</p>
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
                            <label><h3>Select a survey type*:</h3></label><br>
                            {!! Form::radio('survey_type','1',true,['class'=>'form-group']) !!}
                            <label>Self-evaluation Survey</label><br>
                            {!! Form::radio('survey_type','2','',['class'=>'form-group']) !!}
                            <label>Peer-evaluation Survey</label><br><br>

                            


              <div class="form-group">
                                <label><h3>Select a group for this survey*:</h3></label>
                                <p>Please select a group. The special users of the organization are the administrators for the user groups.</p>
                               <!-- {!! Form::select('group',$groups,null,['class'=>'form-control']) !!} -->

                               <?php 
                                    // foreach($groups as $key => $value) {
                                    //     echo "Group '".$value."' has ".count(\App\User_In_Group::where('user_group_id',$key)->get())." members.\n";
                                    // }
                                    $groupList = array();
                                    $group;
                                    foreach($groups as $key=>$value) {
                                        
                                        $group['numOfMem'] = count(\App\User_In_Group::where('user_group_id',$key)->get());
                                        $group['groupId']= $key;
                                        $group['groupName']= $value;
                                        $groupList[] = $group;
                                    }

                                    
                               ?>
                               <select id="groupMemberAmountList" name = 'group' class = 'form-control'>
                                    @foreach ($groupList as $group)
                                    <option value=" {{ $group['groupId'] }}" data-amount = "{{ $group['numOfMem'] }}">{{ $group['groupName'] }} - {{ $group['numOfMem'] }} members</option>
                                    @endforeach
                                </select>

                                <div hidden class="form-group{!! $errors->has('numberOfEvaluators') ? ' has-error':'' !!} has-feedback">
                                <label><h3>Number of evaluators:</h3></label>
                                    <p>Provide the number of peer evaluators for your survey</p>
                                @if($errors->has('numberOfEvaluators'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('numberOfEvaluators') !!}</label>
                                @endif
                                {!! Form::text('numberOfEvaluators',old('numberOfEvaluators'),['class'=>'form-control','placeholder'=>'Number Of Evaluators']) !!}
                                <div class="modal fade" id="evaluatorValidationError" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h3 class="modal-title"><b>Number of evaluators is not valid!!!</b></h3>
                                        </div>
                                        <!-- <div class="modal-body">
                                            <div class="form-group">
                                            <label for="email">There is already 5 evaluators !!!</label>
                                            </div>
                                        </div> -->
                                        <!-- <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            </div>

                            <p class="panel-title">
                                <a data-toggle="collapse" href="#collapse1"><i class="fa fa-sort-desc" aria-hidden="true"></i>
                                    <label>Survey indicators</label></a>
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
                            <p>This is the text that users will see once they have completed the survey.</p>
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
