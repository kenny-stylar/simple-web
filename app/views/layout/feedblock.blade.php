@if (count($feeds) > 0)
@foreach($feeds as $post)
<div id="{{ $post['post_id'] }}" class="feedblock">
  <div class="fname">{{ $post['place_name'] }}</div>
  <div class="address">{{ $post['location']['formatted_address'] }}</div>
</div>
@endforeach
@else
<div class="alert alert-warning">
  No Record
</div>
@endif