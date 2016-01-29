{% extends 'templates/default.php' %}

{% block title %}Change Password{% endblock %}

{% block content %}
  <form action="{{urlFor('password.change.post')}}"
    method="post" autocomplete="off">
    <div>
      <label for="password_old">Old password</label>
      <input type="password" name="password_old" id="password_old">
      {% if errors.has('password_old') %} {{ errors.first('password_old') }} {% endif %}
    </div>
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
      <input type="submit" value="Change">
    </div>

    <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
  </form>
{% endblock %}