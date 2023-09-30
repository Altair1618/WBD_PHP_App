<?php

class ProgramStudiRepository extends Model
{
  function getProgramStudiList(): array
  {
    try {
      return $this->db->fetchAll("SELECT * FROM program_studi");
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `program_studi`: " . $e->getMessage());
      throw $e;
    }
  }

  function getProgramStudi(string $kode): array
  {
    try {
      return $this->db->fetch("SELECT * FROM program_studi WHERE kode=? LIMIT 1", [$kode]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `program_studi`: " . $e->getMessage());
      throw $e;
    }
  }

  function insertProgramStudi(string $kode, string $nama)
  {
    try {
      $query = "INSERT INTO program_studi (kode, nama) VALUES (?, ?)";
      $this->db->execute($query, [$kode, $nama]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to insert into `program_studi`: " . $e->getMessage());
      throw $e;
    }
  }

  function updateProgramStudi(string $kode, string $nama, string $kode_fakultas)
  {
    try {
      $query = "UPDATE program_studi SET nama=?, kode_fakultas=? WHERE kode=?";
      $this->db->execute($query, [$nama, $kode_fakultas, $kode]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to update `program_studi`: " . $e->getMessage());
      throw $e;
    }
  }

  function deleteProgramStudi(string $kode)
  {
    try {
      $query = "DELETE FROM program_studi WHERE kode=?";
      $this->db->execute($query, [$kode]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to delete from `program_studi`: " . $e->getMessage());
      throw $e;
    }
  }
}
