@extends('master')
@section('content')

    <div class="row">
        <!-- left column -->
        <div class="col-md-12 col-md-offset-0">
            <!-- general form elements -->

            <div class="box-header with-border">
                <h3 class="box-title"><b>User's basic profile</b></h3>
                <p><i>Below is the basic profile of the user.Please update the information where necessary. Click on ‘Update Profile’ to edit any information.</i></p>
                <p><i>if you want to delete your account, please click the delete button.</i></p>
            </div>

            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <p><label>Full name : </label> {!! $user->name !!}</p>
                            <p><label>Gender : </label> {!! $profile->gender !!}</p>
                            <p><label>Date of Birth : </label> {!! $profile->dob->toDateString() !!}</p>
                            <p><label>Phone : </label> {!! $profile->phone !!}</p>
                            <p><label>Country : </label> {!! $profile->country !!}</p>
                            <p><label>City : </label> {!! $profile->city !!}</p>
                            <p><label>Street : </label> {!! $profile->street !!}</p>	
							<p><label>What is your level of education?  </label> {!! $profile->What_is_your_highest_completed_education!!}</p>
                            <p><label>Are you a student or a professional? </label> {!! $profile->Are_you_a_student_or_a_professional !!}</p>
							<p><label>What level are you currently studying at? </label> {!! $profile->What_level_of_study_do_you_currently_follow !!}</p>
							<p><label>What subject are you studying? </label> {!! $profile->What_type_of_study_are_you_doing !!}</p>
							<p><label>What job are you aiming for once you graduate? </label> {!! $profile->What_kind_of_function_do_you_aspire_after_your_graduation !!}</p>
							<p><label>What year of study are you currently in? Fill in the academic year in which the majority of your subjects are based. </label> {!! $profile->At_what_stage_or_in_which_year_of_study_indicated_above_are_you !!}</p>
							<p><label>What industry does your organization operate in? </label> {!! $profile->What_industry_does_your_company_or_organization_belong_to !!}</p>
							<p><label>How long has your company/organization been operating? </label> {!! $profile->How_long_has_your_company_or_organization_been_operating !!}</p>
							<p><label>What did you study? </label> {!! $profile->What_type_of_study_did_you_do !!}</p>
							<p><label>What is your job role? </label> {!! $profile->What_is_your_job_role !!}</p>
							<p><label>How many people does your company/organization employ? </label> {!! $profile->How_big_is_the_company_or_organization_you_work_for !!}</p>
                            <p><label>Date hired : </label> {!! $profile->hired_date->toDateString() !!}</p>
                            @if(Auth::id()==$user->id)

                            @role('admin')
                              <a href="{!! url('admin/members/'.Auth::id().'/edit') !!}"> <button class="btn  btn-info btn-flat" ><i class="fa fa-pencil-square-o" aria-hidden="true" ></i> Update Profile</button></a>
                              <a href="{!! url('admin/members/deleteUserProfile/'.Auth::id()) !!}"> <button class="btn  btn-delete btn-flat confirmation" ><i class="fa fa-pencil-square-o confirmation" aria-hidden="true" ></i> Delete Profile</button></a>
                                @endrole

                                @role('special')
                                <a href="{!! url('special/profile/'.Auth::id().'/edit') !!}"> <button class="btn  btn-info btn-flat" ><i class="fa fa-pencil-square-o" aria-hidden="true" ></i> Update Profile</button></a>
                                <a href="{!! url('special/profile/deleteUserProfile/'.Auth::id()) !!}"> <button class="btn btn-delete btn-flat confirmation" ><i class="fa fa-pencil-square-o confirmation" aria-hidden="true" ></i> Delete Profile</button></a>
								@endrole

                                @role('basic')
                                <a href="{!! url('basic/profile/'.Auth::id().'/edit') !!}"> <button class="btn  btn-info btn-flat" ><i class="fa fa-pencil-square-o" aria-hidden="true" ></i> Update Profile</button></a>
                                <a href="{!! url('basic/profile/deleteUserProfile/'.Auth::id()) !!}"> <button class="btn btn-delete btn-flat confirmation" ><i class="fa fa-pencil-square-o confirmation" aria-hidden="true" ></i> Delete Profile</button></a>
								@endrole
								
								@role('external')
                                <a href="{!! url('external/profile/'.Auth::id().'/edit') !!}"> <button class="btn  btn-info btn-flat" ><i class="fa fa-pencil-square-o" aria-hidden="true" ></i> Update Profile</button></a>
                                <a href="{!! url('external/profile/deleteUserProfile/'.Auth::id()) !!}"> <button class="btn btn-delete btn-flat" ><i class="fa fa-pencil-square-o confirmation" aria-hidden="true" ></i> Delete Profile</button></a>
								@endrole
							  

                            @else
                             <button class="btn  btn-info btn-flat" disabled><i class="fa fa-pencil-square-o" aria-hidden="true" ></i> Update Profile</button>
                            @endif


                        </div>
                    </div>
                </div>
            </div>


           <div class="box-header with-border">
                <h3 class="box-title"><b>User's Current Role</b></h3>
                <p><i>The current role assigned by the administrator</i></p>
            </div>

            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <p><label>Role : </label> {!! strtoupper($role->display_name) !!}</p>
                            @role('admin')
                            @if($user->id==Auth::id())
                            <button class="btn  btn-info btn-flat" disabled="disabled"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Change Role</button>
                                @else
                           <a href="{{url('admin/roles/'.$user->id)}}"> <button class="btn  btn-info btn-flat"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Change Role</button></a>
                                @endif
                            @endrole()
                        </div>
                    </div>
                </div>
            </div>




            </div>
        </div>
    @stop