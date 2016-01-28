<?php

namespace Codecourse\Middleware;

use Slim\Middleware;

class BeforeMiddleware extends Middleware {

  public function call() {
    $this->app->hook('slim.before', [$this, 'run']);
    $this->next->call();
  }

  public function run() {
    if (isset($_SESSION[$this->app->config->get('auth.session')])) {
      // user is authenticated
      $this->app->auth = $this->app->user->where('id',
          $_SESSION[$this->app->config->get('auth.session')])->first();
    }

    $this->checkRememberMe();

    $this->app->view()->appendData([
      'auth' => $this->app->auth,
      'baseUrl' => $this->app->config->get('app.url')
    ]);
  }

  protected function checkRememberMe() {
    $cookieName = $this->app->config->get('auth.remember');

    if ($this->app->getCookie($cookieName) && !$this->app->auth) {
         $data = $this->app->getCookie($cookieName);
         $credentials = explode('___', $data);  // php destructuring

         if (empty(trim($data)) || count($credentials) !== 2) {
           $this->app->response->redirect($this->app->urlFor('home'));
         } else {
           $identifier = $credentials[0];
           $token = $this->app->hash->hash($credentials[1]);

           // find if user is remembered in the DB
           $user = $this->app->user
            ->where('remember_identifier', $identifier)
            ->first();

            if ($user) {
              // check if tokens match
              if ($this->app->hash->hashCheck($token, $user->remember_token)) {
                $_SESSION[$this->app->config->get('auth.session')] = $user->id;
                $this->app->auth = $this->app->user->where('id', $user->id)->first();
              } else {
                // remove remember identifier, token pair on failure
                $user->removeRememberCredentials();
              }
            }
         }
    }
  }
}