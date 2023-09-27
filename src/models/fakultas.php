<?php

require __DIR__ . "/../logger.php";

class Fakultas
{
  public string $kodeFakultas;
  public string $namaFakultas;
}

class FakultasRepository
{
  private PDO $dbh;

  function __construct()
  {
    try {
      $this->dbh = new Database();
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Could not connect database: " . $e->getMessage());
      throw $e;
    }

    try {
      $stmt = <<<SQL
        CREATE TABLE IF NOT EXISTS Fakultas (
          kodeFakultas VARCHAR(5) PRIMARY KEY,
          namaFakultas VARCHAR(100) NOT NULL
        )
      SQL;
      $this->dbh->exec($stmt);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to create table `Fakultas`: " . $e->getMessage());
      throw $e;
    }
  }

  function getFakultasList(): array
  {
    try {
      return $this->dbh->query("SELECT * FROM Fakultas")->fetchAll(PDO::FETCH_CLASS, "Fakultas");
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `Fakultas`: " . $e->getMessage());
      return [];
    }
  }

  function getFakultas(string $kodeFakultas): ?Fakultas
  {
    try {
      $stmt = $this->dbh->prepare("SELECT * FROM Fakultas WHERE kodeFakultas=? LIMIT 1");
      $stmt->execute([$kodeFakultas]);
      $stmt->setFetchMode(PDO::FETCH_CLASS, "Fakultas");
      return $stmt->fetch();
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `Fakultas`: " . $e->getMessage());
      return null;
    }
  }

  function insertFakultas(string $kodeFakultas, string $namaFakultas)
  {
    try {
      $query = "INSERT INTO Fakultas (kodeFakultas, namaFakultas) VALUES (?, ?)";
      $stmt = $this->dbh->prepare($query);
      $stmt->execute([$kodeFakultas, $namaFakultas]);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to insert into `Fakultas`: " . $e->getMessage());
      throw $e;
    }
  }

  function updateFakultas(string $kodeFakultas, string $namaFakultas)
  {
    try {
      $query = " UPDATE Fakultas SET namaFakultas=? WHERE kodeFakultas=?";
      $stmt = $this->dbh->prepare($query);
      $stmt->execute([$namaFakultas, $kodeFakultas]);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to update `Fakultas`: " . $e->getMessage());
      throw $e;
    }
  }

  function deleteFakultas(string $kodeFakultas)
  {
    try {
      $query = "DELETE FROM Fakultas WHERE kodeFakultas=?";
      $stmt = $this->dbh->prepare($query);
      $stmt->execute([$kodeFakultas]);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to delete from `Fakultas`: " . $e->getMessage());
      throw $e;
    }
  }
}
