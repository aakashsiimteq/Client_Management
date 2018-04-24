@if(Session::has('registered'))
  <div class="alert alert-success" role="alert">
    <strong>{{Session::get('registered')}}</strong>
  </div>
@endif
@if(Session::has('deleted'))
  <div class="alert alert-success" role="alert">
    <strong>{{Session::get('deleted')}}</strong>
  </div>
@endif
@if(Session::has('updated'))
  <div class="alert alert-success" role="alert">
    <strong>{{Session::get('updated')}}</strong>
  </div>
@endif
@if(Session::has('errors'))
  <div class="alert alert-danger" role="alert">
    @foreach ($iterable as $key => $value)

    @endforeach
  </div>
@endif
