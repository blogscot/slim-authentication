<?php

$app->get('/logout', $authenticated(), function() use($app) {
  unset($_SESSION[$app->config->get('auth.session')]);
  $app->flash('global', 'You have been logged out.');
  $app->response->redirect($app->urlFor('home'));
})->name('logout');