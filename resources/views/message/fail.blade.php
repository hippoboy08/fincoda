@if(Session::has('fail'))
    <div class="alert alert-danger role=alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

        <p style="font-size:20px;">  <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {!! Session::get('fail') !!}</p>
    </div>
@endif