<style type="text/css">
  table thead tr th
  {text-align: center;}
</style>
<div class="panel-body">
    <h3>Closed surveys</h3>
    <!-- <p>The surveys that have been closed already.</p> -->
    <table id="example3" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Show<input checked type="checkbox" name="showAll" value="Show All"></th>
            <th>Title</th>
			<th>Edit</th>
            <th>Delete</th>
            <th>Survey Type</th>
            <th>Open Date</th>
            <th>Close Date</th>
            <th>Owner</th>
            <th>Total participants</th>
        </tr>
        </thead>
        <tbody>
        @foreach($closed as $closed)
            <tr name="closedSurvey">
                @role('admin')
                <td><input type="checkbox" name="hide" value=""></td>
                <td><a href="{!! url('admin/survey/'.$closed->id) !!}">{!! $closed->title !!}</a></td>
				<td><a class="confirmation" href="{!! url('admin/survey/edit/'.$closed->id) !!}">edit</a></td>
				<td><a class="confirmation" href="{!! url('admin/survey/deleteSurvey/'.$closed->id) !!}">delete</a></td>
				@endrole

                @role('basic')
                <td><input type="checkbox" name="hide" value=""></td>
                @if(Auth::User()->participate_survey->where('survey_id',$closed->id)->first()->completed==0)
					<td>{!! $closed->title !!}</td>
					<td> </td>
					<td> </td>
				@endif
				@if(Auth::User()->participate_survey->where('survey_id',$closed->id)->first()->completed==1)
                    <td><a href="{!! url('basic/survey/'.$closed->id) !!}">{!! $closed->title !!}</a></td>
					<td> </td>
					<td> </td>
                @endif
				@if(Auth::User()->participate_survey->where('survey_id',$closed->id)->first()->completed==3)
                    <td><a href="{!! url('basic/survey/'.$closed->id) !!}">{!! $closed->title !!}</a></td>
					<td> </td>
					<td> </td>
                @endif
				@if(Auth::User()->participate_survey->where('survey_id',$closed->id)->first()->completed==5)
                    <td><a href="{!! url('basic/survey/'.$closed->id) !!}">{!! $closed->title !!}</a></td>
					<td> </td>
					<td> </td>
                @endif
                @endrole

                @role('special')
                <td><input type="checkbox" name="hide" value=""></td>
                @if(Route::current()->getName()=='special.groupsurvey.index')
                    <td><a href="{!! url('special/groupsurvey/'.$closed->id) !!}">{!! $closed->title !!}</a></td>
					<td><a class="confirmation" href="{!! url('special/groupsurvey/edit/'.$closed->id) !!}">edit</a></td>
					<td><a class="confirmation" href="{!! url('special/groupsurvey/deleteSurvey/'.$closed->id) !!}">delete</a></td>
                @elseif(Route::getCurrentRoute()->getPath()=='special/groupsurveyresult')
                    <td><a href="{!! url('special/groupsurvey/'.$closed->id) !!}">{!! $closed->title !!}</a></td>
					<td> </td>
					<td> </td>
				@else
                    @if(Auth::User()->participate_survey->where('survey_id',$closed->id)->first()->completed==0)
                        <td>{!! $closed->title !!}</td>
						<td> </td>
						<td> </td>
                    @endif
					@if(Auth::User()->participate_survey->where('survey_id',$closed->id)->first()->completed==1)
                        <td><a href="{!! url('special/survey/'.$closed->id) !!}">{!! $closed->title !!}</a></td>
						<td> </td>
						<td> </td>
                    @endif
					@if(Auth::User()->participate_survey->where('survey_id',$closed->id)->first()->completed==3)
                        <td><a href="{!! url('special/survey/'.$closed->id) !!}">{!! $closed->title !!}</a></td>
						<td> </td>
						<td> </td>
                    @endif
					@if(Auth::User()->participate_survey->where('survey_id',$closed->id)->first()->completed==5)
                        <td><a href="{!! url('special/survey/'.$closed->id) !!}">{!! $closed->title !!}</a></td>
						<td> </td>
						<td> </td>
                    @endif
                @endif
                @endrole

                <td>{!! \App\Survey_Type::find($closed->type_id)->name !!}</td>
                <td>{!! $closed->start_time !!}</td>
                <td>{!! $closed->end_time !!}</td>
                <td>{!! \App\User::find($closed->user_id)->name !!}</td>
                <td>{!! count(\App\Survey::find($closed->id)->participants()->where('completed',1)->get()) + count(\App\Survey::find($closed->id)->participants()->where('completed',3)->get()) + count(\App\Survey::find($closed->id)->participants()->where('completed',5)->get()) !!} / {!! count(\App\Participant::where('survey_id',$closed->id)->get()) !!}</td>
            </tr>
        @endforeach

        </tbody>

    </table>
</div>
