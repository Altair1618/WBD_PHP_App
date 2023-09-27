<?php

require __DIR__ . "/../logger.php";
require __DIR__ . "/../db/db.php";

class MataKuliah
{
  public string $kodeMataKuliah;
  public string $namaMataKuliah;
  public ?string $deskripsi;
  public ?string $kodeJurusan;
}

class MataKuliahRepository
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
        CREATE TABLE IF NOT EXISTS MataKuliah (
          kodeMataKuliah VARCHAR(7) PRIMARY KEY,
          namaMataKuliah VARCHAR(100) NOT NULL,
          deskripsi TEXT,
          kodeJurusan REFERENCES Jurusan(kodeJurusan) ON DELETE SET NULL
        )
      SQL;
      $this->dbh->exec($stmt);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to create table `MataKuliah`: " . $e->getMessage());
      throw $e;
    }
  }

  function getMataKuliahList(): array
  {
    try {
      return $this->dbh->query("SELECT * FROM MataKuliah")->fetchAll(PDO::FETCH_CLASS, "MataKuliah");
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `MataKuliah`: " . $e->getMessage());
      return [];
    }
  }

  function getMataKuliah(string $kodeMataKuliah): ?MataKuliah
  {
    try {
      $stmt = $this->dbh->prepare("SELECT * FROM MataKuliah WHERE kodeMataKuliah=? LIMIT 1");
      $stmt->execute([$kodeMataKuliah]);
      $stmt->setFetchMode(PDO::FETCH_CLASS, "MataKuliah");
      return $stmt->fetch();
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `MataKuliah`: " . $e->getMessage());
      return null;
    }
  }

  function insertMataKuliah(string $kodeMataKuliah, string $namaMataKuliah, ?string $deskripsi, ?string $kodeJurusan)
  {
    try {
      $query = "INSERT INTO MataKuliah (kodeMataKuliah, namaMataKuliah, deskripsi, kodeJurusan) VALUES (?, ?, ?, ?)";
      $stmt = $this->dbh->prepare($query);
      $stmt->execute([$kodeMataKuliah, $namaMataKuliah, $deskripsi, $kodeJurusan]);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to insert into `MataKuliah`: " . $e->getMessage());
      throw $e;
    }
  }

  function updateMataKuliah(string $kodeMataKuliah, string $namaMataKuliah, ?string $deskripsi, ?string $kodeJurusan)
  {
    try {
      $query = " UPDATE MataKuliah SET namaMataKuliah=?, deskripsi=?, kodeJurusan=? WHERE kodeMataKuliah=?";
      $stmt = $this->dbh->prepare($query);
      $stmt->execute([$namaMataKuliah, $deskripsi, $kodeJurusan, $kodeMataKuliah]);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to update `MataKuliah`: " . $e->getMessage());
      throw $e;
    }
  }

  function deleteMataKuliah(string $kodeMataKuliah)
  {
    try {
      $query = "DELETE FROM MataKuliah WHERE kodeMataKuliah=?";
      $stmt = $this->dbh->prepare($query);
      $stmt->execute([$kodeMataKuliah]);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to delete from `MataKuliah`: " . $e->getMessage());
      throw $e;
    }
  }
}
