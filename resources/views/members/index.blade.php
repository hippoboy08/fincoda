@extends('master')
@section('content')
    <div class="box">

        @role('admin')
        <div class="box">
            <div class="box-header">
                <h2 class="box-title">{!! $company->name !!}</h2>
                <p><i>Below is the list of all the members in the company registered for the Fincoda Survey System.</i></p>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Role</th>
                        <th>Registered at</th>
                        <th>Survey participated</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($members as $member)
                        <tr>
                            <td> <a href="{!! url('admin/members/'.$member->id) !!}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> | </a>&nbsp;&nbsp;{!! $member->name !!}</td>
                            <td>{!! $member->email !!}</td>
                           <td> {!! $member->display_name !!}</td>
                            <td>{!! $member->created_at !!}</td>
                            <td> --</td>

                        </tr>
                        @endforeach


                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Role</th>
                        <th>Registered at</th>
                        <th>Survey participated</th>
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