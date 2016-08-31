@extends('GuestMaster')

    @section('content')
        <div class="login-box-body">
            <p class="login-box-msg" style="font-size: 19px; font-weight: 600">Reset your password.</p>
            <p class="login-box-msg">Please provide your email address below.</p>

            @include('message.success')

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            {!! Form::open(['method'=>'POST','url'=>'password/email']) !!}

            <div class="form-group has-feedback">
                <div class="form-group{!! $errors->has('email') ? ' has-error':'' !!}">
                    @if($errors->has('email'))
                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Email address does not exist in Fincoda survey system. Please provide the valid
                            email.
                        </label>
                    @endif

                    {!! Form::email('email',old('email'),['class'=>'form-control','placeholder'=>'Email','required'=>'required']) !!}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                </div>
            </div>


            <div class="col-xs-12">
                <button type="submit", class='btn btn-primary btn-block btn-flat'>
                    <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                </button>

                {!! Form::close() !!}
            </div><br><br><br>

            @endsection






</div><!-- /.login-box -->

<script src="{{url('iCheck/icheck.min.js')}}"></script>
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
