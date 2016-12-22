@extends('master')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12 col-md-offset-0">
            <!-- general form elements -->

            {!! Form::open(['method'=>'POST','action'=>'admin\UserGroupController@store']) !!}
            <div class="box-header with-border">
                <h3 class="box-title"><b>Company User Group information.</b></h3>
                <p><i>Below is the list of all the user groups in your company. Click the group name to explore more about the group.</i></p>

            </div>


            @include('message.fail')
            @include('message.errors_head')
            @include('message.success')
            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-group">
                                @role('admin')
                                <label><h3>List of Company User Groups*:</h3></label>
                                <p><i>Click the group for more information.</i></p>
                                @endrole

                                @role('basic')
                                <label><h3>List of all the user groups in the company you are associated with</h3></label>
                                <p><i>Click the group for more information.</i></p>
                                @endrole

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
										<th>Group ID</th>
                                        <th>Group Name</th>
										<th>Edit</th>
                                        <th>Delete</th>
										<th>Total surveys</th>
                                        <th>Created by</th>
                                        <th>Group Administrator</th>
                                        <th>Total members</th>
										<th>Date Created</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($groups as $group)
                                        <tr>
											<td>{!! $group->id !!}</td>
                                            @role('admin')
                                            <td><a href="{{url('admin/usergroup/'.$group->id)}}"> {!! $group->name !!}</a></td>
											<td><a href="{{url('admin/usergroup/edit/'.$group->id)}}"> Edit </a></td>
											<td><a href="{{url('admin/usergroup/deleteGroup/'.$group->id)}}"> Delete </a></td>
                                            <td>{!! count(\App\Survey::where('user_group_id',$group->id)->get()) !!}</td>
                                            @endrole
                                            @role('special')
                                            <td><a href="{{url('special/usergroup/'.$group->id)}}"> {!! $group->name !!}</a></td>
											<th></th>
											<th></th>
                                            <td>{!! count(\App\Survey::where('user_group_id',$group->id)->get()) !!}</td>
                                            @endrole
                                            @role('basic')
                                            <td><a href="{{url('basic/usergroup/'.$group->id)}}"> {!! $group->name !!}</a></td>
											<th></th>
											<th></th>
											<th></th>
                                            @endrole
                                            <td>{!! $group->created_by !!}</td>
                                            <td>{!! \App\User::find($group->administrator)->name !!}</td>
                                            <td>{!! count(\App\User_In_Group::where('user_group_id',$group->id)->get()) !!}</td>
                                            <td>{!! $group->created_at !!}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>


                                </table>
                            </div>
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