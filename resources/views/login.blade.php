@extends('GuestMaster')

        @section('content')
            <div class="login-box-body">

                @include('message.success')
                <p class="login-box-msg">Please provide your email address and password</p>



                {!! Form::open(['method'=>'POST']) !!}

                <div class="form-group has-feedback">
                    <div class="form-group{!! $errors->has('email') ? ' has-error':'' !!}">
                        @if($errors->has('email'))
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Email and/or password does not match.</label>
                        @endif

                        {!! Form::email('email',old('email'),['class'=>'form-control','placeholder'=>'Email','required'=>'required']) !!}
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                    </div>
                </div>
                <div class="form-group has-feedback">
                    {!! Form::password('password',['class'=>'form-control','placeholder'=>'Password','required'=>'required']) !!}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                        </div>
                    </div>
                </div><!-- /.col -->
                <div class="col-xs-12">
                    {!! Form::submit('Login',['class'=>'btn btn-primary btn-block btn-flat']) !!}
                    {!! Form::close() !!}
                </div><br><br><br>

                <a href="{{url('password/reset')}}">I forgot my password</a><br>
                <br>
                <a href="{{url('register/company')}}" class="text-center">Register a new Organization</a><br>
                --OR--<br>
                <a href="{{url('register/user')}}" class="text-center">Register as an Organization member</a>
            @endsection




    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<script src="{{'iCheck/icheck.min.js'}}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
