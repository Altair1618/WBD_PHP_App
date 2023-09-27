<?php

require_once __DIR__ . "/../logger.php";
require_once __DIR__ . "/../db/db.php";

class User
{
  public int $idPengguna;
  public string $username;
  public string $email;
  public string $passwordHash;
  public string $namaDepan;
  public string $namaDelakang;
  public int $tipe;
  public ?string $kodeJurusan;

  public function is_admin(): bool
  {
    return $this->tipe === 0;
  }

  public function is_dosen(): bool
  {
    return $this->tipe === 1;
  }

  public function is_mahasiswa(): bool
  {
    return $this->tipe === 2;
  }
}

class UserRepository
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
        CREATE TABLE IF NOT EXISTS Pengguna (
          idPengguna SERIAL PRIMARY KEY,
          username VARCHAR(40) NOT NULL UNIQUE,
          email VARCHAR(254) NOT NULL, passwordHash CHAR(60) NOT NULL,
          namaDepan VARCHAR(40) NOT NULL,
          namaBelakang VARCHAR(40),
          tipe SMALLINT,
          kodeJurusan VARCHAR(4)
        );
      SQL;
      $this->dbh->exec($stmt);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to create table `Pengguna`: " . $e->getMessage());
      throw $e;
    }
  }

  function getUserList(): array
  {
    try {
      return $this->dbh->query("SELECT * FROM Pengguna")->fetchAll(PDO::FETCH_CLASS, "User");
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `Pengguna`: " . $e->getMessage());
      return [];
    }
  }

  function getUser(int|string $id_or_username): ?User
  {
    try {
      if (is_int($id_or_username)) {
        $query = "SELECT * FROM Pengguna WHERE idPengguna=? LIMIT 1";
      } else {
        $query = "SELECT * FROM Pengguna WHERE username=? LIMIT 1";
      }
      $stmt = $this->dbh->prepare($query);
      $stmt->execute([$id_or_username]);
      $stmt->setFetchMode(PDO::FETCH_CLASS, "User");
      return $stmt->fetch();
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `Pengguna`: " . $e->getMessage());
      return null;
    }
  }

  function insertUser(string $username, string $email, string $passwordHash, string $namaDepan, string $namaBelakang, int $tipe, ?string $kodeJurusan = null)
  {
    try {
      $query = <<<SQL
        INSERT INTO Pengguna (username, email, passwordHash, namaDepan, namaBelakang, tipe, kodeJurusan)
        VALUES (:username, :email, :passwordHash, :namaDepan, :namaBelakang, :tipe, :kodeJurusan);
      SQL;
      $stmt = $this->dbh->prepare($query);
      $stmt->execute([
        "username" => $username,
        "email" => $email,
        "passwordHash" => $passwordHash,
        "namaDepan" => $namaDepan,
        "namaBelakang" => $namaBelakang,
        "tipe" => $tipe,
        "kodeJurusan" => $kodeJurusan
      ]);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to insert into `Pengguna`: " . $e->getMessage());
      throw $e;
    }
  }

  function updateUser(int $id, string $username, string $email, string $namaDepan, string $namaBelakang)
  {
    try {
      $query = <<<SQL
        UPDATE Pengguna 
        SET username = :username,
            email = :email,
            namaDepan = :namaDepan,
            namaBelakang = :namaBelakang,
        WHERE idPengguna = :idPengguna;
      SQL;
      $stmt = $this->dbh->prepare($query);
      $stmt->execute([
        "idPengguna" => $id,
        "username" => $username,
        "email" => $email,
        "namaDepan" => $namaDepan,
        "namaBelakang" => $namaBelakang,
      ]);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to update `Pengguna`: " . $e->getMessage());
      throw $e;
    }
  }

  function deleteUser(int|string $id_or_username)
  {
    try {
      if (is_int($id_or_username)) {
        $query = "DELETE FROM Pengguna WHERE idPengguna=?";
      } else {
        $query = "DELETE FROM Pengguna WHERE username=?";
      }
      $stmt = $this->dbh->prepare($query);
      $stmt->execute([$id_or_username]);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to delete from `Pengguna`: " . $e->getMessage());
      throw $e;
    }
  }

  function changePassword(int|string $id_or_username, string $new_password_hash)
  {
    try {
      if (is_int($id_or_username)) {
        $query = "UPDATE Pengguna SET passwordHash=? WHERE idPengguna=?";
      } else {
        $query = "UPDATE Pengguna SET passwordHash=? WHERE username=?";
      }
      $stmt = $this->dbh->prepare($query);
      $stmt->execute([$new_password_hash, $id_or_username]);
    } catch (PDOException $e) {
      Logger::error(__FILE__, __LINE__, "Failed to update `Pengguna`: " . $e->getMessage());
      throw $e;
    }
  }
}
