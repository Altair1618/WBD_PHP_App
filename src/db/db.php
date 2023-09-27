<?php

class Database extends PDO
{
  public string $host;
  public int $port;
  public string $dbname;
  public string $username;

  public function __construct()
  {
    $this->host = $_ENV["DB_HOST"];
    $this->port = $_ENV["DB_PORT"];
    $this->dbname = $_ENV["POSTGRES_DB"];
    $this->username = $_ENV["POSTGRES_USER"];
    $password = $_ENV["POSTGRES_PASSWORD"];
    parent::__construct("pgsql:host=$this->host;port=$this->port;dbname=$this->dbname", $this->username, $password);
    $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
}
