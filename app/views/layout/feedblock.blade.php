@if (count($feeds) > 0)
@foreach($feeds as $post)
<div id="{{ $post['post_id'] }}" class="feedblock">
  <div class="fname">{{ $post['place_name'] }}</div>
  <div class="faddress">{{ $post['location']['formatted_address'] }}</div>
  @if (!empty($post['photos'][0]['m']['url']))
  <div class="fimage"><img src="{{ CommonHelper::appendToken($post['photos'][0]['m']['url']) }}" /></div>
  @endif
  <div class="fdesc">{{ $post['message'] }}</div>
</div>
@endforeach
@else
<div class="alert alert-warning">
  No Record
</div>
@endif