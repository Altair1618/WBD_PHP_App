<?php

class ModulRepository extends Model
{
  function getModulList(): array
  {
    try {
      return $this->db->fetch("SELECT * FROM modul");
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `modul`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function getModul(int $id): array|false
  {
    try {
      return $this->db->fetch("SELECT * FROM modul WHERE id=$1 LIMIT 1", [$id]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `modul`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function getModulByMatKul(string $kode_mata_kuliah) {
    try {
      return $this->db->fetchAll("SELECT * FROM modul WHERE kode_mata_kuliah=$1", [$kode_mata_kuliah]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `modul`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function insertModul(string $kode_mata_kuliah, string $nama, string $deskripsi)
  {
    try {
      $query = "INSERT INTO modul (kode_mata_kuliah, nama, deskripsi) VALUES ($1, $2, $3)";
      return $this->db->execute($query, [$kode_mata_kuliah, $nama, $deskripsi]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to insert into `modul`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function updateModul(int $id, string $kode_mata_kuliah, string $nama, string $deskripsi)
  {
    try {
      $query = "UPDATE modul SET nama=$1, deskripsi=$2 WHERE id=$3 AND kode_mata_kuliah=$4";
      $this->db->execute($query, [$nama, $deskripsi, $id, $kode_mata_kuliah]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to update `modul`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function deleteModul(int $id)
  {
    try {
      $query = "DELETE FROM modul WHERE id=$1";
      $this->db->execute($query, [$id]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to delete from `modul`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }
}
