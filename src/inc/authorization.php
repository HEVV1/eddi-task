<?php

class Authorization extends DBConnection
{

  protected function login($cookieName)
  {
    setcookie("login_name", $cookieName);
    $login = substr($_COOKIE["login_name"], 1, 50);

    $cur = "SELECT permission_item from permissions where permission_user='$login' and permission_item='orders'";
    $grant = $this->connect()->query($cur);

    return $grant;
  }
}
