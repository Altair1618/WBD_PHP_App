<?php

class ModulController {
    public function createModul($params) {
        require_once MODELS_DIR . 'Modul.php';

        try {
            $modul = new ModulRepository();
            $modul->insertModul($params['kode'], $params['nama'], $params['deskripsi']);

            $_SESSION['messages'][] = "Modul berhasil ditambahkan";
            header('Location: /courses/' . $params['kode']);
        } catch (Exception $e) {
            $_SESSION['errors'][] = "Terjadi kesalahan saat menambahkan modul";
            header('Location: /courses/' . $params['kode'] . '/modules/create');
        }
    }

    public function editModul($params) {
        require_once MODELS_DIR . 'Modul.php';

        try {
            $modul = new ModulRepository();
            $modul->updateModul($params['modul-id'], $params['kode'], $params['nama'], $params['deskripsi']);

            $_SESSION['messages'][] = "Modul berhasil diubah";
            header('Location: /courses/' . $params['kode']);
        } catch (Exception $e) {
            $_SESSION['errors'][] = "Terjadi kesalahan saat mengubah modul";
            header('Location: /courses/' . $params['kode'] . '/modules/' . $params['modul-id'] . '/edit');
        }
    }

    public function deleteModul($params) {
        require_once MODELS_DIR . 'Modul.php';

        try {
            $modul = new ModulRepository();
            $modul->deleteModul($params['modul-id']);

            $_SESSION['messages'][] = "Modul berhasil dihapus";
            header('Location: /courses/' . $params['kode']);
        } catch (Exception $e) {
            $_SESSION['errors'][] = "Terjadi kesalahan saat menghapus modul";
            header('Location: /courses/' . $params['kode'] . '/modules/' . $params['modul-id'] . '/edit');
        }
    }

    public function showModulDetail($params) {
        require_once MODELS_DIR . 'MataKuliah.php';
        $mata_kuliah = new MataKuliahRepository();
        $params['course'] = $mata_kuliah->getMataKuliah($params['course-id']);
        $params['pengajar'] = 'Yudhistira Dwi Wardhana Asnar';
        
        require_once MODELS_DIR . 'Modul.php';
        $modul = new ModulRepository();
        $params['modul'] = $modul->getModul($params['modul-id']);

        require_once MODELS_DIR . 'MateriKelas.php';
        $materi_kelas = new MateriKelasRepository();
        $params['materi_kelas'] = $materi_kelas->getMateriKelasByModul($params['modul-id']);

        require_once VIEWS_DIR . 'user/modulDetail.php';
    }
}