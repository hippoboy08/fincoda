@extends('master')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12 col-md-offset-0">

            @include('message.fail')

            <div class="box-header with-border">
                <h2 class="box-title"><b>Take survey.</b></h2>
                <p><i>Below is the information of the survey you are going to take.
                     </i></p>
            </div>
            <div class="box box-primary">
                <div class="box-body">
					{{App::setLocale(Session::get('language'))}}
                    <h2>{!! $survey->title !!}</h2>
                    <p>Created by : {!! \App\User::find($survey->user_id)->name !!}</p>
                    <p>Open duration : {!! $survey->start_time.' - '.$survey->end_time !!}</p>
                    <p> <h4><b>Survey Description</b></h4></label>{!! $survey->description !!}</p>

                    <h4><b>Marking your indicator:</b></h4>
                    <p> The marking of the indicators is from value 1 to 5.
                    If you prefer not to respond to a particular indicator, please mark 0. All the indicators should be marked.
                    </p>
                    <p><b>0=Not observed, 1=Very poor, 2=Need to improve, 3=Pass, 4=Good, 5=Excellent</b></p>


                        @role('basic')
                    {!! Form::open(['method'=>'POST', 'action'=>'basic\SurveyController@store']) !!}
                        @endrole
                      @role('special')
                    {!! Form::open(['method'=>'POST', 'action'=>'special\CompanySurveyController@store']) !!}
                        @endrole
                        {!! Form::hidden('survey_id',$survey->id) !!}
						@if(!empty($user_id))
							{!! Form::hidden('user_id',$user_id) !!}
						@endif
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Survey Indicators</th>
                                <th>0</th
                                ><th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($indicators as $indicator)

                                <tr>
                                    <td>{!! $indicator->id !!}</td>
									<td>{{Lang::get('indicators.'.$indicator->id,array(),App::getLocale())}}</td>
                                    <td>{!! Form::radio('radio['.$indicator->id.']',0) !!}</td>
                                    <td>{!! Form::radio('radio['.$indicator->id.']',1) !!}</td>
                                    <td>{!! Form::radio('radio['.$indicator->id.']',2) !!}</td>
                                    <td>{!! Form::radio('radio['.$indicator->id.']',3) !!}</td>
                                    <td>{!! Form::radio('radio['.$indicator->id.']',4) !!}</td>
                                    <td>{!! Form::radio('radio['.$indicator->id.']',5) !!}</td>

                                </tr>

                                @endforeach
                            <tfoot>
                            <tr>
                                <th>S.No</th>
                                <th>Survey Indicator</th>
                                <th>0</th
                                ><th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                            </tr>
                            </tfoot>
                            </tbody>
                            </table>
                    <button type="submit" class="btn btn-info btn-flat" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Submit Survey</button>
                    {!! Form::close() !!}

                    </div>
            </div>
        </div>
    </div>

    @stop