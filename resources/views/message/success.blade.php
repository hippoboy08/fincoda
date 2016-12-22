@if(Session::has('success'))
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong style="font-size:26px;"><i class="fa fa-check"></i> Successful !</strong>
        <p style="font-size:20px;">{!! Session::get('success') !!}</p>
    </div>
@endif
