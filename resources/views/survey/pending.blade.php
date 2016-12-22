<div class="panel-body">
    <h3>Pending surveys</h3>
    <p>The surveys that have not yet been open to the participants</p>
<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
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
    @foreach($pending as $pending)
        <tr>
            @role('admin')
            <td><a href="{!! url('admin/survey/'.$pending->id) !!}">{!! $pending->title !!}</a></td>
			<td><a class="confirmation" href="{!! url('admin/survey/edit/'.$pending->id) !!}">edit</a></td>
			<td><a class="confirmation" href="{!! url('admin/survey/deleteSurvey/'.$pending->id) !!}">delete</a></td>
            @endrole

            @role('special')
				@if(Route::current()->getName()=='special.groupsurvey.index')
                    <td><a href="{!! url('special/groupsurvey/'.$pending->id) !!}">{!! $pending->title !!}</a></td>
					<td><a class="confirmation" href="{!! url('special/groupsurvey/edit/'.$pending->id) !!}">edit</a></td>
					<td><a class="confirmation" href="{!! url('special/groupsurvey/deleteSurvey/'.$pending->id) !!}">delete</a></td>
                @elseif(Route::getCurrentRoute()->getPath()=='special/groupsurveyresult')
                    <td><a href="{!! url('special/groupsurvey/'.$pending->id) !!}">{!! $pending->title !!}</a></td>
					<td> </td>
					<td> </td>
				@endif
            @endrole

            <td>{!! \App\Survey_Type::find($pending->type_id)->name !!}</td>
            <td>{!! $pending->start_time !!}</td>
            <td>{!! $pending->end_time !!}</td>
            <td>{!! \App\User::find($pending->user_id)->name !!}</td>
            <td>{!! count(\App\Participant::where('survey_id',$pending->id)->get()) !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>
    </div>