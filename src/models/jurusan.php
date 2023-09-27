<?php

require_once __DIR__ . "/../logger.php";
require_once __DIR__ . "/../db/db.php";

class Jurusan
{
  public string $kodeJurusan;
  public string $namaJurusan;
  public string $kodeFakultas;
}

class JurusanRepository
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
        CREATE TABLE IF NOT EXISTS Jurusan (
          kodeJurusan VARCHAR(3) PRIMARY KEY,
          namaJurusan VARCHAR(100) NOT NULL,
          kodeFakultas VARCHAR(5) NOT NULL REFERENCES Fakultas(kodeFakultas) ON DELETE SET NULL
        )
      SQL;
      $this->dbh->exec($stmt);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to create table `Jurusan`: " . $e->getMessage());
      throw $e;
    }
  }

  function getJurusanList(): array
  {
    try {
      return $this->dbh->query("SELECT * FROM Jurusan")->fetchAll(PDO::FETCH_CLASS, "Jurusan");
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `Jurusan`: " . $e->getMessage());
      return [];
    }
  }

  function getJurusan(string $kodeJurusan): ?Jurusan
  {
    try {
      $stmt = $this->dbh->prepare("SELECT * FROM Jurusan WHERE kodeJurusan=? LIMIT 1");
      $stmt->execute([$kodeJurusan]);
      $stmt->setFetchMode(PDO::FETCH_CLASS, "Jurusan");
      return $stmt->fetch();
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `Jurusan`: " . $e->getMessage());
      return null;
    }
  }

  function insertJurusan(string $kodeJurusan, string $namaJurusan)
  {
    try {
      $query = "INSERT INTO Jurusan (kodeJurusan, namaJurusan) VALUES (?, ?)";
      $stmt = $this->dbh->prepare($query);
      $stmt->execute([$kodeJurusan, $namaJurusan]);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to insert into `Jurusan`: " . $e->getMessage());
      throw $e;
    }
  }

  function updateJurusan(string $kodeJurusan, string $namaJurusan, string $kodeFakultas)
  {
    try {
      $query = " UPDATE Jurusan SET namaJurusan=?, kodeFakultas=? WHERE kodeJurusan=?";
      $stmt = $this->dbh->prepare($query);
      $stmt->execute([$namaJurusan, $kodeFakultas, $kodeJurusan]);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to update `Jurusan`: " . $e->getMessage());
      throw $e;
    }
  }

  function deleteJurusan(string $kodeJurusan)
  {
    try {
      $query = "DELETE FROM Jurusan WHERE kodeJurusan=?";
      $stmt = $this->dbh->prepare($query);
      $stmt->execute([$kodeJurusan]);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to delete from `Jurusan`: " . $e->getMessage());
      throw $e;
    }
  }
}
