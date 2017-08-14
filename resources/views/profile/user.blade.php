@extends('master')
@section('content')

    <div class="row">
        <!-- left column -->
        <div class="col-md-12 col-md-offset-0">
            <!-- general form elements -->

            <div class="box-header with-border">
                <h3 class="box-title"><b>User's basic Profile</b></h3>
                <p><i>Below is the basic profile of the user.Please update the information where necessary.</i></p>
            </div>

            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <p><label>Full name : </label> {!! $user->name !!}</p>
                            <p><label>Gender : </label> {!! $profile->gender !!}</p>
                            <p><label>Country : </label> {!! $profile->country !!}</p>
                            <p><label>City : </label> {!! $profile->city !!}</p>
                            <p><label>Street : </label> {!! $profile->street !!}</p>
							<p><label>Phone : </label> {!! $profile->phone !!}</p>
							<p><label>What is your highest completed education?  </label> {!! $profile->What_is_your_highest_completed_education!!}</p>
                            <p><label>Are you a student or a professional? </label> {!! $profile->Are_you_a_student_or_a_professional !!}</p>
							<p><label>What level of study do you currently follow? </label> {!! $profile->What_level_of_study_do_you_currently_follow !!}</p>
							<p><label>What type of study are you doing? </label> {!! $profile->What_type_of_study_are_you_doing !!}</p>
							<p><label>What kind of function do you aspire after your graduation? </label> {!! $profile->What_kind_of_function_do_you_aspire_after_your_graduation !!}</p>
							<p><label>At what stage or in which year of study indicated above are you? Fill in the academic year in which the majority of your subjects are based. </label> {!! $profile->At_what_stage_or_in_which_year_of_study_indicated_above_are_you !!}</p>
							<p><label>What industry does your company/organization belong to? </label> {!! $profile->What_industry_does_your_company_or_organization_belong_to !!}</p>
							<p><label>How long has your company/organization been operating? </label> {!! $profile->How_long_has_your_company_or_organization_been_operating !!}</p>
							<p><label>What type of study did you do? </label> {!! $profile->What_type_of_study_did_you_do !!}</p>
							<p><label>What is your job role? </label> {!! $profile->What_is_your_job_role !!}</p>
							<p><label>How big is the company / organization you work for? </label> {!! $profile->How_big_is_the_company_or_organization_you_work_for !!}</p>
							<p><label>DOB : </label> {!! $profile->dob->toDateString() !!}</p>
                            <p><label>Hired Date : </label> {!! $profile->hired_date->toDateString() !!}</p>
                            @if(Auth::id()==$user->id)

                            @role('admin')
                              <a href="{!! url('admin/members/'.Auth::id().'/edit') !!}"> <button class="btn  btn-info btn-flat" ><i class="fa fa-pencil-square-o" aria-hidden="true" ></i> Update Profile</button></a>
                              <a href="{!! url('admin/members/deleteUserProfile/'.Auth::id()) !!}"> <button class="btn  btn-info btn-flat" ><i class="fa fa-pencil-square-o" aria-hidden="true" ></i> Delete Profile</button></a>
                                @endrole

                                @role('special')
                                <a href="{!! url('special/profile/'.Auth::id().'/edit') !!}"> <button class="btn  btn-info btn-flat" ><i class="fa fa-pencil-square-o" aria-hidden="true" ></i> Update Profile</button></a>
                                <a href="{!! url('special/profile/deleteUserProfile/'.Auth::id()) !!}"> <button class="btn  btn-info btn-flat" ><i class="fa fa-pencil-square-o" aria-hidden="true" ></i> Delete Profile</button></a>
								@endrole

                                @role('basic')
                                <a href="{!! url('basic/profile/'.Auth::id().'/edit') !!}"> <button class="btn  btn-info btn-flat" ><i class="fa fa-pencil-square-o" aria-hidden="true" ></i> Update Profile</button></a>
                                <a href="{!! url('basic/profile/deleteUserProfile/'.Auth::id()) !!}"> <button class="btn  btn-info btn-flat" ><i class="fa fa-pencil-square-o" aria-hidden="true" ></i> Delete Profile</button></a>
								@endrole
								
								@role('external')
                                <a href="{!! url('external/profile/'.Auth::id().'/edit') !!}"> <button class="btn  btn-info btn-flat" ><i class="fa fa-pencil-square-o" aria-hidden="true" ></i> Update Profile</button></a>
                                <a href="{!! url('external/profile/deleteUserProfile/'.Auth::id()) !!}"> <button class="btn  btn-info btn-flat" ><i class="fa fa-pencil-square-o" aria-hidden="true" ></i> Delete Profile</button></a>
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