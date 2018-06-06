@extends('register.index')
@section('content')
        <!-- Main content -->
<div class="row registration-form">
    <!-- left column -->
    <div class="col-md-5 col-md-offset-4">
        <!-- general form elements -->

        <div class="box-header with-border">
            <h3 class="box-title"><b>Provide your organization code</b></h3>
            <p><i></i></p>
        </div><!-- /.box-header -->

        {!! Form::open(['role'=>'form','method'=>'POST']) !!}

        <div class="box box-primary">
            <div class="box-body">
                @include('message.fail')
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group{!! $errors->has('company_code') ? ' has-error':'' !!} has-feedback">
                        <label>Organisation Code*</label><br>
                            @if($errors->has('company_code'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('company_code') !!}</label>
                            @endif
                        {!! Form::text('company_code','',['id'=>'com-code-reg','class'=>'form-control','placeholder'=>'Organisation Code']) !!}

                        </div>
                        </div>
                    </div>
                </div>
            </div>


        <div class="box-header with-border">
            <h3 class="box-title"><b>Provide the detailed information below</b> </h3>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group{!! $errors->has('name') ? ' has-error':'' !!} has-feedback">
                            <label>Full Name*</label><br>
                            @if($errors->has('name'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('name') !!}</label>
                            @endif
                            {!! Form::text('name',old('name'),['id'=>'name-reg','class'=>'form-control','placeholder'=>'Full name']) !!}
                            <span class="form-control-feedback"><i class="fa fa-user" aria-hidden="true"></i></span>
                            </div>

                        <div class="form-group{!! $errors->has('name') ? ' has-error':'' !!} has-feedback">
                            <label>Email Address*</label><br>
                            @if($errors->has('company_code'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('email') !!}</label>
                            @endif
                            {!! Form::text('email',old('email'),['id'=>'email-reg','class'=>'form-control','placeholder'=>'Email Address']) !!}
                            <span class="form-control-feedback"><i class="fa fa-lock" aria-hidden="true"></i></span>
                        </div>

                        <div class="form-group{!! $errors->has('password') ? ' has-error':'' !!} has-feedback">
                            <label>Password*<i>( > 6 characters contains at least one special char, capital character, and numeric value )</i></label><br>
                            @if($errors->has('company_code'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('password') !!}</label>
                            @endif
                            {!! Form::password('password',['id'=>'user-pass-reg','class'=>'form-control','placeholder'=>'example: Password123*!!!']) !!}
                            <span class="form-control-feedback"><i class="fa fa-eye" aria-hidden="true"></i></span>
                        </div>

                        <div class="form-group{!! $errors->has('password') ? ' has-error':'' !!} has-feedback">
                            <label>Confirm Password*</label><br>
                            @if($errors->has('password'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('password') !!}</label>
                            @endif
                            {!! Form::password('password_confirmation',['id'=>'user-repass','class'=>'form-control','placeholder'=>'Re-type Password']) !!}
                            <span class="form-control-feedback"><i class="fa fa-eye" aria-hidden="true"></i></span>
                        </div>

                        <!--<div class="form-group{!! $errors->has('g-recaptcha-response') ? ' has-error':'' !!} has-feedback">
                            <label>Please check the box below*<i>(Spam filtration)</i></label><br>
                            @if($errors->has('g-recaptcha-response'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('g-recaptcha-response') !!}.</label>
                            @endif
                            {!! Recaptcha::render() !!}
                        </div>-->


                        <div class="form-group col-md-offset-5">
                            {!! Form::submit('Register',['id'=>'user-reg','class'=>'btn btn-primary']) !!}
                        </div>

                        </div>
                    </div>
                </div>
            </div>

        {!! Form::close() !!}


        </div>


    </div>

@stop
