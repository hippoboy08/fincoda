@extends('master')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12 col-md-offset-0">

            @include('message.success')

            <div class="box-header with-border">
                <h3 class="box-title"><b>Completed and/or Closed surveys.</b></h3>
                <p><i>Below is the list of all the completed and the closed surveys.
                        Click to view the individual survey result.</i></p>
            </div>
            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel panel-default">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Survey Title</th>
                                <th>Survey Type</th>
                                <th>Open date</th>
                                <th>Close date</th>
                                <th>Owner</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($completed as $completed)
                            <tr>
								@role('basic')
									@if($completed->type_id=='1')
										<td><a href="{!! url('basic/survey/'.$completed->id) !!}"> {!! $completed->title !!}</a></td>
									@else
										<td><a href="{!! url('basic/survey/viewPeerResults/'.$completed->id).'/'.Auth::User()->id !!}">{!! $completed->title !!}</a></td>
									@endif
								@endrole

								@role('special')
									@if($completed->type_id=='1')
										<td><a href="{!! url('special/survey/'.$completed->id) !!}"> {!! $completed->title !!}</a></td>
									@else
										<td><a href="{!! url('special/survey/viewPeerResults/'.$completed->id).'/'.Auth::User()->id !!}">{!! $completed->title !!}</a></td>
									@endif
								@endrole

                                <td>{!! \App\Survey_Type::find($completed->type_id)->name !!}</td>
                                <td>{!! $completed->start_time !!}</td>
                                <td>{!! $completed->end_time !!}</td>
                                <td>{!! \App\User::find($completed->user_id)->name !!}</td>
                                @if($completed->completed=='0')
                                    <td><span class="label label-danger">Not completed</span></td>
                                @else
                                    <td><span class="label label-success">Completed</span></td>
                                @endif

                            </tr>
                            @endforeach
                            @foreach($closed as $closed)
                                <tr>
								    @if($closed->completed=='0')
                                      <td> {!! $closed->title !!}</td>
                                    @else
                                        @role('basic')
											@if($closed->type_id=='1')
												<td><a href="{!! url('basic/survey/'.$closed->id) !!}"> {!! $closed->title !!}</a></td>
											@else
												<td><a href="{!! url('basic/survey/viewPeerResults/'.$closed->id).'/'.Auth::User()->id !!}">{!! $closed->title !!}</a></td>
											@endif
										@endrole

										@role('special')
											@if($closed->type_id=='1')
												<td><a href="{!! url('special/survey/'.$closed->id) !!}"> {!! $closed->title !!}</a></td>
											@else
												<td><a href="{!! url('special/survey/viewPeerResults/'.$closed->id).'/'.Auth::User()->id !!}">{!! $closed->title !!}</a></td>
											@endif
										@endrole
									@endif
                              
                                    <td>{!! \App\Survey_Type::find($closed->type_id)->name !!}</td>
                                   <td>{!! $closed->start_time !!}</td>
                                    <td>{!! $closed->end_time !!}</td>
                                    <td>{!! \App\User::find($closed->user_id)->name !!}</td>
                                    @if($closed->completed=='0')
                                        <td><span class="label label-danger">Not completed</span></td>
                                    @endif
									@if($closed->completed=='1')
                                        <td><span class="label label-success">Completed</span></td>
                                    @endif
									@if($closed->completed=='3')
                                        <td><span class="label label-success">In progress</span></td>
                                    @endif
									@if($closed->completed=='5')
										<td><span class="label label-success">Completed</span></td>
									@endif
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Survey Title</th>
                                <th>Survey Type</th>
                                <th>Open date</th>
                                <th>Close date</th>
                                <th>Owner</th>
                                <th>Status</th>
                            </tr>
                            </tfoot>
                        </table>
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

        });
    </script>

    @stop