<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
  'driver' => $app->config->get('db.driver'),
  'host' =>  $app->config->get('db.host'),
  'database' =>  $app->config->get('db.database'),
  'username' =>  $app->config->get('db.username'),
  'password' =>  $app->config->get('db.password'),
  'charset' =>  $app->config->get('db.charset'),
  'collation' =>  $app->config->get('db.collation'),
  'prefix' =>  $app->config->get('db.prefix')
]);

$capsule->bootEloquent();