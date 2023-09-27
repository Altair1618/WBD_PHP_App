<?php

require_once __DIR__ . "/../logger.php";
require_once __DIR__ . "/../db/db.php";

class MateriKelas
{
  public int $idMateriKelas;
  public int $noUrutModul;
  public string $kodeMataKuliah;
  public string $judulTopik;
  public int $tipe;
  public string $namaFile;
  public ?string $deskripsi;

  public function is_presentasi(): bool
  {
    return $this->tipe === 0;
  }

  public function is_video(): bool
  {
    return $this->tipe === 1;
  }
}

class MateriKelasRepository
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
        CREATE TABLE IF NOT EXISTS MateriKelas (
          idMateriKelas SERIAL PRIMARY KEY,
          noUrutModul INT,
          kodeMataKuliah VARCHAR(7),
          judulTopik VARCHAR(100) NOT NULL,
          tipe SMALLINT NOT NULL,
          namaFile VARCHAR(255) NOT NULL,
          deskripsi TEXT,
          FOREIGN KEY (noUrutModul, kodeMataKuliah) REFERENCES Modul(noUrutModul, kodeMataKuliah) ON DELETE SET NULL
        )
      SQL;
      $this->dbh->exec($stmt);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to create table `MateriKelas`: " . $e->getMessage());
      throw $e;
    }
  }

  function getMateriKelasList(): array
  {
    try {
      return $this->dbh->query("SELECT * FROM MateriKelas")->fetchAll(PDO::FETCH_CLASS, "MateriKelas");
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `MateriKelas`: " . $e->getMessage());
      return [];
    }
  }

  function getMateriKelas(int $idMateriKelas): ?MateriKelas
  {
    try {
      $stmt = $this->dbh->prepare("SELECT * FROM MateriKelas WHERE idMateriKelas=? LIMIT 1");
      $stmt->execute([$idMateriKelas]);
      $stmt->setFetchMode(PDO::FETCH_CLASS, "MateriKelas");
      return $stmt->fetch();
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `MateriKelas`: " . $e->getMessage());
      return null;
    }
  }

  function insertMateriKelas(int $noUrutModul, string $kodeMataKuliah, string $judulTopik, int $tipe, string $namaFile, ?string $deskripsi)
  {
    try {
      $query = "INSERT INTO MateriKelas (noUrutModul, kodeMataKuliah, judulTopik, tipe, namaFile, deskripsi) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $this->dbh->prepare($query);
      $stmt->execute([$noUrutModul, $kodeMataKuliah, $judulTopik, $tipe, $namaFile, $deskripsi]);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to insert into `MateriKelas`: " . $e->getMessage());
      throw $e;
    }
  }

  function updateMateriKelas(int $idMateriKelas, int $noUrutModul, string $kodeMataKuliah, string $judulTopik, int $tipe, string $namaFile, ?string $deskripsi)
  {
    try {
      $query = " UPDATE MateriKelas SET noUrutModul=?, kodeMataKuliah=?, judulTopik=?, tipe=?, namaFile=? deskripsi=? WHERE idMateriKelas=?";
      $stmt = $this->dbh->prepare($query);
      $stmt->execute([$noUrutModul, $kodeMataKuliah, $judulTopik, $tipe, $namaFile, $deskripsi, $idMateriKelas]);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to update `MateriKelas`: " . $e->getMessage());
      throw $e;
    }
  }

  function deleteMateriKelas(int $idMateriKelas)
  {
    try {
      $query = "DELETE FROM MateriKelas WHERE idMateriKelas=?";
      $stmt = $this->dbh->prepare($query);
      $stmt->execute([$idMateriKelas]);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to delete from `MateriKelas`: " . $e->getMessage());
      throw $e;
    }
  }
}
