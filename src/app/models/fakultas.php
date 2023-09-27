<?php

require_once __DIR__ . "/../utils/logger.php";
require_once __DIR__ . "/../utils/database.php";

class FakultasRepository
{
  private $db = new Database();

  function getFakultasList(): array
  {
    try {
      return $this->db->fetchAll("SELECT * FROM fakultas");
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `fakultas`: " . $e->getMessage());
      throw $e;
    }
  }

  function getFakultas(string $kode): array
  {
    try {
      return $this->db->fetch("SELECT * FROM fakultas WHERE kode=? LIMIT 1", [$kode]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `fakultas`: " . $e->getMessage());
      throw $e;
    }
  }

  function insertFakultas(string $kode, string $nama)
  {
    try {
      $query = "INSERT INTO fakultas (kode, nama) VALUES (?, ?)";
      $this->db->execute($query, [$kode, $nama]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to insert into `fakultas`: " . $e->getMessage());
      throw $e;
    }
  }

  function updateFakultas(string $kode, string $nama)
  {
    try {
      $query = " UPDATE fakultas SET nama=? WHERE kode=?";
      $this->db->execute($query, [$nama, $kode]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to update `fakultas`: " . $e->getMessage());
      throw $e;
    }
  }

  function deleteFakultas(string $kode)
  {
    try {
      $query = "DELETE FROM fakultas WHERE kode=?";
      $this->db->execute($query, [$kode]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to delete from `fakultas`: " . $e->getMessage());
      throw $e;
    }
  }
}
