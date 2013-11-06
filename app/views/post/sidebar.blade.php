<ul class="nav">
  <li><a href="{{ URL::route('user_posts') }}">GET <code>/&lt;uid&gt;/posts</code></a></li>
  <li><a href="{{ URL::route('user_likes') }}">GET <code>/&lt;uid&gt;/likes</code></a></li>
  <li><a href="{{ URL::route('create_post') }}">POST <code>/post</code></a></li>
  <li><a href="{{ URL::route('read_post') }}">GET <code>/post/&lt;post_id&gt;</code></a></li>
  <li><a href="{{ URL::route('edit_post') }}">POST <code>/post/&lt;post_id&gt; (pending)</code></a></li>
  <li><a href="{{ URL::route('delete_post') }}">DELETE <code>/post/&lt;post_id&gt;</code></a></li>
</ul>