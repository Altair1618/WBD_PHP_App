<?php

class ModulController {
    public function createModul($params) {
        require_once MODELS_DIR . 'Modul.php';

        $modul = new ModulRepository();
        $modul->insertModul($_POST['kode'], $_POST['name'], $_POST['deskripsi']);

        $_SESSION['messages'][] = "Modul berhasil ditambahkan";
        Logger::info(__FILE__, __LINE__, 'Modul berhasil ditambahkan');

        $kode = $_POST['kode'];
        unset($_POST['kode']); unset($_POST['name']); unset($_POST['deskripsi']);
        Router::getInstance()->redirect("/courses/{$kode}");
    }

    public function editModul($params) {
        require_once MODELS_DIR . 'Modul.php';

        $modul = new ModulRepository();
        $modul->updateModul($params['modul-id'], $_POST['kode'], $_POST['name'], $_POST['deskripsi']);

        $_SESSION['messages'][] = "Modul berhasil ditambahkan";
        Logger::info(__FILE__, __LINE__, 'Modul berhasil ditambahkan');

        $kode = $_POST['kode'];
        unset($_POST['kode']); unset($_POST['name']); unset($_POST['deskripsi']);
        Router::getInstance()->redirect("/courses/{$kode}");
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
}