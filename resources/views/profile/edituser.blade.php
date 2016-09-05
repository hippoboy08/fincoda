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
