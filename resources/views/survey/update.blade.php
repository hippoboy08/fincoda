@extends('master')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12 col-md-offset-0">
            <!-- general form elements -->

            {!! Form::open(['method'=>'PUT']) !!}
            <div class="box-header with-border">
                <h3 class="box-title"><b>Pending survey.</b></h3>
                <p><i>Below is the information about the pending survey you requested.
                        You can make changes or abort it before it is open to the participants.</i></p>
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
                                {!! Form::text('title',$survey->title,['class'=>'form-control','placeholder'=>'Title of your Survey']) !!}
                            </div><br>

                            <div class="form-group{!! $errors->has('editor1') ? ' has-error':'' !!} has-feedback">
                                <label><h3>Survey Description*:</h3></label>
                                <p>Please give a description of the survey. This will appear to your survey's participant page once the participants starts taking the survey. </p>
                                @if($errors->has('editor1'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('editor1') !!}</label>
                                @endif
                                {!! Form::textarea('editor1',$survey->description,['id'=>'editor1','rows'=>'10','cols'=>'80']) !!}
                            </div><br>

                            <div class="form-group{!! $errors->has('date') ? ' has-error':'' !!} has-feedback">
                                <label><h3>Open data ane time range*:</h3></label>
                                <p>Please choose the date and time range of the start and end of the survey.</p>
                                @if($errors->has('date'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('date') !!}</label>
                                @endif
                                <div class="form-group">

                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        {!! Form::text('date', date('m/d/Y h:i A', strtotime($survey->start_time )).' - '.date('m/d/Y h:i A', strtotime($survey->end_time )),['class'=>'form-control pull-left','id'=>'reservationtime']) !!}

                                    </div><!-- /.input group -->
                                </div></div>


                            <br>
                            <label><h3>Select a Survey Type*:</h3></label><br>
                            {!! Form::radio('survey_type','1',$survey->type_id==1,['class'=>'form-group']) !!}
                            <label>Self Evaluation Survey</label><br>
                            {!! Form::radio('survey_type','2',$survey->type_id==2,['class'=>'form-group']) !!}
                            <label>Peer Evaluation Survey</label><br><br>



                            <p class="panel-title">
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
                                                <td>{!! \App\User::find($participant->user_id)->name!!}</td>
                                                <td>{!! \App\User::find($participant->user_id)->email !!}</td>
                                            </tr>
                                            <p></p>
                                        @endforeach

                                        </tbody>
                                    </table>


                                </div>

                            </div>
                            <br>

                            <div class="form-group{!! $errors->has('editor2') ? ' has-error':'' !!} has-feedback">
                                <label><h3>Survey completion text*:</h3></label>
                                <p>Survey Completion text is the text that appears after a participant has completed the survey. You could mention some thank you text for taking the survey. </p>
                                @if($errors->has('editor2'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('editor2') !!}</label>
                                @endif
                                {!! Form::textarea('editor2',$survey->end_message,['id'=>'editor2','rows'=>'10','cols'=>'80']) !!}</div><br>

                            <button type="submit" class="btn btn-info btn-flat" > Update the survey</button>
                            <button  class="btn btn-info btn-flat" disabled="disabled"> Delete the survey</button>

                        </div>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop