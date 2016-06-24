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
                            <p><label>Email Aaddress : </label>{!! $user->email !!}</p>
                            <p><label>Gender : </label> {!! $profile->gender !!}</p>
                            <p><label>Country : </label> {!! $profile->country !!}</p>
                            <p><label>City : </label> {!! $profile->city !!}</p>
                            <p><label>Street : </label> {!! $profile->street !!}</p>
                            <p><label>DOB : </label> {!! $profile->dob->toDateString() !!}</p>
                            <p><label>Hired Date : </label> {!! $profile->hired_date->toDateString() !!}</p>
                            @if(Auth::id()==$user->id)

                           <button class="btn  btn-info btn-flat" ><i class="fa fa-pencil-square-o" aria-hidden="true" ></i> Update Profile</button>
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