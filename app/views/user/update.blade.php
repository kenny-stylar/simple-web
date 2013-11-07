@extends('layout.master')

@section('content')
  <div class="page-header">
    <h1>Request Params</h1>
  </div>

  @if (!empty($user))
  <div class="form">
    {{ Form::open( array('files' => true, 'class'=>'form-horizontal')) }}

      @if ($errors->first())
      <div class="alert alert-danger">
        <b>{{ $errors->first() }}</b>
      </div>
      @endif

      <div class="form-group">
        {{ Form::label('uid', 'User ID', array('class'=>'col-lg-2 control-label fhidden')) }}
        <div class="col-lg-10">
          {{ Form::text('uid', Session::get('uid'), array('class'=>'form-control', 'readonly'=>'readonly')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('token', 'Token', array('class'=>'col-lg-2 control-label fhidden')) }}
        <div class="col-lg-10">
          {{ Form::text('token', Session::get('user_token'), array('class'=>'form-control', 'readonly'=>'readonly')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('email', 'Email', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::text('email', $user['email'], array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('fb_id', 'Facebook ID', array('class'=>'col-lg-2 control-label')) }}
        <div class="col-lg-10">
          {{ Form::text('fb_id', $user['fb_id'], array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('fb_token', 'Facebook Token', array('class'=>'col-lg-2 control-label')) }}
        <div class="col-lg-10">
          {{ Form::text('fb_token', '', array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('name', 'Name', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::text('name', $user['name'], array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('dob', 'DOB', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-4">
          {{ Form::text('dob', $user['dob'], array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('gender', 'Gender', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-4">
          {{ Form::select('gender', array('m'=>'Male', 'f'=>'Female'), $user['gender'], array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('geohome_city', 'Home', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::text('geohome_city', $user['home_city']['formatted_address'], array('class'=>'form-control geolocation')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('home_city', 'Home', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-10">
          {{ Form::text('home_city', json_encode($user['home_city']), array('class'=>'form-control', 'readonly'=>'readonly')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('geoother_city', 'Work', array('class'=>'col-lg-2 control-label')) }}
        <div class="col-lg-10">
          {{ Form::text('geoother_city', $user['other_city']['formatted_address'], array('class'=>'form-control geolocation')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('other_city', 'Work (JSON)', array('class'=>'col-lg-2 control-label')) }}
        <div class="col-lg-10">
          {{ Form::text('other_city', json_encode($user['other_city']), array('class'=>'form-control', 'readonly'=>'readonly')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('categories', 'Categories', array('class'=>'col-lg-2 control-label required')) }}
        <div class="col-lg-4">
          @foreach ( $categories AS $key => $value )
          <div class="checkbox">
            <label>
              {{ Form::checkbox('categories[]', $key, in_array($key, $user['categories'])) }}
              {{ $value }}
            </label>
          </div>
          @endforeach
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('description', 'Description', array('class'=>'col-lg-2 control-label')) }}
        <div class="col-lg-10">
          {{ Form::textarea('description', $user['description'], array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('profile_photo', 'Profile Photo', array('class'=>'col-lg-2 control-label')) }}
        <div class="col-lg-10">
          @if (isset($user['profile_photo']))
          <img src="{{ $user['profile_photo'].'?token='.Session::get('user_token').'&_id='.date_timestamp_get(date_create()) }}" />
          @endif
          {{ Form::file('profile_photo', array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('personal_link', 'Personal Link', array('class'=>'col-lg-2 control-label')) }}
        <div class="col-lg-10">
          {{ Form::text('personal_link', $user['personal_link'], array('class'=>'form-control')) }}
        </div>
      </div>
      
      <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
          {{ Form::submit('Update User Info', array('class'=>'btn btn-info')) }}
        </div>
      </div>

    {{ Form::close() }}
  </div>
  @endif

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