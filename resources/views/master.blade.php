<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @role('admin')
    <title>Fincoda | Admin</title>
    @endrole
    @role('basic')
    <title>Fincoda | Basic User</title>
    @endrole

    @role('special')
    <title>Fincoda | Special User</title>
    @endrole
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Latest compiled and minified CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">


    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::asset('css/AdminLTE.min.css')}}">

    <link rel="stylesheet" href="{{URL::asset('css/skins/skin-blue.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('dataTables/dataTables.bootstrap.css')}}">

    <link rel="stylesheet" href="{{ URL::asset('iCheck/all.css') }}">
    <link rel="stylesheet" href="{{URL::asset('bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('timepicker/bootstrap-timepicker.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('daterangepicker/daterangepicker-bs3.css')}}">

    <link rel="stylesheet" href="{{URL::asset('css/custom.css')}}">

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!--role admin-->
    @role('admin')
    @include('navbar.admin')
    @include('sidebar.admin')
    <div class="content-wrapper">
        <section class="content">
    @yield('content')
        </section>
        </div>
    @include('footer.admin')
    @include('controlbar.admin')
    @endrole

    <!--role basic-->
    @role('basic')
    @include('navbar.basic')
    @include('sidebar.basic')
    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>
    @include('footer.basic')
    @include('controlbar.basic')
    @endrole

     <!--special-->
    @role('special')
    @include('navbar.special')
    @include('sidebar.special')
    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>
    @include('footer.special')
    @include('controlbar.special')
    @endrole

</div><!-- ./wrapper -->
<!-- AdminLTE App -->
<script src="{{URL::asset('js/app.min.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{URL::asset('input-mask/jquery.inputmask.js')}}"></script>
<script src="{{URL::asset('input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{URL::asset('input-mask/jquery.inputmask.extensions.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{URL::asset('bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script src="{{URL::asset('timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{URL::asset('daterangepicker/daterangepicker.js')}}"></script>
<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();

    });
</script>
<script>

    $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function (start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
        );
    });
</script>


</body>
</html>


