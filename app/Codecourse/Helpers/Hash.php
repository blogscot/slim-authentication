<?php

namespace Codecourse\Helpers;

class Hash {

  protected $config;

  public function __construct($config) {
      $this->config = $config;
  }

  public function password($password) {
    return password_hash($password,
                         $this->config->get('app.hash.algo'),
                         ['cost' => $this->config->get('app.hash.cost')]);
  }

  public function passwordCheck($password, $hash) {
    return password_verify($password, $hash);
  }

  public function hash($input) {
    return hash('sha256', $input);
  }

  protected function hash_equals($a, $b) {
      return substr_count($a ^ $b, "\0") * 2 === strlen($a . $b);
  }

  public function hashCheck($known, $user) {
    return $this->hash_equals($known, $user);
  }
}