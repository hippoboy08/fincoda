@extends('master')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12 col-md-offset-0">
            <!-- general form elements -->

            {!! Form::open(['method'=>'POST','action'=>'admin\UserGroupController@store']) !!}
            <div class="box-header with-border">
                <h3 class="box-title"><b>Create a new user group.</b></h3>
                <p><i>Please provide all the information below to create user group for your company.</i></p>
            </div>

            @include('message.fail')
            @include('message.errors_head')
            @if(count($administrators)<1)
                <div class="alert alert-danger role=alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                    <p>  <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                       Every special user is assigned with a group or you do not have a special user. Please make a new special user before making a new group. </p>
                </div>
                @endif
            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <div class="form-group{!! $errors->has('name') ? ' has-error':'' !!} has-feedback">
                                <label><h3>User Group Name*:</h3></label>
                                <p>Provide a name of the user group</p>
                                @if($errors->has('name'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('name') !!}</label>
                                @endif
                                {!! Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Name of user group']) !!}
                            </div><br>

                            <div class="form-group{!! $errors->has('editor1') ? ' has-error':'' !!} has-feedback">
                                <label><h3>Group Description*:</h3></label>
                                <p>Please provide a short description of the use group. </p>
                                @if($errors->has('editor1'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('editor1') !!}</label>
                                @endif
                                {!! Form::textarea('editor1',null,['id'=>'editor1','rows'=>'10','cols'=>'80', 'class'=>'createGroup']) !!}
                            </div><br>

                            <div class="form-group">
                                <label><h3>Assign a group administrator*:</h3></label>
                                <p>Please select an administrator for the group. The special users of the company are the administrators for the user groups.</p>
                               {!! Form::select('administrator',$administrators,null,['class'=>'form-control']) !!}

                            </div>

                            <div class="form-group{!! $errors->has('users') ? ' has-error':'' !!} has-feedback">
                                <label><h3>Select users to the group*:</h3></label>
                                <p>Please select users for this group.</p>
                                @if($errors->has('users'))
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{!! $errors->first('users') !!}</label>
                                @endif
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th><i class="fa fa-check-square-o" aria-hidden="true"></i> | | User ID</th>
									<th>Full Name</th>
                                    <th>Email Address</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{!! Form::checkbox('users[]',$user->id) !!} | {!! $user->id !!}</td>
                                        <td>{!! $user->name !!}</td>
										<td>{!! $user->email !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>


                                </table>
                                </div>

                            @if(count($administrators)<1)

                                <button type="submit" class="btn btn-info btn-flat" disabled="disabled" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Create Group</button>
                            @else
                                <button type="submit" class="btn btn-info btn-flat" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Create Group</button>
                                @endif
                         </div>
                     </div>
                 </div>
             </div>
         </div>
    </div>
    <!-- DataTables -->
    <script src="{{URL::asset('datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('datatables/dataTables.bootstrap.min.js')}}"></script>

    <script>
        $(function () {
            $("#example1").DataTable();

        });
    </script>

    @stop
