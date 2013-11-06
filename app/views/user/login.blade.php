@extends('layout.master')

@section('content')
  <div class="page-header">
    <h1>Request Params</h1>
  </div>

  <div class="form">
    {{ Form::open( array('class'=>'form-horizontal')) }}

      @if ($errors->first())
      <div class="alert alert-danger">
        <b>{{ $errors->first() }}</b>
      </div>
      @endif

      <div class="form-group">
        {{ Form::label('login_id', 'Login ID', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::text('login_id', '', array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('password', 'Password', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::password('password', array('class'=>'form-control')) }}
        </div>
      </div>
      
      <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
          {{ Form::submit('Login', array('class'=>'btn btn-info')) }}
        </div>
      </div>

    {{ Form::close() }}
  </div>

  <p>&nbsp;</p>
  <div class="page-header">
    <h1>Response Body</h1>
  </div>

  @if (!empty($request_url))
  <p><b>* Request URL (reference only):</b><br><code>{{ $request_url }}</code></p>
  @endif

  @if (!empty($result))
  <div class="result">
    @if ($result['status'])
    {{ CommonHelper::preEcho($result['output']) }}
    @else
    <div class="alert alert-danger">
      {{ array_get($result, 'output.message') }}
    </div>
    @endif
  </div>
  @else
  <p>No Request Make</p>
  @endif

@stop

@section('sidebar')
@if ( !empty($sidebar) )
{{ $sidebar }}
@endif
@stop