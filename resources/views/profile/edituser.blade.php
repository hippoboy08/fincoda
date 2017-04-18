@extends('master')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-8 col-md-offset-2">
            <div class="box-header with-border">
                <h3 class="box-title"><b>{!! ucfirst($user->name) !!}</b></h3>

                <p>Below is your personal details. </p>

                @include('message.success')

                @role('admin')
                {!! Form::open(array('method'=>'PUT','url'=>'admin/members/'.$user->id)) !!}
                @endrole
                @role('special')
                {!! Form::open(array('method'=>'PUT','url'=>'special/profile/'.$user->id)) !!}
                @endrole
                @role('basic')
                {!! Form::open(array('method'=>'PUT','url'=>'basic/profile/'.$user->id)) !!}
                @endrole
				@role('external')
                {!! Form::open(array('method'=>'PUT','url'=>'external/profile/'.$user->id)) !!}
                @endrole


                {{ csrf_field() }}
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="panel panel-default">
                            <div class="panel-body">

                                <div class="form-group{!! $errors->has('name') ? ' has-error':'' !!} has-feedback row">
                                    @if($errors->has('name'))
                                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('name') !!}</label>
                                    @endif
                                    <div class="col-md-2 pull-left">
                                        <strong>Full Name* :</strong>
                                    </div>
                                    <div class="col-md-10 pull-right">
                                        {!! Form::text('name',$user->name,['class'=>'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-2 pull-left">
                                        <strong>Gender* :</strong>
                                    </div>
                                    <div class="col-md-10 pull-right">
                                        <?php
                                        $gender=$profile->gender;
                                        ?>
                                        @include('partials.gender')
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2 pull-left">
                                        <strong>Country* :</strong>
                                    </div>
                                    <div class="col-md-10 pull-right">
                                        <?php
                                            $default=$profile->country;
                                        ?>
                                        @include('partials.countries')
                                    </div>
                                </div>






                                <div class="form-group{!! $errors->has('city') ? ' has-error':'' !!} has-feedback row">
                                    @if($errors->has('city'))
                                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('city') !!}</label>
                                    @endif
                                    <div class="col-md-2 pull-left">
                                        <strong>City* :</strong>
                                    </div>
                                    <div class="col-md-10 pull-right">
                                        {!! Form::text('city',$profile->city,['class'=>'form-control']) !!}
                                    </div>
                                </div>

								<div class="form-group{!! $errors->has('city') ? ' has-error':'' !!} has-feedback row">
                                    @if($errors->has('dob'))
                                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('dob') !!}</label>
                                    @endif
                                    <div class="col-md-2 pull-left">
                                        <strong>dob* :</strong>
                                    </div>
                                    <div class="col-md-10 pull-right">
                                        {!! Form::text('dob',$profile->dob,['class'=>'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group{!! $errors->has('street') ? ' has-error':'' !!} has-feedback row">
                                    @if($errors->has('street'))
                                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('street') !!}</label>
                                    @endif
                                    <div class="col-md-2 pull-left">
                                        <strong>Street* :</strong>
                                    </div>
                                    <div class="col-md-10 pull-right">
                                        {!! Form::text('street',$profile->street,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group{!! $errors->has('phone') ? ' has-error':'' !!} has-feedback row">
                                    @if($errors->has('phone'))
                                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('phone') !!}</label>
                                    @endif
                                    <div class="col-md-2 pull-left">
                                        <strong>Phone* :</strong>
                                    </div>
                                    <div class="col-md-10 pull-right">
                                        {!! Form::text('phone',$profile->phone,['class'=>'form-control']) !!}
                                    </div>
                                </div>

								<div class="form-group{!! $errors->has('highest_education') ? ' has-error':'' !!} has-feedback row">
                                    @if($errors->has('highest_education'))
                                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('highest_education') !!}</label>
                                    @endif
                                    <div class="col-md-2 pull-left">
                                        <strong>What is your highest completed education?* :</strong>
                                    </div>
                                    <div class="col-md-10 pull-right">
                                        {!! Form::text('highest_education',$profile->What_is_your_highest_completed_education,['class'=>'form-control']) !!}
                                    </div>
                                </div>

								<div class="form-group{!! $errors->has('professional_status') ? ' has-error':'' !!} has-feedback row">
                                    @if($errors->has('professional_status'))
                                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('professional_status') !!}</label>
                                    @endif
                                    <div class="col-md-2 pull-left">
                                        <strong>Are you a student or a professional?* :</strong>
                                    </div>
                                    <div class="col-md-10 pull-right">
                                        {!! Form::text('professional_status',$profile->Are_you_a_student_or_a_professional,['class'=>'form-control']) !!}
                                    </div>
                                </div>

                                <div name="student-field">
                                  <div class="form-group{!! $errors->has('study_level') ? ' has-error':'' !!} has-feedback row">
                                    @if($errors->has('study_level'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('study_level') !!}</label>
                                    @endif
                                    <div class="col-md-2 pull-left">
                                      <strong>What level of study do you currently follow?* :</strong>
                                    </div>
                                    <div class="col-md-10 pull-right">
                                      {!! Form::text('study_level',$profile->What_level_of_study_do_you_currently_follow,['class'=>'form-control']) !!}
                                    </div>
                                  </div>

                                  <div class="form-group{!! $errors->has('study_type') ? ' has-error':'' !!} has-feedback row">
                                    @if($errors->has('study_type'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('study_type') !!}</label>
                                    @endif
                                    <div class="col-md-2 pull-left">
                                      <strong>What type of study are you doing?* :</strong>
                                    </div>
                                    <div class="col-md-10 pull-right">
                                      {!! Form::text('study_type',$profile->What_type_of_study_are_you_doing,['class'=>'form-control']) !!}
                                    </div>
                                  </div>

                                  <div class="form-group{!! $errors->has('post_graduate_aspirations') ? ' has-error':'' !!} has-feedback row">
                                    @if($errors->has('post_graduate_aspirations'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('post_graduate_aspirations') !!}</label>
                                    @endif
                                    <div class="col-md-2 pull-left">
                                      <strong>What kind of function do you aspire after your graduation?* :</strong>
                                    </div>
                                    <div class="col-md-10 pull-right">
                                      {!! Form::text('post_graduate_aspirations',$profile->What_kind_of_function_do_you_aspire_after_your_graduation,['class'=>'form-control']) !!}
                                    </div>
                                  </div>

                                  <div class="form-group{!! $errors->has('study_stage') ? ' has-error':'' !!} has-feedback row">
                                    @if($errors->has('study_stage'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('study_stage') !!}</label>
                                    @endif
                                    <div class="col-md-2 pull-left">
                                      <strong>At what stage or in which year of study indicated above are you? Fill in the academic year in which the majority of your subjects are based.* :</strong>
                                    </div>
                                    <div class="col-md-10 pull-right">
                                      {!! Form::text('study_stage',$profile->At_what_stage_or_in_which_year_of_study_indicated_above_are_you,['class'=>'form-control']) !!}
                                    </div>
                                  </div>
                                </div>

                                <div name="professional-field">
                                  <div class="form-group{!! $errors->has('company_industry') ? ' has-error':'' !!} has-feedback row">
                                    @if($errors->has('company_industry'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('company_industry') !!}</label>
                                    @endif
                                    <div class="col-md-2 pull-left">
                                      <strong>What industry does your company/organization belong to?* :</strong>
                                    </div>
                                    <div class="col-md-10 pull-right">
                                      {!! Form::text('company_industry',$profile->What_industry_does_your_company_or_organization_belong_to,['class'=>'form-control']) !!}
                                    </div>
                                  </div>

                                  <div class="form-group{!! $errors->has('company_age') ? ' has-error':'' !!} has-feedback row">
                                    @if($errors->has('company_age'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('company_age') !!}</label>
                                    @endif
                                    <div class="col-md-2 pull-left">
                                      <strong>How long has your company/organization been operating?* :</strong>
                                    </div>
                                    <div class="col-md-10 pull-right">
                                      {!! Form::text('company_age',$profile->How_long_has_your_company_or_organization_been_operating,['class'=>'form-control']) !!}
                                    </div>
                                  </div>

                                  <div class="form-group{!! $errors->has('study_type_you_did') ? ' has-error':'' !!} has-feedback row">
                                    @if($errors->has('study_type_you_did'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('study_type_you_did') !!}</label>
                                    @endif
                                    <div class="col-md-2 pull-left">
                                      <strong>What type of study did you do?* :</strong>
                                    </div>
                                    <div class="col-md-10 pull-right">
                                      {!! Form::text('study_type_you_did',$profile->What_type_of_study_did_you_do,['class'=>'form-control']) !!}
                                    </div>
                                  </div>

                                  <div class="form-group{!! $errors->has('job_role') ? ' has-error':'' !!} has-feedback row">
                                    @if($errors->has('job_role'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('job_role') !!}</label>
                                    @endif
                                    <div class="col-md-2 pull-left">
                                      <strong>What is your job role?* :</strong>
                                    </div>
                                    <div class="col-md-10 pull-right">
                                      {!! Form::text('job_role',$profile->What_is_your_job_role,['class'=>'form-control']) !!}
                                    </div>
                                  </div>

                                  <div class="form-group{!! $errors->has('company_size') ? ' has-error':'' !!} has-feedback row">
                                    @if($errors->has('company_size'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('company_size') !!}</label>
                                    @endif
                                    <div class="col-md-2 pull-left">
                                      <strong>How big is the company / organization you work for?* :</strong>
                                    </div>
                                    <div class="col-md-10 pull-right">
                                      {!! Form::text('company_size',$profile->How_big_is_the_company_or_organization_you_work_for,['class'=>'form-control']) !!}
                                    </div>
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
                    </div>
                {!! Form::close() !!}




            </div>
    </div>
    </div>
    @endsection
