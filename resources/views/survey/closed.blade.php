<div class="panel-body">
    <h3>Closed surveys</h3>
    <p>The surveys that have been closed already.</p>
    <table id="example3" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Title</th>
            <th>Survey Type</th>
            <th>Open Date</th>
            <th>Close Date</th>
            <th>Owner</th>
            <th>Total participants</th>

        </tr>
        </thead>
        <tbody>
        @foreach($closed as $closed)
            <tr>
                @role('admin')
                <td><a href="{!! url('admin/survey/'.$closed->id) !!}">{!! $closed->title !!}</a></td>
                @endrole

                @role('basic')
                @if(Auth::User()->participate_survey->where('survey_id',$closed->id)->first()->completed==0)
                <td>{!! $closed->title !!}</td>
               @else
                    <td><a href="{!! url('basic/survey/'.$closed->id) !!}">{!! $closed->title !!}</a></td>
                    @endif

                @endrole

                @role('special')

                @if(Route::current()->getName()=='special.groupsurvey.index')
                    <td><a href="{!! url('special/survey/'.$closed->id) !!}">{!! $closed->title !!}</a></td>
                @elseif(Route::getCurrentRoute()->getPath()=='special/groupsurveyresult')
                    <td><a href="{!! url('special/survey/'.$closed->id) !!}">{!! $closed->title !!}</a></td>
                @else


                    @if(Auth::User()->participate_survey->where('survey_id',$closed->id)->first()->completed==0)
                        <td>{!! $closed->title !!}</td>
                    @else
                        <td><a href="{!! url('special/survey/'.$closed->id) !!}">{!! $closed->title !!}</a></td>
                    @endif


                @endif

                @endrole

                <td>{!! \App\Survey_Type::find($closed->type_id)->name !!}</td>
                <td>{!! $closed->start_time !!}</td>
                <td>{!! $closed->end_time !!}</td>
                <td>{!! \App\User::find($closed->user_id)->name !!}</td>
                <td>{!! count(\App\Participant::where('survey_id',$closed->id)->get()) !!}</td>
            </tr>
        @endforeach




        </tbody>

    </table>
</div>
