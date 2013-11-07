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
        {{ Form::label('email', 'Email', array('class'=>'col-lg-3 control-label required')) }}
        <div class="col-lg-9">
          {{ Form::text('email', '', array('class'=>'form-control', 'placeholder'=>'Email Address')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('username', 'Username', array('class'=>'col-lg-3 control-label required')) }}
        <div class="col-lg-9">
          {{ Form::text('username', '', array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('password', 'Password', array('class'=>'col-lg-3 control-label required')) }}
        <div class="col-lg-9">
          {{ Form::password('password', array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('password_confirmation', 'Confirm Password', array('class'=>'col-lg-3 control-label required')) }}
        <div class="col-lg-9">
          {{ Form::password('password_confirmation', array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('fb_id', 'Facebook ID', array('class'=>'col-lg-3 control-label')) }}
        <div class="col-lg-9">
          {{ Form::text('fb_id', '', array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('fb_token', 'Facebook Token', array('class'=>'col-lg-3 control-label')) }}
        <div class="col-lg-9">
          {{ Form::text('fb_token', '', array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('name', 'Name', array('class'=>'col-lg-3 control-label required')) }}
        <div class="col-lg-9">
          {{ Form::text('name', '', array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('dob', 'DOB', array('class'=>'col-lg-3 control-label required')) }}
        <div class="col-lg-4">
          {{ Form::text('dob', '', array('class'=>'form-control', 'placeholder'=>'Format: YYYY-mm-dd')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('gender', 'Gender', array('class'=>'col-lg-3 control-label required')) }}
        <div class="col-lg-4">
          {{ Form::select('gender', array('m'=>'Male', 'f'=>'Female'), '', array('class'=>'form-control')) }}
        </div>
      </div>
      
      <div class="form-group">
        <div class="col-lg-offset-3 col-lg-9">
          {{ Form::submit('Submit', array('class'=>'btn btn-info')) }}
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