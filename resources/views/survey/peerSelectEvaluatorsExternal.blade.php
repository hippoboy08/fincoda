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
              <li class="active"><a data-toggle="tab" href="#tab3">People you are evaluating</a></li>
            </ul>

            <div class="tab-content">
				<div id="tab3" class="tab-pane fade in active">
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
                          @role('external')
                          <td><a href="{!! url('external/survey/evaluateUser/'.$survey->id).'/'.$user->id !!}">{!! $user->name !!}</a></td>
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
