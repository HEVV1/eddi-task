<?php

class DBConnection
{
  private $servername;
  private $username;
  private $password;
  private $dbname;

  protected function connect()
  {
    $this->servername = "localhost";
    $this->username = "root";
    $this->password = "";
    $this->dbname = "mysqldb";
    $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    if ($conn->ping()) {
      return $conn;
    } else {
      $this->Error_Handler("Error in mysql_connect", $conn);
    }
  }
  private function Error_Handler($msg, &$cnx)
  {
    echo "$msg \n";
    $cnx->close();
  }
}
