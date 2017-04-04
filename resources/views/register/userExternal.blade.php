@extends('register.index')
@section('content')
        <!-- Main content -->
<div class="row registration-form">
    <!-- left column -->
    <div class="col-md-5 col-md-offset-4">
        <!-- general form elements -->

        <div class="box-header with-border">
            <h3 class="box-title"><b>Provide your Organisation Code</b></h3>
            <p><i></i></p>
        </div><!-- /.box-header -->

        {!! Form::open(['role'=>'form','method'=>'POST']) !!}

        <div class="box box-primary">
            
        <div class="box-header with-border">
            <h3 class="box-title"><b>Provide the Detailed Information below</b> </h3>
			@if(Session::has('message'))
                <h4 style="color:red;">{{Session::get('message')}}</h4>
            @endif
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="panel panel-default">
                    <div class="panel-body">
						<div class="form-group{!! $errors->has('emailOfWhoInvitedYou') ? ' has-error':'' !!} has-feedback">
                            <label>Email of who invited you</label><br>
                            @if($errors->has('emailOfWhoInvitedYou'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('emailOfWhoInvitedYou') !!}</label>
                            @endif
                            {!! Form::text('emailOfWhoInvitedYou',old('emailOfWhoInvitedYou'),['class'=>'form-control','placeholder'=>'email of who invited you']) !!}
                            <span class="form-control-feedback"><i class="fa fa-user" aria-hidden="true"></i></span>
                        </div>
						
						<div class="form-group{!! $errors->has('surveyId') ? ' has-error':'' !!} has-feedback">
                            <label>Survey Id</label><br>
                            @if($errors->has('surveyId'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('surveyId') !!}</label>
                            @endif
                            {!! Form::text('surveyId',old('surveyId'),['class'=>'form-control','placeholder'=>'survey id']) !!}
                            <span class="form-control-feedback"><i class="fa fa-user" aria-hidden="true"></i></span>
                        </div>
					
                        <div class="form-group{!! $errors->has('name') ? ' has-error':'' !!} has-feedback">
                            <label>Your Full Name*</label><br>
                            @if($errors->has('name'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('name') !!}</label>
                            @endif
                            {!! Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Full name']) !!}
                            <span class="form-control-feedback"><i class="fa fa-user" aria-hidden="true"></i></span>
                        </div>

                        <div class="form-group{!! $errors->has('yourEmail') ? ' has-error':'' !!} has-feedback">
                            <label>Email Address you are registering*</label><br>
                            @if($errors->has('yourEmail'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('yourEmail') !!}</label>
                            @endif
                            {!! Form::text('yourEmail',old('yourEmail'),['class'=>'form-control','placeholder'=>'Your Email Address']) !!}
                            <span class="form-control-feedback"><i class="fa fa-lock" aria-hidden="true"></i></span>
                        </div>
						
						<div class="form-group{!! $errors->has('regEmail') ? ' has-error':'' !!} has-feedback">
                            <label>Email Address which received the invitation*</label><br>
                            @if($errors->has('regEmail'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('regEmail') !!}</label>
                            @endif
                            {!! Form::text('regEmail',old('regEmail'),['class'=>'form-control','placeholder'=>'Email Address which received the invitation*']) !!}
                            <span class="form-control-feedback"><i class="fa fa-lock" aria-hidden="true"></i></span>
                        </div>

                        <div class="form-group{!! $errors->has('password') ? ' has-error':'' !!} has-feedback">
                            <label>Password*</label><br>
                            @if($errors->has('password'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('password') !!}</label>
                            @endif
                            {!! Form::password('password',['class'=>'form-control','placeholder'=>'Password']) !!}
                            <span class="form-control-feedback"><i class="fa fa-eye" aria-hidden="true"></i></span>
                        </div>

                        <div class="form-group{!! $errors->has('password') ? ' has-error':'' !!} has-feedback">
                            <label>Conform Password*</label><br>
                            @if($errors->has('password'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('password') !!}</label>
                            @endif
                            {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Re-type Password']) !!}
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
                            {!! Form::submit('Register',['class'=>'btn btn-primary']) !!}
                        </div>

                        </div>
                    </div>
                </div>
            </div>

        {!! Form::close() !!}


        </div>


    </div>

@stop