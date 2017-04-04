<div class="panel-body">
    <h3>Open surveys</h3>
    <p>The surveys that have been open to the participants but not yet completed.</p>
    <table id="example2" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Title</th>
			<th>Edit</th>
            <th>Delete</th>
            <th>Survey Type</th>
            <th>Open Date</th>
            <th>Close Date</th>
            <th>Owner</th>
            @role('admin')
            <th>Total participants</th>
            @endrole

            @role('basic')
            <th>Survey Status</th>
            @endrole
			
			@role('external')
            <th>Survey Status</th>
            @endrole

            @role('special')
            @if(Route::current()->getName()=='special.groupsurvey.index')
                <th>Total participants</th>
            @else
            <th>Survey Status</th>
            @endif
            @endrole
        </tr>
        </thead>
        <tbody>
@foreach($open as $open)
    <tr>
        @role('admin')
        <td><a href="{!! url('admin/survey/'.$open->id) !!}">{!! $open->title !!}</a></td>
        <td><a class="confirmation" href="{!! url('admin/survey/edit/'.$open->id) !!}">edit</a><br/><a href="{!! url('admin/companySurvey/'.$open->id) !!}">participate</a></td>
		<td><a class="confirmation" href="{!! url('admin/survey/deleteSurvey/'.$open->id) !!}" >delete</a>

    </td>
        @endrole
        @role('basic')
			@if($open->completed=='0')
			<td><a  href="{!! url('basic/survey/'.$open->id) !!}">{!! $open->title !!}</a></td>
			<td> </td>
			<td> </td>
			@endif
			@if($open->completed=='1')
			<td>{!! $open->title !!}</td>
			<td> </td>
			<td> </td>
			@endif
			@if($open->completed=='3')
			<td><a href="{!! url('basic/survey/'.$open->id) !!}">{!! $open->title !!}</a></td>
			<td> </td>
			<td> </td>
			@endif
			@if($open->completed=='5')
			<td><a href="{!! url('basic/survey/'.$open->id) !!}">{!! $open->title !!}</a></td>
			<td> </td>
			<td> </td>
			@endif
		@endrole
		
		@role('external')
			@if($open->completed=='0')
			<td><a  href="{!! url('external/survey/'.$open->id) !!}">{!! $open->title !!}</a></td>
			<td> </td>
			<td> </td>
			@endif
			@if($open->completed=='1')
			<td>{!! $open->title !!}</td>
			<td> </td>
			<td> </td>
			@endif
			@if($open->completed=='3')
			<td><a href="{!! url('external/survey/'.$open->id) !!}">{!! $open->title !!}</a></td>
			<td> </td>
			<td> </td>
			@endif
			@if($open->completed=='5')
			<td><a href="{!! url('external/survey/'.$open->id) !!}">{!! $open->title !!}</a></td>
			<td> </td>
			<td> </td>
			@endif
		@endrole

        @role('special')
        @if(Route::current()->getName()=='special.groupsurvey.index')
            <td><a href="{!! url('special/groupsurvey/'.$open->id) !!}">{!! $open->title !!}</a></td>
			<td><a class="confirmation" href="{!! url('special/groupsurvey/edit/'.$open->id) !!}">edit</a><br/><a href="{!! url('special/groupSurvey/'.$open->id) !!}">participate</a</td>
			<td><a class="confirmation" href="{!! url('special/groupsurvey/deleteSurvey/'.$open->id) !!}">delete</a></td>
        @else
        @if($open->completed=='0'||$open->completed=='3'||$open->completed=='5')
            <td><a href="{!! url('special/survey/'.$open->id) !!}">{!! $open->title !!}</a></td>
			<td> </td>
			<td> </td>
        @else
            <td>{!! $open->title !!}</td>
			<td> </td>
			<td> </td>
        @endif
        @endif

        @endrole

        <td>{!! \App\Survey_Type::find($open->type_id)->name !!}</td>
        <td>{!! $open->start_time !!}</td>
        <td>{!! $open->end_time !!}</td>
        <td>{!! \App\User::find($open->user_id)->name !!}</td>
        @role('admin')
        <td>{!! count(\App\Participant::where('survey_id',$open->id)->get()) !!}</td>
        @endrole


        @role('special')
        @if(Route::current()->getName()=='special.groupsurvey.index')
            <td>{!! count(\App\Participant::where('survey_id',$open->id)->get()) !!}</td>
        @else
        @if($open->completed=='0')
			<td><span class="label label-danger">Not completed</span></td>
		@endif
		@if($open->completed=='1')
			<td><span class="label label-success">Completed</span></td>
		@endif
		@if($open->completed=='3')
			<td><span class="label label-success">In progress</span></td>
		@endif
		@if($open->completed=='5')
			<td><span class="label label-success">Completed</span></td>
		@endif
        @endif
        @endrole
        @role('basic')
        @if($open->completed=='0')
			<td><span class="label label-danger">Not completed</span></td>
		@endif
		@if($open->completed=='1')
			<td><span class="label label-success">Completed</span></td>
		@endif
		@if($open->completed=='3')
			<td><span class="label label-success">In progress</span></td>
		@endif
		@if($open->completed=='5')
			<td><span class="label label-success">Completed</span></td>
		@endif
        @endrole
		
		@role('external')
        @if($open->completed=='0')
			<td><span class="label label-danger">Not completed</span></td>
		@endif
		@if($open->completed=='1')
			<td><span class="label label-success">Completed</span></td>
		@endif
		@if($open->completed=='3')
			<td><span class="label label-success">In progress</span></td>
		@endif
		@if($open->completed=='5')
			<td><span class="label label-success">Completed</span></td>
		@endif
        @endrole
		
    </tr>
@endforeach
        </tbody>
    </table>
</div>