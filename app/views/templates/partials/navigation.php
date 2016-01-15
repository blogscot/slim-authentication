{% if auth %}
  <p> Hello, {{auth.getFullNameOrUsername}}! </p>
{% endif %}


<ul>
  <li><a href="{{ urlFor('home') }}">Home</a> </li>
  {% if not auth %}
    <li><a href="{{ urlFor('register') }}">Register</a> </li>
    <li><a href="{{ urlFor('login') }}">Login</a> </li>
  {% endif %}
</ul>