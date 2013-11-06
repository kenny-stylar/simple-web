@extends('layout.master')

@section('content')
  <div class="page-header">
    <h1>Request Params</h1>
  </div>

  <div class="form">
    {{ Form::open( array( 'route'=>'editpost', 'class'=>'form-horizontal') ) }}

      @if ($errors->first())
      <div class="alert alert-danger">
        <b>{{ $errors->first() }}</b>
      </div>
      @endif

      <div class="form-group">
        {{ Form::label('post_id', 'Post ID', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::text('post_id', '5270930ab149f6042f000015', array('class'=>'form-control')) }}
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

  @if ( !empty($result['url']) )
  <p><b>* Request URL (reference only):</b><br><code>{{ $result['url'] }}</code></p>
  @endif

  @if ( !empty($post) )
  <div id="{{ $post['post_id'] }}" class="form">
    {{ Form::open( array('action'=>'PostController@postEditPostForm', 'class'=>'form-horizontal') ) }}
      
      <div class="form-group">
        {{ Form::label('category', 'Category', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-5">
          {{ Form::select('category', $categories, $post['category'], array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('post_id', 'Post ID', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::text('post_id', $post['post_id'], array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('message', 'Message', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::textarea('message', $post['message'], array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('link', 'URL', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::text('link', $post['link'], array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('place_name', 'Place', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::text('place_name', $post['place_name'], array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('location', 'Location', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::text('location', serialize($post['location']), array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
          {{ Form::submit('Update', array('class'=>'btn btn-info')) }}
        </div>
      </div>

    {{ Form::close() }}
  </div>
  @else
  <p>No Request Make / Empty result</p>
  @endif
@stop

@section('sidebar')
@if ( !empty($sidebar) )
{{ $sidebar }}
@endif
@stop
