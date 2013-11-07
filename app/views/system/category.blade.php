@extends('layout.master')

@section('content')
  <div class="page-header">
    <h1>Request Params</h1>
  </div>

  <p>No Params needed.</p>

  <p>&nbsp;</p>
  <div class="page-header">
    <h1>Response Body</h1>
  </div>

  <p><b>* Request URL (reference only):</b><br><code>{{ $request_url }}</code></p>

  <div class="result">
    @if ($result['status'])
    {{ CommonHelper::preEcho($result['output']) }}
    @else
    <div class="alert alert-danger">
      {{ array_get($result, 'output.message') }}
    </div>
    @endif
  </div>
@stop

@section('sidebar')
@if ( !empty($sidebar) )
{{ $sidebar }}
@endif
@stop