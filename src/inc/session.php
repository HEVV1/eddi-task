<?php

class Session
{
  private $lang;
  public function session()
  {
    session_start();
    if (isset($_SESSION['lang'])) {
      $this->lang = $_SESSION['lang'];
    } else {
      $this->lang = substr($_COOKIE["app_login"], 0, 1);
      $_SESSION['lang'] = $this->lang;
    }
  }
}
