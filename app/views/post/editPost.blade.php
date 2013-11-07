@extends('layout.master')

@section('content')
  <div class="page-header">
    <h1>Request Params</h1>
  </div>

  <div class="form">
    {{ Form::open( array( 'route'=>'edit_post', 'class'=>'form-horizontal') ) }}

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
        {{ Form::label('post_id', 'Post ID', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::text('post_id', '5279f7f9b149f6da1600000a', array('class'=>'form-control')) }}
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

  <p>&nbsp;</p>
  <div class="page-header">
    <h1>Response HTML View</h1>
  </div>

  @if ( !empty($post) )
  <div id="{{ $post['post_id'] }}" class="form">
    {{ Form::open( array('files' => true, 'class'=>'form-horizontal') ) }}
      
      <div class="form-group">
        {{ Form::label('post_id', 'Post ID', array('class'=>'col-lg-2 control-label fhidden')) }}
        <div class="col-lg-10">
          {{ Form::text('post_id', $post['post_id'], array('class'=>'form-control', 'readonly'=>'readonly')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('token', 'Token', array('class'=>'col-lg-2 control-label fhidden')) }}
        <div class="col-lg-10">
          {{ Form::text('token', Session::get('user_token'), array('class'=>'form-control', 'readonly'=>'readonly')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('category', 'Category', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-5">
          {{ Form::select('category', $categories, $post['category'], array('class'=>'form-control')) }}
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
          {{ Form::text('link', $post['link'], array('class'=>'form-control', 'placeholder'=>'http://www.blogger.com/')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('place_name', 'Place', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::text('place_name', $post['place_name'], array('class'=>'form-control', 'placeholder'=>'Place Name')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('geolocation', 'Location', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::text('geolocation', $post['location']['formatted_address'], array('class'=>'form-control geolocation')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('location', 'Location (JSON)', array('class'=>'col-lg-2 control-label fhidden')) }}
        <div class="col-lg-10">
          {{ Form::text('location', json_encode($post['location']), array('class'=>'form-control', 'readonly'=>'readonly')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('photos[]', 'Photo', array('class'=>'col-lg-2 control-label')) }}
        <div class="col-lg-10">
          @if (isset($post['photos'][0]['s']['url']))
          <img src="{{ $post['photos'][0]['s']['url'].'?token='.Session::get('user_token').'&_id='.date_timestamp_get(date_create()) }}" />
          @endif
          {{ Form::file('photos[]', array('class'=>'form-control')) }}
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
  <p>No Request Make</p>
  @endif
@stop

@section('sidebar')
@if ( !empty($sidebar) )
{{ $sidebar }}
@endif
@stop

