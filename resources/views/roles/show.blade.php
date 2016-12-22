@extends('master')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-8 col-md-offset-2">
            <!-- general form elements -->

            <div class="box-header with-border">
                <h3 class="box-title"><b>User's Role</b></h3>
                <p><i>Below is the current Role  of the user. You can make changes to it. Please make a note that changing the Role
                        affects the information accessible to the user.</i></p>
            </div>

            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel panel-default">
                            <div class="panel-body">
                            <h4>Current Role : {!! strtoupper($role->display_name) !!}</h4>
                                <hr>
                                <p><i>Please assign a new role to the user.</i></p>
                                {!! Form::open(['method'=>'PUT']) !!}

                               {!! Form::radio('role','1','',['class'=>'flat-red'])!!}
                                <label> ADMIN</label>
                                <br>
                                {!! Form::radio('role','2') !!} <label> SPECIAL</label>
                                <br>
                                {!! Form::radio('role','3') !!} <label> BASIC</label><br>


                                <button type="submit" class="btn btn-info btn-flat" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Update Role</button>

                                {!! Form::close() !!}
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <script>
      

    </script>


    @stop