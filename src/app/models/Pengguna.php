<?php

class PenggunaRepository extends Model
{
    public function getPenggunaList(): array
    {
        try {
            return $this->db->fetchAll("SELECT * FROM pengguna");
        } catch (Exception $e) {
            Logger::error(__FILE__, __LINE__, "Failed to fetch `pengguna`: " . $e->getMessage());
            Router::getInstance()->error(500);;
        }
    }

    function getPengguna(?int $id = null, ?string $username = null, ?string $email = null): array|false
    {
        try {
            if (isset($id)) {
                $query = "SELECT * FROM pengguna WHERE id=$1 LIMIT 1";
                return $this->db->fetch($query, [$id]);
            } else if (isset($username)) {
                $query = "SELECT * FROM pengguna WHERE username=$1 LIMIT 1";
                return $this->db->fetch($query, [$username]);
            } else if (isset($email)) {
                $query = "SELECT * FROM pengguna WHERE email=$1 LIMIT 1";
                return $this->db->fetch($query, [$email]);
            } else {
                return false;
            }
        } catch (Exception $e) {
            Logger::error(__FILE__, __LINE__, "Failed to fetch `pengguna`: " . $e->getMessage());
            Router::getInstance()->error(500);;
        }
    }

    function insertPengguna(string $username, string $email, string $password_hash, string $nama, int $tipe, ?string $gambar_profil = null)
    {
        try {
            $query = "INSERT INTO pengguna (username, email, password_hash, nama, tipe, gambar_profil) VALUES ($1, $2, $3, $4, $5, $6)";
            $this->db->execute($query, [$username, $email, $password_hash, $nama, $tipe, $gambar_profil]);
        } catch (Exception $e) {
            Logger::error(__FILE__, __LINE__, "Failed to insert into `pengguna`: " . $e->getMessage());
            Router::getInstance()->error(500);;
        }
    }

    function updatePengguna(int $id, string $username, string $email, string $password_hash, string $nama, int $tipe, ?string $gambar_profil = null)
    {
        try {
            $query = "UPDATE pengguna SET username=$1, email=$2, password_hash=$3, nama=$4, tipe=$5, gambar_profil=$6 WHERE id=$7";
            $this->db->execute($query, [$username, $email, $password_hash, $nama, $tipe, $gambar_profil, $id]);
        } catch (Exception $e) {
            Logger::error(__FILE__, __LINE__, "Failed to update `pengguna`: " . $e->getMessage());
            Router::getInstance()->error(500);;
        }
    }

    function deletePengguna(?int $id = null, ?string $username = null, ?string $email = null)
    {
        try {
            if (isset($id)) {
                $query = "DELETE FROM pengguna WHERE id=$1";
                $this->db->fetch($query, [$id]);
            } else if (isset($username)) {
                $query = "DELETE FROM pengguna WHERE username=$1";
                $this->db->fetch($query, [$username]);
            } else if (isset($email)) {
                $query = "DELETE FROM pengguna WHERE email=$1";
                $this->db->fetch($query, [$email]);
            }
        } catch (Exception $e) {
            Logger::error(__FILE__, __LINE__, "Failed to delete from `pengguna`: " . $e->getMessage());
            Router::getInstance()->error(500);;
        }
    }

    function getPenggunaFiltered(string $search = null, int $user_type = null, string $sort_param, string $sort_order, int $page, int $limit): array
    {
        try {
            $offset = ($page - 1) * $limit;

            $args = ["%$search%", $limit, $offset];
            if (isset($user_type)) {
                $filter_user_type = "AND tipe = $4";
                $args[] = $user_type;
            } else {
                $filter_user_type = "";
            }

            $query = <<<SQL
            SELECT * FROM pengguna
            WHERE (nama ILIKE $1 OR username ILIKE $1)
            AND tipe <> 0
            $filter_user_type
            ORDER BY $sort_param $sort_order
            LIMIT $2 OFFSET $3
            SQL;

            return $this->db->fetchAll($query, $args);
        } catch (Exception $e) {
            Logger::error(__FILE__, __LINE__, "Failed to fetch `pengguna`: " . $e->getMessage());
            Router::getInstance()->error(500);;
        }
    }

    function getPenggunaFilteredCount(string $search = null): int
    {
        try {
            $query = "SELECT 1 FROM pengguna WHERE (nama ILIKE $1 OR username ILIKE $1) AND tipe <> 0";
            return $this->db->rowCount($query, ["%$search%"]);
        } catch (Exception $e) {
            Logger::error(__FILE__, __LINE__, "Failed to fetch `pengguna`: " . $e->getMessage());
            Router::getInstance()->error(500);;
        }
    }
}
