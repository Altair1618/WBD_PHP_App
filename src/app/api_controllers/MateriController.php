<?php

class MateriController {
    private function parse_size($size) {
        $unit = preg_replace('/[^bkmgtpezy]/i', '', $size);
        $size = preg_replace('/[^0-9\.]/', '', $size);
        
        if ($unit) return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
        else return round($size);
    }

    public function createMateri($params) {
        require_once MODELS_DIR . 'MateriKelas.php';

        if (isset($_FILES['video'])) {
            $max_file_size = $this->parse_size(ini_get('upload_max_filesize'));

            if ($_FILES['video']['size'] > $max_file_size) {
                $_SESSION['errors']['video'] = "Ukuran file terlalu besar";
            }
        } else {
            $_SESSION['errors']['video'] = "File gagal terupload";
        }

        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            Router::getInstance()->redirect('/courses/' . $params['course-id'] . '/modules/' . $params['modul-id'] . '/create');
        } else {
            $video_dir = APP_DIR . '../html/assets/videos/materi/';
            if (!file_exists($video_dir)) mkdir($video_dir, recursive: true);

            $tmp_name = $_FILES['video']['tmp_name'];
            $video_name = $_FILES['video']['name'];
            
            $final_video_name = $video_name; $cnt = 2;
            while (file_exists($video_dir . $final_video_name)) {
                $temp = explode('.', $video_name);
                $final_video_name = $temp[0] . "({$cnt})." . $temp[1];
                $cnt++;
            }

            move_uploaded_file($tmp_name, $video_dir . $final_video_name);

            $materi_kelas = new MateriKelasRepository();
            $materi_kelas->insertMateriKelas($_POST['idModul'], $_POST['judulTopik'], 1, $final_video_name);

            $_SESSION['messages'][] = "Materi berhasil ditambahkan";
            Logger::info(__FILE__, __LINE__, "Materi `{$_POST['judulTopik']}` added to modul `{$_POST['idModul']}`");
            
            require_once MODELS_DIR . 'Modul.php';
            $modul = new ModulRepository();
            $modul = $modul->getModul($_POST['idModul']);

            unset($_POST['idModul']); unset($_POST['judulTopik']);
            Router::getInstance()->redirect('/courses/' . $modul['kode_mata_kuliah'] . '/modules/' . $modul['id']);
        }
    }

    public function editMateri($params) {
        require_once MODELS_DIR . 'MateriKelas.php';

        if (isset($_FILES['video'])) {
            $max_file_size = $this->parse_size(ini_get('upload_max_filesize'));

            if ($_FILES['video']['size'] > $max_file_size) {
                $_SESSION['errors']['video'] = "Ukuran file terlalu besar";
            }
        } else {
            $_SESSION['errors']['video'] = "File gagal terupload";
        }

        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            Router::getInstance()->redirect('/courses/' . $params['course-id'] . '/modules/' . $params['modul-id'] . '/' . $params['materi-id'] . '/edit');
        } else {
            $materi_kelas = new MateriKelasRepository();
            $temp_materi = $materi_kelas->getMateriKelas($_POST['id']);
            
            if (isset($_FILES['video']) && $_FILES['video']['size'] > 0) {
                $video_dir = APP_DIR . '../html/assets/videos/materi/';
                if (!file_exists($video_dir)) mkdir($video_dir, recursive: true);

                $tmp_name = $_FILES['video']['tmp_name'];
                $video_name = $_FILES['video']['name'];
                
                $final_video_name = $video_name; $cnt = 2;
                while (file_exists($video_dir . $final_video_name)) {
                    $temp = explode('.', $video_name);
                    $final_video_name = $temp[0] . "({$cnt})." . $temp[1];
                    $cnt++;
                }

                move_uploaded_file($tmp_name, $video_dir . $final_video_name);
                if (file_exists($video_dir . $temp_materi['nama_file'])) unlink($video_dir . $temp_materi['nama_file']);
            } else {
                $final_video_name = $temp_materi['nama_file'];
            }

            $materi_kelas->updateMateriKelas($_POST['id'], $_POST['idModul'], $_POST['judulTopik'], 1, $final_video_name);

            $_SESSION['messages'][] = "Materi berhasil diubah";
            Logger::info(__FILE__, __LINE__, "Materi `{$_POST['judulTopik']}` edited");

            require_once MODELS_DIR . 'Modul.php';
            $modul = new ModulRepository();
            $modul = $modul->getModul($_POST['idModul']);

            unset($_POST['idModul']); unset($_POST['judulTopik']);
            Router::getInstance()->redirect('/courses/' . $modul['kode_mata_kuliah'] . '/modules/' . $modul['id']);
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