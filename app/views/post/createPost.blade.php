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
        {{ Form::label('token', 'Token', array('class'=>'col-lg-2 control-label fhidden')) }}
        <div class="col-lg-10">
          {{ Form::text('token', Session::get('user_token'), array('class'=>'form-control', 'readonly'=>'readonly')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('catagory', 'Category', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-5">
          {{ Form::select('category', $categories, null, array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('message', 'Message', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::textarea('message', '', array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('url', 'URL', array('class'=>'col-lg-2 control-label')) }}
        <div class="col-lg-10">
          {{ Form::text('url', '', array('class'=>'form-control', 'placeholder'=>'http://www.blogger.com/')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('place_name', 'Place Name', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::text('place_name', '', array('class'=>'form-control', 'placeholder'=>'Place Name')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('geolocation', 'Location', array('class'=>'col-lg-2 control-label')) }}
        <div class="col-lg-10">
          {{ Form::text('geolocation', '', array('class'=>'form-control geolocation')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('location', 'Location (JSON)', array('class'=>'col-lg-2 control-label fhidden')) }}
        <div class="col-lg-10">
          {{ Form::text('location', '', array('class'=>'form-control', 'readonly'=>'readonly')) }}
        </div>
      </div>
      
      
      <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
          {{ Form::submit('Create Post', array('class'=>'btn btn-info')) }}
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

  @if (!empty($htmlview))
  {{ $htmlview }}
  @endif

@stop

@section('sidebar')
@if ( !empty($sidebar) )
{{ $sidebar }}
@endif
@stop