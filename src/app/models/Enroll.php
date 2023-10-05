<?php

class EnrollRepository extends Model {
    function insertEnroll(int $id_pengguna, string $kode_mata_kuliah) {
        try {
            $query = "INSERT INTO pendaftaran_mata_kuliah (id_pengguna, kode_mata_kuliah) VALUES ($1, $2)";
            $this->db->execute($query, [$id_pengguna, $kode_mata_kuliah]);
        } catch (Exception $e) {
            Logger::error(__FILE__, __LINE__, "Failed to insert into `pendaftaran_mata_kuliah`: " . $e->getMessage());
            throw $e;
        }
    }

    function deleteEnroll(string $kode_mahasiswa, string $kode_kelas) {
        try {
            $query = "DELETE FROM pendaftaran_mata_kuliah WHERE id_pengguna=$1 AND kode_mata_kuliah=$2";
            $this->db->execute($query, [$kode_mahasiswa, $kode_kelas]);
        } catch (Exception $e) {
            Logger::error(__FILE__, __LINE__, "Failed to delete from `pendaftaran_mata_kuliah`: " . $e->getMessage());
            throw $e;
        }
    }
}