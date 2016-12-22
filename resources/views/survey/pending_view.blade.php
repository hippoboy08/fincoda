@extends('master')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12 col-md-offset-0">
            <!-- general form elements -->

            {!! Form::open(['method'=>'POST','action'=>'admin\SurveyController@store']) !!}
            <div class="box-header with-border">
                <h3 class="box-title"><b>Pending survey.</b></h3>
                <p><i>Below is the information of the pending survey you requested.</i></p>
            </div>


            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <label><h3>Survey Title :</h3> </label><p><i class="fa fa-hand-o-right" aria-hidden="true"></i> {!! $survey->title !!}</p>
                            <label><h3>Survey description :</h3></label><p> {!! $survey->description !!}</p>
                            <label><h3>Survey Type :</h3> </label><p><i class="fa fa-hand-o-right" aria-hidden="true"></i> {!! \App\Survey_Type::find($survey->type_id)->name !!}</p>
                            <label><h3>Created by :</h3></label><p><i class="fa fa-hand-o-right" aria-hidden="true"></i> {!! \App\User::find($survey->user_id)->name !!}</p>
                            <label><h3>Created at :</h3></label><p><i class="fa fa-hand-o-right" aria-hidden="true"></i>{!! $survey->created_at !!}</p>
                            <label><h3>Open date and time range :</h3></label><p><i class="fa fa-hand-o-right" aria-hidden="true"></i> {!! $survey->start_time .' TO '.$survey->end_time !!}</p>

                        <br><p class="panel-title">
                            <a data-toggle="collapse" href="#collapse1"><i class="fa fa-sort-desc" aria-hidden="true"></i>
                                <label>Indicators appearing in the survey</label></a>
                        <p>There are 24 survey indicators. These indicators are fixed and can not be modified or edited.</p>
                        </p>


                        <div id="collapse1" class="panel-collapse collapse">
                            <div class="panel-body">
                                @foreach($indicators as $indicator)
                                    <p>{!! $indicator !!}</p>
                                @endforeach

                            </div>

                        </div><br>

                            <p class="panel-title">
                                <a data-toggle="collapse" href="#collapse2"><i class="fa fa-sort-desc" aria-hidden="true"></i>
                                    <label>Participants of the survey</label></a>
                            <p>By default, all the basic and special users of your company will be invited to participate in the survey. Click above to see the list of participants.</p>
                            </p>


                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Email Address</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($participants as $participant)
                                            <tr>
                                                <td>{!! \App\User::find($participant->user_id)->name !!}</td>
                                                <td>{!! \App\User::find($participant->user_id)->email !!}</td>
                                            </tr>
                                            <p></p>
                                        @endforeach

                                        </tbody>
                                    </table>


                                </div>

                            </div>
                            <button type="submit" class="btn btn-info btn-flat" disabled="disabled"><i class="fa fa-trash-o" aria-hidden="true"></i> Update Survey</button>
                            <button type="submit" class="btn btn-info btn-flat" disabled="disabled"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete survey</button>


                        </div>


    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    @stop