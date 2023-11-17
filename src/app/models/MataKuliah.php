<?php

class MataKuliahRepository extends Model
{
  function getMataKuliahList(): array
  {
    try {
      return $this->db->fetchAll("SELECT * FROM mata_kuliah");
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `mata_kuliah`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function getMataKuliah(string $kode): array|false
  {
    try {
      return $this->db->fetch("SELECT * FROM mata_kuliah WHERE kode=$1 LIMIT 1", [$kode]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `mata_kuliah`: " . $e->getMessage());
      throw $e;
    }
  }

  function getMataKuliahFiltered(string $search = null, string $fakultas = null, string $kode_prodi = null, string $sort_param, string $sort_order, int $page, int $limit): array
  {
    try {
      $offset = ($page - 1) * $limit;

      $query = "
        SELECT mk.kode, mk.nama
        FROM mata_kuliah mk
        JOIN program_studi ps ON mk.kode_program_studi = ps.kode
        JOIN fakultas f ON ps.kode_fakultas = f.kode
        WHERE (mk.kode ILIKE $1 OR mk.nama ILIKE $1)
        AND (ps.kode = $2 OR $2 = '')
        AND (f.kode = $3 OR $3 = '')
        ORDER BY $sort_param $sort_order
        LIMIT $4 OFFSET $5
      ";

      return $this->db->fetchAll($query, ["%$search%", "$kode_prodi", "$fakultas", $limit, $offset]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `mata_kuliah`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function getMataKuliahFilteredWithUser(string $search = null, string $fakultas = null, string $kode_prodi = null, string $sort_param, string $sort_order, int $page, int $limit): array
  {
    try {
      $offset = ($page - 1) * $limit;

      $query = "
        SELECT mk.kode, mk.nama
        FROM mata_kuliah mk
        JOIN program_studi ps ON mk.kode_program_studi = ps.kode
        JOIN fakultas f ON ps.kode_fakultas = f.kode
        JOIN pendaftaran_mata_kuliah ON mk.kode = pendaftaran_mata_kuliah.kode_mata_kuliah
        WHERE (mk.kode ILIKE $1 OR mk.nama ILIKE $1)
        AND (ps.kode = $2 OR $2 = '')
        AND (f.kode = $3 OR $3 = '')
        AND (id_pengguna = " . $_SESSION['user']['id'] . ")
        ORDER BY $sort_param $sort_order
        LIMIT $4 OFFSET $5
      ";

      return $this->db->fetchAll($query, ["%$search%", "$kode_prodi", "$fakultas", $limit, $offset]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `mata_kuliah`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function getCatalog(string $search = null, string $fakultas = null, string $kode_prodi = null, string $sort_param, string $sort_order, int $page, int $limit): array
  {
    try {
      $offset = ($page - 1) * $limit;

      $query = "
        SELECT mk.kode, mk.nama
        FROM mata_kuliah mk
        JOIN program_studi ps ON mk.kode_program_studi = ps.kode
        JOIN fakultas f ON ps.kode_fakultas = f.kode
        LEFT JOIN pendaftaran_mata_kuliah pmk ON mk.kode = pmk.kode_mata_kuliah
          AND pmk.id_pengguna = " . $_SESSION['user']['id'] . "
        WHERE (mk.kode ILIKE $1 OR mk.nama ILIKE $1)
        AND (ps.kode = $2 OR $2 = '')
        AND (f.kode = $3 OR $3 = '')
        AND pmk.id_pengguna IS NULL
        ORDER BY $sort_param $sort_order
        LIMIT $4 OFFSET $5
      ";

      return $this->db->fetchAll($query, ["%$search%", "$kode_prodi", "$fakultas", $limit, $offset]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `mata_kuliah`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function getMataKuliahFilteredCount(string $search = null, string $fakultas = null, string $kode_prodi = null) {
    try {
      $query = "
        SELECT 1
        FROM mata_kuliah mk
        JOIN program_studi ps ON mk.kode_program_studi = ps.kode
        JOIN fakultas f ON ps.kode_fakultas = f.kode
        WHERE (mk.nama ILIKE $1)
        AND (ps.kode = $2 OR $2 = '')
        AND (f.kode = $3 OR $3 = '')
      ";

      return $this->db->rowCount($query, ["%$search%", "$kode_prodi", "$fakultas"]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `mata_kuliah`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function getMataKuliahFilteredWithUserCount(string $search = null, string $fakultas = null, string $kode_prodi = null) {
    try {
      $query = "
        SELECT 1
        FROM mata_kuliah mk
        JOIN program_studi ps ON mk.kode_program_studi = ps.kode
        JOIN fakultas f ON ps.kode_fakultas = f.kode
        JOIN pendaftaran_mata_kuliah ON mk.kode = pendaftaran_mata_kuliah.kode_mata_kuliah
        WHERE (mk.nama ILIKE $1)
        AND (ps.kode = $2 OR $2 = '')
        AND (f.kode = $3 OR $3 = '')
        AND (id_pengguna = " . $_SESSION['user']['id'] . ")
      ";

      return $this->db->rowCount($query, ["%$search%", "$kode_prodi", "$fakultas"]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `mata_kuliah`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function getCatalogCount(string $search = null, string $fakultas = null, string $kode_prodi = null) {
    try {
      $query = "
        SELECT mk.kode, mk.nama
        FROM mata_kuliah mk
        JOIN program_studi ps ON mk.kode_program_studi = ps.kode
        JOIN fakultas f ON ps.kode_fakultas = f.kode
        LEFT JOIN pendaftaran_mata_kuliah pmk ON mk.kode = pmk.kode_mata_kuliah
          AND pmk.id_pengguna = " . $_SESSION['user']['id'] . "
        WHERE (mk.kode ILIKE $1 OR mk.nama ILIKE $1)
        AND (ps.kode = $2 OR $2 = '')
        AND (f.kode = $3 OR $3 = '')
        AND pmk.id_pengguna IS NULL
      ";

      return $this->db->rowCount($query, ["%$search%", "$kode_prodi", "$fakultas"]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `mata_kuliah`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function getEnrolledStudents(string $kode, int $page, string $search): array
  {
    try {
      $offset = ($page - 1) * 10;

      $query = "
        SELECT pengguna.id, pengguna.nama, pengguna.username, pengguna.email
        FROM pendaftaran_mata_kuliah
        JOIN pengguna ON pendaftaran_mata_kuliah.id_pengguna = pengguna.id
        WHERE kode_mata_kuliah = $1
        AND pengguna.nama ILIKE $2
        AND pengguna.tipe = " . PENGGUNA_TIPE_MAHASISWA . "
        LIMIT 10 OFFSET $3
      ";

      return $this->db->fetchAll($query, [$kode, "%$search%", $offset]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `pendaftaran_mata_kuliah`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function getEnrolledStudentCount(string $kode) {
    try {
      $query = "
        SELECT 1
        FROM pendaftaran_mata_kuliah
        JOIN pengguna ON pendaftaran_mata_kuliah.id_pengguna = pengguna.id
        WHERE kode_mata_kuliah = $1
        AND pengguna.tipe = " . PENGGUNA_TIPE_MAHASISWA . "
      ";

      return $this->db->rowCount($query, [$kode]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `pendaftaran_mata_kuliah`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function getPengajar(string $kode) {
    try {
      $query = "
        SELECT pengguna.id, pengguna.nama
        FROM pendaftaran_mata_kuliah
        JOIN pengguna ON pendaftaran_mata_kuliah.id_pengguna = pengguna.id
        WHERE kode_mata_kuliah = $1
        AND pengguna.tipe = " . PENGGUNA_TIPE_PENGAJAR . "
      ";

      return $this->db->fetch($query, [$kode]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to fetch `pendaftaran_mata_kuliah`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function insertMataKuliah(string $kode, string $nama, ?string $deskripsi, string $kode_program_studi)
  {
    try {
      $query = "INSERT INTO mata_kuliah (kode, nama, deskripsi, kode_program_studi) VALUES ($1, $2, $3, $4)";
      $this->db->execute($query, [$kode, $nama, $deskripsi, $kode_program_studi]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to insert into `mata_kuliah`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function updateMataKuliah(string $kode, string $nama, string $deskripsi, string $kode_program_studi)
  {
    try {
      $query = "UPDATE mata_kuliah SET nama=$1, deskripsi=$2, kode_program_studi=$3 WHERE kode=$4";
      $this->db->execute($query, [$nama, $deskripsi, $kode_program_studi, $kode]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to update `mata_kuliah`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }

  function deleteMataKuliah(string $kode)
  {
    try {
      $query = "DELETE FROM mata_kuliah WHERE kode=$1";
      $this->db->execute($query, [$kode]);
    } catch (Exception $e) {
      Logger::error(__FILE__, __LINE__, "Failed to delete from `mata_kuliah`: " . $e->getMessage());
      Router::getInstance()->error(500);;
    }
  }
}
