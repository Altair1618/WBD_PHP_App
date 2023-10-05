<?php

class PenggunaRepository extends Model
{
    public function getPenggunaList(): array
    {
        try {
            return $this->db->fetchAll("SELECT * FROM pengguna");
        } catch (Exception $e) {
            Logger::error(__FILE__, __LINE__, "Failed to fetch `pengguna`: " . $e->getMessage());
            throw $e;
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
            throw $e;
        }
    }

    function insertPengguna(string $username, string $email, string $password_hash, string $nama, int $tipe, ?string $gambar_profil = null)
    {
        try {
            $query = "INSERT INTO pengguna (username, email, password_hash, nama, tipe, gambar_profil) VALUES ($1, $2, $3, $4, $5, $6)";
            $this->db->execute($query, [$username, $email, $password_hash, $nama, $tipe, $gambar_profil]);
        } catch (Exception $e) {
            Logger::error(__FILE__, __LINE__, "Failed to insert into `pengguna`: " . $e->getMessage());
            throw $e;
        }
    }

    function updatePengguna(int $id, string $username, string $email, string $password_hash, string $nama, int $tipe, ?string $gambar_profil = null)
    {
        try {
            $query = "UPDATE pengguna SET username=$1, email=$2, password_hash=$3, nama=$4, tipe=$5, gambar_profil=$6 WHERE id=$7";
            $this->db->execute($query, [$username, $email, $password_hash, $nama, $tipe, $gambar_profil, $id]);
        } catch (Exception $e) {
            Logger::error(__FILE__, __LINE__, "Failed to update `pengguna`: " . $e->getMessage());
            throw $e;
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
            throw $e;
        }
    }
}
