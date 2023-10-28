<?php

class CourseController {
    public function createCourse($params) {
        require_once MODELS_DIR . 'MataKuliah.php';
        $mata_kuliah = new MataKuliahRepository();
        $temp_matkul = $mata_kuliah->getMataKuliah($_POST['kode']);
        if ($temp_matkul) $_SESSION['errors']['kode'] = 'Mata kuliah dengan kode yang sama sudah ada';

        require_once MODELS_DIR . 'ProgramStudi.php';
        $program_studi = new ProgramStudiRepository();
        $temp_prodi = $program_studi->getProgramStudi($_POST['kodeProdi']);
        if (!$temp_prodi) $_SESSION['errors']['kodeProdi'] = 'Program studi tidak ditemukan';
        
        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            Router::getInstance()->redirect('/courses/create');
        } else {
            unset($_SESSION['errors']);
            $mata_kuliah->insertMataKuliah($_POST['kode'], $_POST['name'], $_POST['deskripsi'], $_POST['kodeProdi']);

            require_once MODELS_DIR . 'Enroll.php';
            $pendaftaran = new EnrollRepository();
            $pendaftaran->insertEnroll($_SESSION['user']['id'], $_POST['kode']);

            $_SESSION['messages'][] = 'Mata kuliah berhasil ditambahkan';
            Logger::info(__FILE__, __LINE__, "Mata kuliah {$_POST['kode']} berhasil ditambahkan");

            unset($_POST['kode']); unset($_POST['name']); unset($_POST['deskripsi']); unset($_POST['kodeProdi']);
            Router::getInstance()->redirect('/courses');
        }
    }

    public function getCourseById($params) {
        require_once MODELS_DIR . 'MataKuliah.php';
        $mata_kuliah = new MataKuliahRepository();

        $ret = $mata_kuliah->getMataKuliah($params['id']);
        if (!$ret) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Course tidak ditemukan',
                'data' => null,
            ]);
        } else {
            echo json_encode([
                'status' => 'success',
                'message' => 'Course berhasil ditemukan',
                'data' => $ret,
            ]);
        }
    }

    public function editCourse($params) {
        require_once MODELS_DIR . 'ProgramStudi.php';
        $program_studi = new ProgramStudiRepository();
        $temp_prodi = $program_studi->getProgramStudi($_POST['kodeProdi']);
        if (!$temp_prodi) $_SESSION['errors']['kodeProdi'] = 'Program studi tidak ditemukan';

        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            Router::getInstance()->redirect('/courses/' . $_POST['kode'] . '/edit');
        } else {
            unset($_SESSION['errors']);
            $mata_kuliah = new MataKuliahRepository();
            $mata_kuliah->updateMataKuliah($_POST['kode'], $_POST['name'], $_POST['deskripsi'], $_POST['kodeProdi']);

            $_SESSION['messages'][] = 'Mata kuliah berhasil diubah';
            Logger::info(__FILE__, __LINE__, "Mata kuliah {$_POST['kode']} berhasil diubah");
            
            unset($_POST['kode']); unset($_POST['name']); unset($_POST['deskripsi']); unset($_POST['kodeProdi']);
            Router::getInstance()->redirect('/courses');
        }
    }

    public function deleteCourse($params) {
        require_once MODELS_DIR . 'MataKuliah.php';

        try {
            $mata_kuliah = new MataKuliahRepository();
            $mata_kuliah->deleteMataKuliah($params['id']);

            $_SESSION['messages'][] = 'Mata kuliah berhasil dihapus';
            header('Location: /courses');
        } catch (Exception $e) {
            Logger::error(__FILE__, __LINE__, "Failed to delete `mata_kuliah`: " . $e->getMessage());
            $_SESSION['errors'][] = $e->getMessage();
            header('Location: /courses/' . $params['id']);
        }
    }
}