<?php

$app->get('/password-reset', $guest(), function() use ($app) {

  $request = $app->request();

  $email = $request->get('email');
  $identifier = $request->get('identifier');

  $hashedIdentifier = $app->hash->hash($identifier);

  $user = $app->user->where('email', $email)->first();

  // check user exists and hash values match
  if (!$user ||
      !$user->recover_hash ||
      !$app->hash->hashCheck($user->recover_hash, $hashedIdentifier)) {
    return $app->response->redirect($app->urlFor('home'));
  }

  $app->render('auth/password/reset.php', [
    'email' => $user->email,
    'identifier' => $identifier
  ]);

})->name('password.reset');

$app->post('/password-reset', $guest(), function() use ($app) {

  $request = $app->request();

  $email = $request->get('email');
  $identifier = $request->get('identifier');

  $password = $request->post('password');
  $passwordConfirm = $request->post('password_confirm');

  $hashedIdentifier = $app->hash->hash($identifier);

  $user = $app->user->where('email', $email)->first();

  // check user exists and hash values match
  if (!$user ||
      !$user->recover_hash ||
      !$app->hash->hashCheck($user->recover_hash, $hashedIdentifier)) {
    return $app->response->redirect($app->urlFor('home'));
  }

  $v = $app->validation;

  $v->validate([
    'password' => [$password, 'required|min(6)'],
    'password_confirm' => [$passwordConfirm, 'required|matches(password)'],
  ]);

  if ($v->passes()) {

    $app->user->update([
      'password' => $app->hash->password($password),
      'recover_hash' => null
    ]);

    $app->flash('global', 'Your password has been reset. You can now log in.');
    return $app->response->redirect($app->urlFor('home'));
  }

  $app->render('auth/password/reset.php', [
    'errors' => $v->errors(),
    'email' => $user->email,
    'identifier' => $identifier
  ]);

})->name('password.reset.post');