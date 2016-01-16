<?php

$app->get('/activate', function() use ($app) {
  $request = $app->request;

  $email = $request->get('email');
  $identifier = $request->get('identifier');

  $hashedIdentifier = $app->hash->hash($identifier);
  var_dump($identifier);
  var_dump($hashedIdentifier);

  $user = $app->user->where('email', $email)
    ->where('active', false)
    ->first();

  if (! $user || !$app->hash->hashCheck($user->active_hash, $hashedIdentifier)) {
    var_dump($user->active_hash);
    die();

    $app->flash('global', 'There was a problem activating your account.');
    $app->response->redirect($app->urlFor('home'));
  } else {
    $user->activateAccount();
    $app->flash('global', 'Your account has been activated and you can now sign in.');
    $app->response->redirect($app->urlFor('login'));

  }
})->name('activate');