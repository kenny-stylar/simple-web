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
        {{ Form::label('uid', 'User ID', array('class'=>'col-lg-3 control-label fhidden')) }}
        <div class="col-lg-9">
          {{ Form::text('uid', Session::get('uid'), array('class'=>'form-control', 'readonly'=>'readonly')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('token', 'Token', array('class'=>'col-lg-3 control-label fhidden')) }}
        <div class="col-lg-9">
          {{ Form::text('token', Session::get('user_token'), array('class'=>'form-control', 'readonly'=>'readonly')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('old_password', 'Old Password', array('class'=>'col-lg-3 control-label required')) }}
        <div class="col-lg-9">
          {{ Form::password('old_password', array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('new_password', 'New Password', array('class'=>'col-lg-3 control-label required')) }}
        <div class="col-lg-9">
          {{ Form::password('new_password', array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('new_password_confirmation', 'Confirm Password', array('class'=>'col-lg-3 control-label required')) }}
        <div class="col-lg-9">
          {{ Form::password('new_password_confirmation', array('class'=>'form-control')) }}
        </div>
      </div>
      
      <div class="form-group">
        <div class="col-lg-offset-3 col-lg-9">
          {{ Form::submit('Change Password', array('class'=>'btn btn-info')) }}
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