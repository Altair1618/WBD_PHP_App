<?php

class PenggunaRepository extends Model
{
  public function getPenggunaList(): array
  {
    try {
      return $this->db->fetchAll("SELECT * FROM pengguna");
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `pengguna`: " . $e->getMessage());
      throw $e;
    }
  }

  function getPengguna(int|string $id_or_username): array
  {
    try {
      if (is_int($id_or_username)) {
        $query = "SELECT * FROM pengguna WHERE id=$1 LIMIT 1";
      } else {
        $query = "SELECT * FROM pengguna WHERE username=$2 LIMIT 1";
      }
      return $this->db->fetch($query, [$id_or_username]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `pengguna`: " . $e->getMessage());
      throw $e;
    }
  }

  function insertPengguna(string $username, string $email, string $password_hash, string $nama_depan, string $nama_belakang, int $tipe, ?string $kode_program_studi = null, ?string $foto_profil = null)
  {
    try {
      $query = "INSERT INTO pengguna (username, email, password_hash, nama_depan, nama_belakang, tipe, kode_program_studi, foto_profil) VALUES ($1, $2, $3, $4, $5, $6, $7, $8)";
      $this->db->execute($query, [$username, $email, $password_hash, $nama_depan, $nama_belakang, $tipe, $kode_program_studi, $foto_profil]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to insert into `pengguna`: " . $e->getMessage());
      throw $e;
    }
  }

  function updatePengguna(int $id, string $username, string $email, string $nama_depan, string $nama_belakang, int $tipe, ?string $kode_program_studi = null, ?string $foto_profil = null)
  {
    try {
      $query = "UPDATE pengguna SET username=$1, email=$2, nama_depan=$3, nama_belakang=$4, tipe=$5, kode_program_studi=$6, foto_profil=$7 WHERE id=$8";
      $this->db->execute($query, [$username, $email, $nama_depan, $nama_belakang, $tipe, $kode_program_studi, $id, $foto_profil]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to update `pengguna`: " . $e->getMessage());
      throw $e;
    }
  }

  function deletePengguna(int|string $id_or_username)
  {
    try {
      if (is_int($id_or_username)) {
        $query = "DELETE FROM pengguna WHERE id=$1";
      } else {
        $query = "DELETE FROM pengguna WHERE username=$2";
      }
      $this->db->execute($query, [$id_or_username]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to delete from `pengguna`: " . $e->getMessage());
      throw $e;
    }
  }

  function changePassword(int|string $id_or_username, string $new_password_hash)
  {
    try {
      if (is_int($id_or_username)) {
        $query = "UPDATE pengguna SET password_hash=$1 WHERE id=$2";
      } else {
        $query = "UPDATE pengguna SET password_hash=$1 WHERE username=$2";
      }
      $this->db->execute($query, [$new_password_hash, $id_or_username]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to update `pengguna`: " . $e->getMessage());
      throw $e;
    }
  }
}
