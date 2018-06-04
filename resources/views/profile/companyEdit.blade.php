@extends('master')
@section('content')

            <div class="row">
                <!-- left column -->
                <div class="col-md-8 col-md-offset-2">
                    <!-- general form elements -->
                    <div class="box-header with-border">
                        <h3 class="box-title"><b>{!! $company->name !!}</b></h3>
                        <p><i>The organization has been updated to the <strong>FINCODA survey system.</strong> </i></p>
                        <p>Below are the details you provided to FINCODA upon registration. </p>
                    </div>
                    {!! Form::open(array('method'=>'post', 'action'=>'admin\ProfileController@updateCompanyProfile')) !!}
                      <div class="box box-primary">
                        <div class="box-body">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                  {!! Form::label('company_name','Company Name : *',['class'=>'col-md-4 control-label']) !!}
                                  {!! Form::text('company_name',$company->name,['class'=>'form-control']) !!}
                                  {!! Form::label('company_code','Company code : *',['class'=>'col-md-4 control-label']) !!}
                                  {!! Form::text('company_code',$company->company_code,['class'=>'form-control']) !!}




                                  {!! Form::label('company_type','Company Type : *',['class'=>'col-md-4 control-label']) !!}
                                  {!! Form::text('company_type',$company_profile->type,['class'=>'form-control']) !!}
                                  {!! Form::label('company_country','Country : *',['class'=>'col-md-4 control-label']) !!}
                                  {!! Form::text('company_country', $company_profile->country,['class'=>'form-control']) !!}
                                  {!! Form::label('company_city','City : *',['class'=>'col-md-4 control-label']) !!}
                                  {!! Form::text('company_city', $company_profile->city,['class'=>'form-control']) !!}
                                  {!! Form::label('company_street','Street : *',['class'=>'col-md-4 control-label']) !!}
                                  {!! Form::text('company_street', $company_profile->street,['class'=>'form-control']) !!}
                                  {!! Form::label('company_email','Company Email : *',['class'=>'col-md-4 control-label']) !!}
                                  {!! Form::text('company_email', $company_profile->email,['class'=>'form-control']) !!}
                                  {!! Form::label('company_phone','Company Phone : *',['class'=>'col-md-4 control-label']) !!}
                                  {!! Form::text('company_phone', $company_profile->phone,['class'=>'form-control']) !!}
                                  {!! Form::label('company_postcode','Company Postcode : *',['class'=>'col-md-4 control-label']) !!}
                                  {!! Form::text('company_postcode', $company_profile->postcode,['class'=>'form-control']) !!}
                                  {!! Form::label('company_joined_at','Company Joined At : *',['class'=>'col-md-4 control-label']) !!}
                                  {!! Form::text('company_joined_at', $company->created_at->toDateString(),['class'=>'form-control']) !!}
                                  <div>
                                    <button class="btn  btn-info btn-flat"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Profile</button>
                                    <div class="row pull-right" >
                                     <button disabled class="btn  btn-info btn-flat"><i class="fa fa-pencil-square-o confirmation" aria-hidden="true"></i> Delete Profile</button>
                                    </div>
                                  </div>

                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}

        </section><!-- /.content -->
    </div>

    @stop
