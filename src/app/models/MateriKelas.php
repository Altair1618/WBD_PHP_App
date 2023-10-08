<?php

class MateriKelasRepository extends Model
{
  function getMateriKelasList(): array
  {
    try {
      return $this->db->fetchAll("SELECT * FROM materi_kelas");
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `materi_kelas`: " . $e->getMessage());
      throw $e;
    }
  }

  function getMateriKelas(int $id): array|false
  {
    try {
      return $this->db->fetch("SELECT * FROM materi_kelas WHERE id=$1 LIMIT 1", [$id]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `materi_kelas`: " . $e->getMessage());
      throw $e;
    }
  }

  function getMateriKelasByModul(int $id_modul): array
  {
    try {
      return $this->db->fetchAll("SELECT * FROM materi_kelas WHERE id_modul=$1", [$id_modul]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `materi_kelas`: " . $e->getMessage());
      throw $e;
    }
  }

  function insertMateriKelas(int $id_modul, string $judul_topik, int $tipe, string $nama_file)
  {
    try {
      $query = "INSERT INTO materi_kelas (id_modul, judul_topik, tipe, nama_file) VALUES ($1, $2, $3, $4)";
      $this->db->execute($query, [$id_modul, $judul_topik, $tipe, $nama_file]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to insert into `materi_kelas`: " . $e->getMessage());
      throw $e;
    }
  }

  function updateMateriKelas(int $id, int $id_modul, string $judul_topik, int $tipe, string $nama_file, string $deskripsi)
  {
    try {
      $query = " UPDATE materi_kelas SET id_modul=$1, judul_topik=$2, tipe=$3, nama_file=$4 WHERE id=$5";
      $this->db->execute($query, [$id_modul, $judul_topik, $tipe, $nama_file, $deskripsi, $id]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to update `materi_kelas`: " . $e->getMessage());
      throw $e;
    }
  }

  function deleteMateriKelas(int $id)
  {
    try {
      $query = "DELETE FROM materi_kelas WHERE id=$1";
      $this->db->execute($query, [$id]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to delete from `materi_kelas`: " . $e->getMessage());
      throw $e;
    }
  }
}
