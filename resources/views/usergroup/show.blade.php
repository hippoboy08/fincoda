@extends('master')
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12 col-md-offset-0">
            <!-- general form elements -->


            <div class="box-header with-border">
                <h3 class="box-title"><b>Organization user group information.</b></h3>
                <p><i>Below is the list of all user groups in your company.  Click the group name for more information.</i></p>

            </div>


            @include('message.fail')
            @include('message.errors_head')
            @include('message.success')


            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <label><h4>Group name : </h4></label>
                           <label>{!! $group->name !!}</label></label><br>

                            <label><h4>Description : </h4></label>
                            {!! $group->description !!}
                            <label><h4>Administrator  :</h4></label>
                            <label>{!! \App\User::find($group->administrator)->name !!}</label><br>

                            <label><h4>created by : </h4></label>
                            <label>{!! \App\User::find($group->created_by)->name !!}</label>


                            <p class="panel-title">
                                <a data-toggle="collapse" href="#collapse1"><i class="fa fa-sort-desc" aria-hidden="true"></i>
                                    <label>Members of the group</label></a>
                            <p>Below are the list of the members in the group.</p>
                            </p>


                            <div id="collapse1" class="panel-collapse collapse">
                                <div>

                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($members as $member)
                                            <tr>

                                                <td>{!! \App\User::find($member->user_id)->name  !!}</td>
                                                <td>{!! \App\User::find($member->user_id)->email !!}</td>

                                            </tr>
                                        @endforeach
                                        </tbody>


                                    </table>
                                </div>

                            </div><br>

                            <label><h4>Surveys conducted in the group. --------Dummy table belowRecords for now</h4></label>
                            <p>Below is the list of surveys conducted in the group.</p>

                            <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Created by</th>
                                            <th>Administrator</th>
                                            <th>Opendate</th>
                                            <th>Status</th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>Group 1</td>
                                                <td>Admin</td>
                                                <td>special user1</td>
                                                <td>6</td>
                                                <td><span class="label label-success">Completed</span></td>

                                            </tr>
                                            <tr>
                                                <td>Group 1</td>
                                                <td>Admin</td>
                                                <td>special user1</td>
                                                <td>6</td>
                                                <td><span class="label label-warning">Pending..</span></td></td>

                                            </tr>
                                            <tr>
                                                <td>Group 1</td>
                                                <td>Admin</td>
                                                <td>special user1</td>
                                                <td>6</td>
                                                <td><span class="label label-danger"> Opened </span></td></td>

                                            </tr>

                                        </tbody>


                                    </table>
                            </div><br>



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
            $("#example2").DataTable();

        });
    </script>

@stop