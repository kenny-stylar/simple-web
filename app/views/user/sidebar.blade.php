<ul class="nav">
  <li><a href="{{ URL::route('user_register') }}">POST <code>/register</code></a></li>
  <li><a href="{{ URL::route('user_login') }}">POST <code>/login</code></a></li>
  <li><a href="{{ URL::route('user_logout') }}">GET <code>/logout</code></a></li>
  <li><a href="{{ URL::route('user_password') }}">POST <code>/&lt;uid&gt;/change-password</code></a></li>
  <li><a href="{{ URL::route('user_info') }}">GET <code>/&lt;uid&gt;</code></a></li>
  <li><a href="{{ URL::route('user_update') }}">POST <code>/&lt;uid&gt;</code></a></li>
  <li><a href="{{ URL::route('user_provisioning') }}">POST <code>/&lt;uid&gt;/provisioning</code></a></li>
  <li><a href="{{ URL::route('user_profilepic') }}">GET <code>/&lt;uid&gt;/profile-photo</code></a></li>
</ul>