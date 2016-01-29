{% extends 'templates/default.php' %}

{% block title %}{{ user.getFullNameOrUsername }}{% endblock %}

{% block content %}
  <h2>{{ user.username }}</h2>
  <img src="{{ user.getAvatarUrl({size: 80}) }}"
      alt="Profile picture for {{ user.getFullNameOrUsername }}" />

  <div>
    {% if user.getFullName %}
      <label>Full name</label>
      <span>{{ user.getFullName }}</span>
      {% endif %}
  </div>

  <div>
    <label>Email</label>
    <span>{{ user.email }}</span>
  </div>

{% endblock %}