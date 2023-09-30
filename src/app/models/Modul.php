<?php

class ModulRepository extends Model
{
  function getModulList(): array
  {
    try {
      return $this->db->fetch("SELECT * FROM modul");
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `modul`: " . $e->getMessage());
      throw $e;
    }
  }

  function getModul(int $no_urut, string $kode_mata_kuliah): array
  {
    try {
      return $this->db->fetch("SELECT * FROM modul WHERE no_urut=? AND kode_mata_kuliah=? LIMIT 1", [$no_urut, $kode_mata_kuliah]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `modul`: " . $e->getMessage());
      throw $e;
    }
  }

  function insertModul(int $no_urut, string $kode_mata_kuliah, string $nama, string $deskripsi)
  {
    try {
      $query = "INSERT INTO modul (no_urut, kode_mata_kuliah, nama, deskripsi) VALUES (?, ?, ?, ?)";
      return $this->db->execute($query, [$no_urut, $kode_mata_kuliah, $nama, $deskripsi]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to insert into `modul`: " . $e->getMessage());
      throw $e;
    }
  }

  function updateModul(int $no_urut, string $kode_mata_kuliah, string $nama, string $deskripsi)
  {
    try {
      $query = " UPDATE modul SET nama=?, deskripsi=? WHERE no_urut=? AND kode_mata_kuliah=?";
      $this->db->execute($query, [$nama, $deskripsi, $no_urut, $kode_mata_kuliah]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to update `modul`: " . $e->getMessage());
      throw $e;
    }
  }

  function deleteModul(int $no_urut, string $kode_mata_kuliah)
  {
    try {
      $query = "DELETE FROM modul WHERE no_urut=? AND kode_mata_kuliah=?";
      $this->db->execute($query, [$no_urut, $kode_mata_kuliah]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to delete from `modul`: " . $e->getMessage());
      throw $e;
    }
  }
}
