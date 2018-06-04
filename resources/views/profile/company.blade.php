@extends('master')
@section('content')

            <div class="row">
                <!-- left column -->
                <div class="col-md-8 col-md-offset-2">
                    <!-- general form elements -->

                    @include('message.success')

                    <div class="box-header with-border">
                        <h3 class="box-title"><b>{!! $company->name !!}</b></h3>
                        <p><i>The organization has been registered to the <strong>FINCODA survey system.</strong> </i></p>
                        <p>Below are the details you provided to FINCODA upon registration. </p>
                    </div>

                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="panel panel-default">
                                <div class="panel-body">
                           <p> <label>Organization Name : </label> {!! $company->name !!}<br></p>
                            <p><label>Organization Code : </label> {!! $company->company_code !!}<br></p>
                            <p><label>Type : </label> {!! $company_profile->type !!}<br></p>
                            <p><label>Email : </label> {!! $company_profile->email !!}<br></p>
                            <p><label>Phone : </label> {!! $company_profile->phone !!}<br></p>
                            <p><label>Time Zone : </label> {!! $company_profile->time_zone !!}<br></p>
                            <p><label>Country : </label> {!! $company_profile->country !!}<br></p>
                            <p><label>City : </label> {!! $company_profile->city !!}<br></p>
                            <p><label>Street : </label> {!! $company_profile->street !!}<br></p>                       
                            <p><label>Postal Code : </label> {!! $company_profile->postcode !!}<br></p>
                             <p><label>Joined at : </label> {!! $company->created_at->toDateString() !!}<br></p>
                                    <a href="{!! url('admin/company/update') !!}"><button class="btn  btn-info btn-flat"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Profile</button></a>
                                </div>
                                </div>
                            </div>
                        </div>



        </section><!-- /.content -->
    </div>

    @stop