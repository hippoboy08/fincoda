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

                    <p>Survey title : {!! $survey->title !!}</p>
                    <p>Created by : {!! \App\User::find($survey->user_id)->name !!}</p>
                    <p>Open between : {!! $survey->start_time.' - '.$survey->end_time !!}</p>
                    <p>Survey Description: {!! $survey->description !!}</p>
					
					<p class="panel-title">
                             <a data-toggle="collapse" href="#collapse2"><i class="fa fa-sort-desc" aria-hidden="true"></i>
                                    <label>View the people you have asked to evaluate you.</label></a>
                            </p>
							<div id="collapse2" class="panel-collapse collapse">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>User ID</th>
									<th>Full Name</th>
                                    <th>Email Address</th>
									<th>Completed</th>
                                </tr>
                                </thead>
                                <tbody>
								@if(count($evaluators)>0)
                                @foreach($evaluators as $user)
                                    <tr>
                                        <td>{!! $user->id !!}</td>
										<td>{!! $user->name !!}</td>
                                        <td>{!! $user->email !!}</td>
										@if(count($evaluatorsCompleted)>0)
											@foreach($evaluatorsCompleted as $users)
												@if($user->id == $users->id)
													<td>completed</td>
												@endif
											@endforeach
										@endif
										@if(count($evaluatorsNotCompleted)>0)
											@foreach($evaluatorsNotCompleted as $users)
												@if($user->id == $users->id)
													<td>not-completed</td>
												@endif
											@endforeach
										@endif
                                    </tr>
                                @endforeach
								@endif
                                </tbody>
                                </table>
                                </div>
							
							<a data-toggle="collapse" href="#collapse4"><i class="fa fa-sort-desc" aria-hidden="true"></i>
                                    <label>View the people who have asked you to evaluate them. The id link will be active if you have not yet evaluated them</label></a>
                            </p>
							<div id="collapse4" class="panel-collapse collapse">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>User ID</th>
									<th>Full Name</th>
                                    <th>Email Address</th>
                                </tr>
                                </thead>
                                <tbody>
								@if(count($evaluatees)>0)
                                @foreach($evaluatees as $user)
                                    <tr>
										@if(count($evaluated)>0)
											@foreach($evaluated as $users)
												@if($user->id == $users->id)
													<td>{!! $user->id !!}</td>
												@endif
											@endforeach
										@endif
										
										@if(count($evaluatedNot)>0)
											@foreach($evaluatedNot as $users)
												@if($user->id == $users->id)
													@role('special')
													<td><a href="{!! url('special/survey/evaluateUser/'.$survey->id).'/'.$user->id !!}">{!! $user->id !!}</a></td>
													@endrole
													@role('basic')
													<td><a href="{!! url('basic/survey/evaluateUser/'.$survey->id).'/'.$user->id !!}">{!! $user->id !!}</a></td>
													@endrole
												@endif
											@endforeach
										@endif
										<td>{!! $user->name !!}</td>
                                        <td>{!! $user->email !!}</td>
                                    </tr>
                                @endforeach
								@endif
                                </tbody>
                                </table>
                            </div>	
							
							
							<a data-toggle="collapse" href="#collapse5"><i class="fa fa-sort-desc" aria-hidden="true"></i>
                                    <label>View the people you have already evaluated.</label></a>
                            </p>
							<div id="collapse5" class="panel-collapse collapse">
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>User ID</th>
									<th>Full Name</th>
                                    <th>Email Address</th>
                                </tr>
                                </thead>
                                <tbody>
								@if(count($evaluated)>0)
                                @foreach($evaluated as $user)
                                    <tr>
										<td>{!! $user->id !!}</td>
										<td>{!! $user->name !!}</td>
                                        <td>{!! $user->email !!}</td>
                                    </tr>
                                @endforeach
								@endif
                                </tbody>
                                </table>
                            </div>	
							
							<a data-toggle="collapse" href="#collapse6"><i class="fa fa-sort-desc" aria-hidden="true"></i>
                                    <label>View the people who have completed evaluating you.</label></a>
                            </p>
							<div id="collapse6" class="panel-collapse collapse">
                            <table id="example4" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>User ID</th>
									<th>Full Name</th>
                                    <th>Email Address</th>
                                </tr>
                                </thead>
                                <tbody>
								@if(count($evaluatorsCompleted)>0)
                                @foreach($evaluatorsCompleted as $user)
                                    <tr>
										<td>{!! $user->id !!}</td>
										<td>{!! $user->name !!}</td>
                                        <td>{!! $user->email !!}</td>
                                    </tr>
                                @endforeach
								@endif
                                </tbody>
                                </table>
                            </div>	
							
							<a data-toggle="collapse" href="#collapse7"><i class="fa fa-sort-desc" aria-hidden="true"></i>
                                    <label>View the people who have not completed evaluating you.</label></a>
                            </p>
							<div id="collapse7" class="panel-collapse collapse">
                            <table id="example5" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>User ID</th>
									<th>Full Name</th>
                                    <th>Email Address</th>
                                </tr>
                                </thead>
                                <tbody>
								@if(count($evaluatorsNotCompleted)>0)
                                @foreach($evaluatorsNotCompleted as $user)
                                    <tr>
										<td>{!! $user->id !!}</td>
										<td>{!! $user->name !!}</td>
                                        <td>{!! $user->email !!}</td>
                                    </tr>
                                @endforeach
								@endif
                                </tbody>
                                </table>
                            </div>	
							
							
							<a data-toggle="collapse" href="#collapse8"><i class="fa fa-sort-desc" aria-hidden="true"></i>
                                    <label>View your results.</label></a>
                            </p>
							<div id="collapse8" class="panel-collapse collapse">
                            <table id="example6" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Results</th>
                                </tr>
                                </thead>
                                <tbody>
								    <tr>
										@role('special')
											@if(count($evaluatorsCompleted)>1)
												<td><a href="{!! url('special/survey/viewPeerResults/'.$survey->id).'/'.Auth::User()->id !!}">{!! Auth::User()->id !!}</a></td>
											@endif
										@endrole
										@role('basic')
											@if(count($evaluatorsCompleted)>1)
												<td><a href="{!! url('basic/survey/viewPeerResults/'.$survey->id).'/'.Auth::User()->id !!}">{!! Auth::User()->id !!}</a></td>
											@endif
										@endrole
                                    </tr>
                                </tbody>
                                </table>
                            </div>	
							
							
							@role('basic')
                    {!! Form::open(['method'=>'POST', 'action'=>'basic\SurveyController@inviteEvaluators']) !!}
                        @endrole
                      @role('special')
                    {!! Form::open(['method'=>'POST', 'action'=>'special\CompanySurveyController@inviteEvaluators']) !!}
                        @endrole
                        {!! Form::hidden('survey_id',$survey->id) !!}
						  <p class="panel-title">
                             <a data-toggle="collapse" href="#collapse3"><i class="fa fa-sort-desc" aria-hidden="true"></i>
                                    <label>Please select a maximum of five people you would like to evaluate you.</label></a>
                            </p>
							@if(Session::has('message'))
								<p>{{Session::get('message')}}<p>
							@endif
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="form-group{!! $errors->has('usersToEvaluate') ? ' has-error':'' !!} has-feedback">
                                @if($errors->has('usersToEvaluate'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('usersToEvaluate') !!}</label>
                                @endif
                            <table id="example7" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th><i class="fa fa-check-square-o" aria-hidden="true"></i> | User ID</th>
									<th>Full Name</th>
                                    <th>Email Address</th>
                                </tr>
                                </thead>
                                <tbody>
								@if(count($evaluators)<5)
                                @foreach($participantsNotSelectedAsEvaluators as $user)
                                    <tr>
                                        <td>{!! Form::checkbox('usersToEvaluate[]',$user->id) !!} | {!! $user->id !!}</td>
										<td>{!! $user->name !!}</td>
                                        <td>{!! $user->email !!}</td>
                                    </tr>
                                @endforeach
								@endif
                                </tbody>
                                </table>
                                </div>
                                </div>
                            </div>
						  
						<button type="submit" class="btn btn-info btn-flat" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Submit</button>
                    {!! Form::close() !!}
							
							
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