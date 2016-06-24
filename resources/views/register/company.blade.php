@extends('register.index')
@section('content')
        <!-- Main content -->
    <div class="row registration-form">
        <!-- left column -->
        <div class="col-md-5 col-md-offset-4">
            <!-- general form elements -->

                <div class="box-header with-border">
                    <h3 class="box-title"><b>Provide you basic information</b></h3>
                    <p><i>Please provide all the basic information of your company or the organisation.</i></p>
                </div><!-- /.box-header -->
                <!-- form start -->

                    {!! Form::open(['role'=>'form','method'=>'POST']) !!}
                  <div class="box box-primary">
                    <div class="box-body">

                        <div class="panel panel-default">
                            <div class="panel-body">
                       <div class="form-group{!! $errors->has('company_name') ? ' has-error':'' !!} has-feedback">
                       <label>Organisation Name*</label><br>
                           @if($errors->has('company_name'))
                               <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('company_name') !!}</label>
                           @endif
                        {!! Form::text('company_name',old('company_name'),['class'=>'form-control','placeholder'=>'Name of your organisation']) !!}

                        </div>

                        <div class="form-group{!! $errors->has('company_name') ? ' has-error':'' !!} has-feedback">
                            <label>Organisation Type*</label><br>
                            @if($errors->has('company_type'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('company_type') !!}.</label>
                            @endif
                            {!! Form::text('company_type',old('company_type'),['class'=>'form-control','placeholder'=>'Education/Business/Transport']) !!}

                        </div>

                        <div class="form-group">
                            <label>Select Country*</label>
                            @if($errors->has('country'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('country') !!}.</label>
                            @endif
                          @include('partials.countries',['default'=>'Finland'])
                        </div>


                        <div class="form-group {!! $errors->has('city') ? ' has-error':'' !!} has-feedback">
                            <label>City*</label><br>
                            @if($errors->has('city'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('city') !!}.</label>
                            @endif
                            {!! Form::text('city',old('city'),['class'=>'form-control','placeholder'=>'City']) !!}

                        </div>

                        <div class="form-group{!! $errors->has('street') ? ' has-error':'' !!} has-feedback">
                            <label>Address*</label></br>
                            @if($errors->has('street'))
                                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('street') !!}.</label>
                            @endif
                            {!! Form::text('street',old('street'),['class'=>'form-control','placeholder'=>'Full Address']) !!}

                        </div>


                        <div class="form-group has-feedback">
                                <label>Organisation Email</label>
                            {!! Form::text('company_email',old('company_email'),['class'=>'form-control','placeholder'=>'Email of the organisation']) !!}

                        </div>

                        <div class="form-group has-feedback">
                            <label>Phone Number</label>
                            {!! Form::text('phone',old('phone'),['class'=>'form-control','placeholder'=>'Organisation\'s phone number']) !!}

                        </div>

                        <div class="form-group has-feedback">
                            <label>Post Code</label>
                            {!! Form::text('postcode',old('postcode'),['class'=>'form-control','placeholder'=>'Postal Address']) !!}

                        </div>
</div>
</div>
                    </div>
                </div>
            <div class="box-header with-border">
                <h3 class="box-title"><b>Provide the Administrator detail below</b> </h3>
                <p><i>Please provide your basic information.</i></p>
            </div>
            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                    <div class="form-group{!! $errors->has('name') ? ' has-error':'' !!} has-feedback">
                        <label>Full Name*</label><br>
                        @if($errors->has('name'))
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('name') !!}.</label>
                        @endif
                        {!! Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Full Name']) !!}
                        <span class="form-control-feedback"><i class="fa fa-user" aria-hidden="true"></i></span>
                    </div>
                    <div class="form-group{!! $errors->has('email') ? ' has-error':'' !!} has-feedback">
                        <label>Email address*</label><br>
                        @if($errors->has('email'))
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('email') !!}.</label>
                        @endif
                        {!! Form::email('email',old('email'),['class'=>'form-control','placeholder'=>'Email']) !!}
                        <span class="form-control-feedback"><i class="fa fa-lock" aria-hidden="true"></i></span>
                    </div>
                    <div class="form-group{!! $errors->has('password') ? ' has-error':'' !!} has-feedback">
                        <label>Password*<i>(min 6 characters)</i></label><br>
                        @if($errors->has('password'))
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('password') !!}.</label>
                        @endif
                        {!! Form::password('password',['class'=>'form-control','placeholder'=>'Password']) !!}
                        <span class="form-control-feedback"><i class="fa fa-eye" aria-hidden="true"></i></span>
                    </div>
                    <div class="form-group{!! $errors->has('password') ? ' has-error':'' !!} has-feedback">
                        <label>Conform Password*</label>
                        {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Re-type Password']) !!}
                        <span class="form-control-feedback"><i class="fa fa-eye" aria-hidden="true"></i></span>
                    </div>

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