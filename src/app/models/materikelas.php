<?php

require_once __DIR__ . "/../utils/logger.php";
require_once __DIR__ . "/../utils/database.php";

class MateriKelasRepository
{
  private $db = new Database();

  function getMateriKelasList(): array
  {
    try {
      return $this->db->fetchAll("SELECT * FROM materi_kelas");
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `materi_kelas`: " . $e->getMessage());
      throw $e;
    }
  }

  function getMateriKelas(int $id): array
  {
    try {
      return $this->db->fetch("SELECT * FROM materi_kelas WHERE id=? LIMIT 1", [$id]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `materi_kelas`: " . $e->getMessage());
      throw $e;
    }
  }

  function insertMateriKelas(int $no_urut_modul, string $kode_mata_kuliah, string $judul_topik, int $tipe, string $nama_file, string $deskripsi)
  {
    try {
      $query = "INSERT INTO materi_kelas (no_urut_modul, kode_mata_kuliah, judul_topik, tipe, nama_file, deskripsi) VALUES (?, ?, ?, ?, ?, ?)";
      $this->db->execute($query, [$no_urut_modul, $kode_mata_kuliah, $judul_topik, $tipe, $nama_file, $deskripsi]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to insert into `materi_kelas`: " . $e->getMessage());
      throw $e;
    }
  }

  function updateMateriKelas(int $id, int $no_urut_modul, string $kode_mata_kuliah, string $judul_topik, int $tipe, string $nama_file, string $deskripsi)
  {
    try {
      $query = " UPDATE materi_kelas SET no_urut_modul=?, kode_mata_kuliah=?, judul_topik=?, tipe=?, nama_file=?, deskripsi=? WHERE id=?";
      $this->db->execute($query, [$no_urut_modul, $kode_mata_kuliah, $judul_topik, $tipe, $nama_file, $deskripsi, $id]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to update `materi_kelas`: " . $e->getMessage());
      throw $e;
    }
  }

  function deleteMateriKelas(int $id)
  {
    try {
      $query = "DELETE FROM materi_kelas WHERE id=?";
      $this->db->execute($query, [$id]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to delete from `materi_kelas`: " . $e->getMessage());
      throw $e;
    }
  }
}
