<?php

class Database extends PDO
{
  public string $host = $_ENV["DB_HOST"];
  public int $port = $_ENV["DB_PORT"];
  public string $dbname = $_ENV["POSTGRES_DB"];
  public string $username = $_ENV["POSTGRES_USER"];

  public function __construct()
  {
    $password = $_ENV["POSTGRES_PASSWORD"];
    parent::__construct("pgsql:host=$this->host;port=$this->port;dbname=$this->dbname", $this->username, $password);
    $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
}
