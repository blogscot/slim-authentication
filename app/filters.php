<?php

/*
 * Middleware to stop authenticated users from accessing login and register pages
 *
 */

$authenticationCheck = function($required) use ($app) {
  return function() use ($required, $app) {
    if ((!$app->auth && $required) || ($app->auth && !$required)) {
      $app->redirect($app->urlFor('home'));
    }
  };
};

$authenticated = function() use ($authenticationCheck){
  return $authenticationCheck(true);
};

$guest = function() use ($authenticationCheck){
  return $authenticationCheck(false);
};