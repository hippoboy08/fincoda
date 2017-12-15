@extends('master')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12 col-md-offset-0">

            @include('message.success')

            <div class="box-header with-border">
                <h3 class="box-title"><b>Completed survey.</b></h3>
                <p><i>Below is a list of your organization’s completed surveys. Click to view the individual survey results.</i></p>
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