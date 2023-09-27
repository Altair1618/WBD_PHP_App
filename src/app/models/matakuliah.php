<?php

require_once __DIR__ . "/../utils/logger.php";
require_once __DIR__ . "/../utils/database.php";

class MataKuliahRepository
{
  private $db = new Database();

  function getMataKuliahList(): array
  {
    try {
      return $this->db->fetchAll("SELECT * FROM mata_kuliah");
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `mata_kuliah`: " . $e->getMessage());
      throw $e;
    }
  }

  function getMataKuliah(string $kode): array
  {
    try {
      return $this->db->fetch("SELECT * FROM mata_kuliah WHERE kode=? LIMIT 1", [$kode]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `mata_kuliah`: " . $e->getMessage());
      return null;
    }
  }

  function insertMataKuliah(string $kode, string $nama, ?string $deskripsi, ?string $kode_program_studi)
  {
    try {
      $query = "INSERT INTO mata_kuliah (kode, nama, deskripsi, kode_program_studi) VALUES (?, ?, ?, ?)";
      $this->db->execute($query, [$kode, $nama, $deskripsi, $kode_program_studi]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to insert into `mata_kuliah`: " . $e->getMessage());
      throw $e;
    }
  }

  function updateMataKuliah(string $kode, string $nama, string $deskripsi, ?string $kode_program_studi)
  {
    try {
      $query = " UPDATE mata_kuliah SET nama=?, deskripsi=?, kode_program_studi=? WHERE kode=?";
      $this->db->execute($query, [$nama, $deskripsi, $kode_program_studi, $kode]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to update `mata_kuliah`: " . $e->getMessage());
      throw $e;
    }
  }

  function deleteMataKuliah(string $kode)
  {
    try {
      $query = "DELETE FROM mata_kuliah WHERE kode=?";
      $this->db->execute($query, [$kode]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to delete from `mata_kuliah`: " . $e->getMessage());
      throw $e;
    }
  }
}
