@extends('master')
@section('content')
    <div class="box">

        @role('admin')
        <div class="box">
            <div class="box-header">
                <h2 class="box-title">COMPANY NAME</h2>
                <p><i>Below is the list of all registered users in your organization.</i></p>
            </div><!-- /.box-header -->

            @include('message.success')

            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Role</th>



                    </tr>
                    </thead>
                    <tbody>

                        @foreach($users as $user)
                        <tr>
                        <td>{!! $user->name !!}</td>
                            <td>{!! $user->email !!}</td>
                            @if($user->display_name=='admin')
                                <td><a href="{!! url('admin/roles/'.$user->id) !!}"> <button class="btn bg-orange btn-block btn-sm">{!! strtoupper($user->display_name) !!}</button></a></td>
                                @elseif($user->display_name=='special')
                                <td><a href="{!! url('admin/roles/'.$user->id) !!}"><button class="btn bg-purple btn-block btn-sm">{!! strtoupper($user->display_name) !!}</button></a></td>
                                @else
                                <td><a href="{!! url('admin/roles/'.$user->id) !!}"><button class="btn bg-olive btn-block btn-sm">{!! strtoupper($user->display_name) !!}</button></a></td>
                            @endif




                        </tr>
                        @endforeach



                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Role</th>


                    </tr>
                    </tfoot>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

        @endrole()
    </div><!-- /.box -->
    <!-- DataTables -->
    <script src="{{URL::asset('datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('datatables/dataTables.bootstrap.min.js')}}"></script>

    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
@stop