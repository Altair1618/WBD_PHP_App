<?php

class MataKuliahRepository extends Model
{
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
      return $this->db->fetch("SELECT * FROM mata_kuliah WHERE kode=$1 LIMIT 1", [$kode]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `mata_kuliah`: " . $e->getMessage());
      return null;
    }
  }

  function insertMataKuliah(string $kode, string $nama, ?string $deskripsi, ?string $kode_program_studi)
  {
    try {
      $query = "INSERT INTO mata_kuliah (kode, nama, deskripsi, kode_program_studi) VALUES ($1, $2, $3, $4)";
      $this->db->execute($query, [$kode, $nama, $deskripsi, $kode_program_studi]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to insert into `mata_kuliah`: " . $e->getMessage());
      throw $e;
    }
  }

  function updateMataKuliah(string $kode, string $nama, string $deskripsi, ?string $kode_program_studi)
  {
    try {
      $query = "UPDATE mata_kuliah SET nama=$1, deskripsi=$2, kode_program_studi=$3 WHERE kode=$4";
      $this->db->execute($query, [$nama, $deskripsi, $kode_program_studi, $kode]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to update `mata_kuliah`: " . $e->getMessage());
      throw $e;
    }
  }

  function deleteMataKuliah(string $kode)
  {
    try {
      $query = "DELETE FROM mata_kuliah WHERE kode=$1";
      $this->db->execute($query, [$kode]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to delete from `mata_kuliah`: " . $e->getMessage());
      throw $e;
    }
  }
}
