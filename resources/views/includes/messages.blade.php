@if(Session::has('registered'))
  <div class="alert alert-success" role="alert">
    <strong>{{Session::get('registered')}}</strong>
  </div>
@endif
@if(Session::has('invoiced'))
<div class="alert alert-success" role="alert">
    <strong>{{Session::get('invoiced')}}</strong>
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
@if(Session::has('success'))
  <div class="alert alert-success" role="alert">
    <strong>{{Session::get('success')}}</strong>
  </div>
@endif
@if(Session::has('received'))
  <div class="alert alert-success" role="alert">
    <strong>{{Session::get('received')}}</strong>
  </div>
@endif
@if(Session::has('not_received'))
  <div class="alert alert-danger" role="alert">
    <strong>{{Session::get('not_received')}}</strong>
  </div>
@endif
@if(Session::has('grater_received'))
  <div class="alert alert-danger" role="alert">
    <strong>{{Session::get('grater_received')}}</strong>
  </div>
@endif

@if(Session::has('exists'))
  <div class="alert alert-danger" role="alert">
    <strong>{{Session::get('exists')}}</strong>
  </div>
@endif

@if(Session::has('errors'))
  <div class="alert alert-danger" role="alert">
    @foreach ($iterable as $key => $value)

    @endforeach
  </div>
@endif
