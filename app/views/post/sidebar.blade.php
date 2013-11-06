<ul class="nav">
  <li><a href="{{ URL::route('userpost') }}">GET <code>/&lt;uid&gt;/posts</code></a></li>
  <li><a href="{{ URL::route('userlike') }}">GET <code>/&lt;uid&gt;/likes</code></a></li>
  <li><a href="{{ URL::route('createpost') }}">POST <code>/post</code> (pending)</a></li>
  <li><a href="{{ URL::route('readpost') }}">GET <code>/post/&lt;post_id&gt;</code></a></li>
  <li><a href="{{ URL::route('editpost') }}">POST <code>/post/&lt;post_id&gt;</code></a></li>
  <li><a href="{{ URL::route('deletepost') }}">DELETE <code>/post/&lt;post_id&gt;</code></a></li>
</ul>