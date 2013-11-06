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
        {{ Form::label('uid', 'User ID', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::text('uid', 'ae2953e5b0551a06efc5753b94ae31a3', array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('catagories', 'Catagories', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          @foreach ( $categories AS $key => $cat )
          <div class="checkbox">
            <label>
              {{ Form::checkbox('categories[]', $key) }}
              {{ $cat }}
            </label>
          </div>
          @endforeach
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('page', 'Page', array('class'=>'col-lg-2 control-label')) }}
        <div class="col-lg-2">
          {{ Form::text('page', '1', array('class'=>'form-control')) }}
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