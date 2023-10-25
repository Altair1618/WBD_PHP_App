<?php

class ProgramStudiRepository extends Model
{
  function getProgramStudiList(): array
  {
    try {
      return $this->db->fetchAll("SELECT * FROM program_studi ORDER BY kode ASC");
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `program_studi`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function getProgramStudi(string $kode): array|false
  {
    try {
      return $this->db->fetch("SELECT * FROM program_studi WHERE kode=$1 LIMIT 1", [$kode]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `program_studi`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function getProgramStudiByFakultas(string $kode_fakultas): array|false
  {
    try {
      return $this->db->fetchAll("SELECT * FROM program_studi WHERE kode_fakultas = $1 ORDER BY kode ASC", [$kode_fakultas]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `program_studi`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function insertProgramStudi(string $kode, string $nama)
  {
    try {
      $query = "INSERT INTO program_studi (kode, nama) VALUES ($1, $2)";
      $this->db->execute($query, [$kode, $nama]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to insert into `program_studi`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function updateProgramStudi(string $kode, string $nama, string $kode_fakultas)
  {
    try {
      $query = "UPDATE program_studi SET nama=$1, kode_fakultas=$2 WHERE kode=$3";
      $this->db->execute($query, [$nama, $kode_fakultas, $kode]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to update `program_studi`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function deleteProgramStudi(string $kode)
  {
    try {
      $query = "DELETE FROM program_studi WHERE kode=$1";
      $this->db->execute($query, [$kode]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to delete from `program_studi`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }
}
