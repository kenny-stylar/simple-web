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
        {{ Form::label('type', 'Type', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-4">
          {{ Form::select('type', array(
            'feedback' => 'Feedback',
            'problem'  => 'Problem'
          ), '', array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('email', 'Email', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::text('email', '', array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('message', 'Message', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::textarea('message', '', array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('screenshot', 'Screenshot', array('class'=>'col-lg-2 control-label')) }}
        <div class="col-lg-10">
          {{ Form::file('screenshot', array('class'=>'form-control')) }}
        </div>
      </div>
      
      <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
          {{ Form::submit('Submit Feedback', array('class'=>'btn btn-info')) }}
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