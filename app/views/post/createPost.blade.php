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
        {{ Form::label('catagory', 'Category', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-5">
          {{ Form::select('catagory', $categories, null, array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('message', 'Message', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::textarea('message', '', array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('url', 'URL', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::text('url', '', array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('place_name', 'Place', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::text('place_name', '', array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('location', 'Location', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::text('location', '', array('class'=>'form-control')) }}
        </div>
      </div>
      
      
      <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
          {{ Form::submit('Submit', array('class'=>'btn btn-info')) }}
        </div>
      </div>

    {{ Form::close() }}
  </div>

  <p>&nbsp;</p>
  <div class="page-header">
    <h1>Response Body</h1>
  </div>

  @if (!empty($result))
  <p><b>* Request URL (reference only):</b><br><code>{{ $result['url'] }}</code></p>
  <div class="feed-holder">
    {{ $result['output'] }}
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