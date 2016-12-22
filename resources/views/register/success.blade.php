@extends('register.index')
@section('content')
    <div class="row registration-form">
        <!-- left column -->
        <div class="col-md-5 col-md-offset-4">
            <!-- general form elements -->

            <div class="box-header with-border">
                <h3 class="box-title"><b>Registration Successful.</b></h3><br>

                        <p>{!! $success !!}</p><br>
                <p><a href="../login"> <button type = "button" class = "btn btn-primary" href="../login">
                        Login
                    </button></a></p>

                    </div>



            </div><!-- /.box-header -->
    </div>
    </div>

    @stop