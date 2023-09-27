<?php

require __DIR__ . "/../logger.php";
require __DIR__ . "/../db/db.php";

class Modul
{
  public int $noUrutModul;
  public string $kodeMataKuliah;
  public string $namaModul;
  public ?string $deskripsi;
}

class ModulRepository
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
        CREATE TABLE IF NOT EXISTS Modul (
          noUrutModul INT,
          kodeMataKuliah VARCHAR(7) REFERENCES MataKuliah(kodeMataKuliah) ON DELETE SET NULL
          namaModul VARCHAR(100) NOT NULL,
          deskripsi TEXT,
          PRIMARY KEY (noUrutModul, kodeMataKuliah)
        )
      SQL;
      $this->dbh->exec($stmt);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to create table `Modul`: " . $e->getMessage());
      throw $e;
    }
  }

  function getModulList(): array
  {
    try {
      return $this->dbh->query("SELECT * FROM Modul")->fetchAll(PDO::FETCH_CLASS, "Modul");
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `Modul`: " . $e->getMessage());
      return [];
    }
  }

  function getModul(int $noUrutModul, string $kodeMataKuliah): ?Modul
  {
    try {
      $stmt = $this->dbh->prepare("SELECT * FROM Modul WHERE noUrutModu=? AND kodeMataKuliah=? LIMIT 1");
      $stmt->execute([$noUrutModul, $kodeMataKuliah]);
      $stmt->setFetchMode(PDO::FETCH_CLASS, "Modul");
      return $stmt->fetch();
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `Modul`: " . $e->getMessage());
      return null;
    }
  }

  function insertModul(int $noUrutModul, string $kodeMataKuliah, string $namaModul, ?string $deskripsi)
  {
    try {
      $query = "INSERT INTO Modul (noUrutModul, kodeMataKuliah, namaModul, deskripsi) VALUES (?, ?, ?, ?)";
      $stmt = $this->dbh->prepare($query);
      $stmt->execute([$noUrutModul, $kodeMataKuliah, $namaModul, $deskripsi]);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to insert into `Modul`: " . $e->getMessage());
      throw $e;
    }
  }

  function updateModul(int $noUrutModul, string $kodeMataKuliah, string $namaModul, ?string $deskripsi)
  {
    try {
      $query = " UPDATE Modul SET namaModul=?, deskripsi=?, kodeJurusan=? WHERE noUrutModul=? AND kodeMataKuliah=?";
      $stmt = $this->dbh->prepare($query);
      $stmt->execute([$namaModul, $deskripsi, $noUrutModul, $kodeMataKuliah]);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to update `Modul`: " . $e->getMessage());
      throw $e;
    }
  }

  function deleteModul(int $noUrutModul, string $kodeMataKuliah)
  {
    try {
      $query = "DELETE FROM Modul WHERE noUrutModul=? AND kodeMataKuliah=?";
      $stmt = $this->dbh->prepare($query);
      $stmt->execute([$noUrutModul, $kodeMataKuliah]);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to delete from `Modul`: " . $e->getMessage());
      throw $e;
    }
  }
}
