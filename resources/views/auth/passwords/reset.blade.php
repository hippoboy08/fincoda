@extends('GuestMaster')

@section('content')



    <div class="row col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

				 @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
				@endif

                <div class="panel-body">
                    <form  role="form" method="POST" action="{{ url('/password/reset') }}">
                        
						<input type="hidden" name="_token" value="{{ csrf_token()}}">
                        
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">



                                <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">



                                <input type="password" class="form-control" name="password" placeholder="new password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>


                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

                                <input type="password" class="form-control" name="password_confirmation" placeholder="confirm new password">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-refresh "></i> Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


    </div>

@endsection
