<?php

$app->get('/users', function() use ($app) {
  $users = $app->user->where('active', true)->get();
  $app->render('user/all.php', [
    'users' => $users
  ]);
})->name('user.all');