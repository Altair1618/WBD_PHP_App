<?php

class MateriController {
    public function createMateri($params) {
        require_once MODELS_DIR . 'MateriKelas.php';

        try {
            $materi_kelas = new MateriKelasRepository();
            $materi_kelas->insertMateriKelas($params['id_modul'], $params['judul_topik'], $params['tipe'], $params['nama_file']);

            $_SESSION['messages'][] = "Materi berhasil ditambahkan";
            header('Location: /courses/' . $params['kode'] . '/modules/' . $params['modul-id']);
        } catch (Exception $e) {
            $_SESSION['errors'][] = "Terjadi kesalahan saat menambahkan materi";
            header('Location: /courses/' . $params['kode'] . '/modules/' . $params['modul-id'] . '/create');
        }
    }

    public function editMateri($params) {
        require_once MODELS_DIR . 'MateriKelas.php';

        try {
            $materi_kelas = new MateriKelasRepository();
            $materi_kelas->updateMateriKelas($params['materi-id'], $params['id_modul'], $params['judul_topik'], $params['tipe'], $params['nama_file'], $params['deskripsi']);

            $_SESSION['messages'][] = "Materi berhasil diubah";
            header('Location: /courses/' . $params['kode'] . '/modules/' . $params['modul-id']);
        } catch (Exception $e) {
            $_SESSION['errors'][] = "Terjadi kesalahan saat mengubah materi";
            header('Location: /courses/' . $params['kode'] . '/modules/' . $params['modul-id'] . '/' . $params['materi-id'] . '/edit');
        }
    }

    public function deleteMateri($params) {
        require_once MODELS_DIR . 'MateriKelas.php';

        try {
            $materi_kelas = new MateriKelasRepository();
            $materi_kelas->deleteMateriKelas($params['materi-id']);

            $_SESSION['messages'][] = "Materi berhasil dihapus";
            header('Location: /courses/' . $params['kode'] . '/modules/' . $params['modul-id']);
        } catch (Exception $e) {
            $_SESSION['errors'][] = "Terjadi kesalahan saat menghapus materi";
            header('Location: /courses/' . $params['kode'] . '/modules/' . $params['modul-id'] . '/' . $params['materi-id'] . '/edit');
        }
    }
}