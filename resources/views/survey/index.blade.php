@extends('master')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12 col-md-offset-0">

            @include('message.success')

            <div class="box-header with-border">
                <h3 class="box-title"><b>Completed Survey.</b></h3>
                <p><i>Below is the list of all the completed surveys of your company.
                       Click to view the individual survey result.</i></p>
            </div>
            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel panel-default">
                        @include('survey.closed')
                    </div>
                </div>
             </div>
          </div>
    </div>
    @stop