{% extends 'templates/default.php' %}

{% block title %}Reset Password{% endblock %}

{% block content %}
  <form action="{{urlFor('password.reset.post')}}?email={{ email }}&identifier={{ identifier|url_encode }}" method="post" autocomplete="off">
    <div>
      <label for="password">New password</label>
      <input type="password" name="password" id="password">
      {% if errors.has('password') %} {{ errors.first('password') }} {% endif %}
    </div>
    <div>
      <label for="password_confirm">Confirm new password</label>
      <input type="password" name="password_confirm" id="password_confirm">
      {% if errors.has('password_confirm') %} {{ errors.first('password_confirm') }} {% endif %}
    </div>
    <div>
      <input type="submit" value="Submit">
    </div>

    <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
  </form>
{% endblock %}