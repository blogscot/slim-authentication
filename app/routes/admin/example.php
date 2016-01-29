<?php

$app->get('/admin/example', $admin(), function() use ($app) {
  $app->render('admin/example.php');
})->name('admin.example');