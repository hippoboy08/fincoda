@extends('master')
@section('content')

            <div class="row">
                <!-- left column -->
                <div class="col-md-8 col-md-offset-2">
                    <!-- general form elements -->
                    <div class="box-header with-border">
                        <h3 class="box-title"><b>{!! $company->name !!}</b></h3>
                        <p><i>The organization has been registered to the <strong>FINCODA survey system.</strong> </i></p>
                        <p>Below are the details you provided to FINCODA upon registration. </p>
                    </div>
                    {!! Form::open(array('method'=>'post')) !!}
                    {{ csrf_field() }}
                      <div class="box box-primary">
                        <div class="box-body">
                            <div class="panel panel-default">
                                <div class="panel-body">

                                    <div class="form-group{!! $errors->has('company_name') ? ' has-error':'' !!} has-feedback row">
                                        @if($errors->has('company_name'))
                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('company_name') !!}</label>
                                        @endif
                                    <div class="col-md-2 pull-left">
                                        <strong>Organization Name* :</strong>
                                    </div>
                                    <div class="col-md-10 pull-right">
                                            {!! Form::text('company_name',$company->name,['class'=>'form-control']) !!}
                                    </div>
                                    </div>

                                    <div class="form-group row">

                                        <div class="col-md-2 pull-left">
                                            <strong>Organization code* :</strong>
                                        </div>
                                        <div class="col-md-10 pull-right">
                                            {!! Form::text('company_code',$company->company_code,['class'=>'form-control','disabled']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group{!! $errors->has('company_type') ? ' has-error':'' !!} has-feedback row">
                                        @if($errors->has('company_type'))
                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('company_type') !!}</label>
                                        @endif
                                        <div class="col-md-2 pull-left">
                                            <strong> Type* :</strong>
                                        </div>
                                        <div class="col-md-10 pull-right">
                                            {!! Form::text('company_type',$company_profile->type,['class'=>'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-2 pull-left">
                                            <strong>Country* :</strong>
                                        </div>
                                        <div class="col-md-10 pull-right">
                                            <?php
                                            $default=$company_profile->country
                                            ?>

                                           @include('partials.countries')
                                        </div>
                                    </div>

                                    <div class="form-group{!! $errors->has('city') ? ' has-error':'' !!} has-feedback row">
                                        @if($errors->has('city'))
                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('city') !!}</label>
                                        @endif
                                        <div class="col-md-2 pull-left">
                                            <strong> City* :</strong>
                                        </div>
                                        <div class="col-md-10 pull-right">
                                            {!! Form::text('city',$company_profile->city,['class'=>'form-control']) !!}
                                        </div>
                                    </div>


                                    <div class="form-group{!! $errors->has('address') ? ' has-error':'' !!} has-feedback row">
                                        @if($errors->has('address'))
                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('address') !!}</label>
                                        @endif
                                        <div class="col-md-2 pull-left">
                                            <strong> Address* :</strong>
                                        </div>
                                        <div class="col-md-10 pull-right">
                                            {!! Form::text('address',$company_profile->street,['class'=>'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group{!! $errors->has('email') ? ' has-error':'' !!} has-feedback row">
                                        @if($errors->has('email'))
                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('email') !!}</label>
                                        @endif
                                        <div class="col-md-2 pull-left">
                                            <strong> Email :</strong>
                                        </div>
                                        <div class="col-md-10 pull-right">
                                            {!! Form::text('email',$company_profile->email,['class'=>'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group{!! $errors->has('phone') ? ' has-error':'' !!} has-feedback row">
                                        @if($errors->has('phone'))
                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('phone') !!}</label>
                                        @endif
                                        <div class="col-md-2 pull-left">
                                            <strong> Phone:</strong>
                                        </div>
                                        <div class="col-md-10 pull-right">
                                            {!! Form::text('phone',$company_profile->phone,['class'=>'form-control']) !!}
                                        </div>
                                    </div>


                                    <div class="form-group{!! $errors->has('postcode') ? ' has-error':'' !!} has-feedback row">
                                        @if($errors->has('postcode'))
                                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('postcode') !!}</label>
                                        @endif
                                        <div class="col-md-2 pull-left">
                                            <strong> Post code:</strong>
                                        </div>
                                        <div class="col-md-10 pull-right">
                                            {!! Form::text('postcode',$company_profile->postcode,['class'=>'form-control']) !!}
                                        </div>
                                    </div>



                                    <div class="form-group row">

                                        <div class="col-md-2 pull-left">
                                            <strong> Joined at:</strong>
                                        </div>
                                        <div class="col-md-10 pull-right">
                                            {!! Form::text('join',$company_profile->created_at->toDateString(),['class'=>'form-control','disabled']) !!}
                                        </div>
                                    </div>








                                  <div class="form-group">
                                      <div class="col-md-2 pull-left">

                                      </div>
                                      <div class="col-md-10">
                                          <button class="btn  btn-info btn-flat"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Profile</button>
                                          </div>


                                  </div>

                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}

        </section><!-- /.content -->
    </div>

    @stop
