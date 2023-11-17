<?php

class CourseController {
    public function getCourseByKode($params) {
        ob_start();

        require_once MODELS_DIR . 'MataKuliah.php';
        $mata_kuliah = new MataKuliahRepository();

        $ret = $mata_kuliah->getMataKuliah($params['kode']);

        ob_clean();
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

    public function createCourse($params) {
        ob_start();

        $req_body = json_decode(file_get_contents('php://input'), true);

        require_once MODELS_DIR . 'MataKuliah.php';
        $mata_kuliah = new MataKuliahRepository();

        require_once MODELS_DIR . 'Enroll.php';
        $pendaftaran = new EnrollRepository();

        try {
            $mata_kuliah->insertMataKuliah($req_body['kode'], $req_body['nama'], $req_body['deskripsi'], $req_body['kode_program_studi']);
            $pendaftaran->insertEnroll($req_body['userId'], $req_body['kode']);

            $data = $mata_kuliah->getMataKuliah($req_body['kode']);

            ob_clean();
            echo json_encode([
                'status' => 'success',
                'message' => 'Course berhasil ditambahkan',
                'data' => $data,
            ]);
        } catch (Exception $e) {
            ob_clean();
            echo json_encode([
                'status' => 'error',
                'message' => 'Course gagal ditambahkan',
                'data' => null,
            ]);
        }
    }

    public function updateCourse($params) {
        ob_start();

        $req_body = json_decode(file_get_contents('php://input'), true);

        require_once MODELS_DIR . 'MataKuliah.php';
        $mata_kuliah = new MataKuliahRepository();

        try {
            $mata_kuliah->updateMataKuliah($params['kode'], $req_body['nama'], $req_body['deskripsi'], $req_body['kode_program_studi']);

            $data = $mata_kuliah->getMataKuliah($params['kode']);

            ob_clean();
            echo json_encode([
                'status' => 'success',
                'message' => 'Course berhasil diupdate',
                'data' => $data,
            ]);
        } catch (Exception $e) {
            ob_clean();
            echo json_encode([
                'status' => 'error',
                'message' => 'Course gagal diupdate',
                'data' => null,
            ]);
        }
    }

    public function deleteCourse($params) {
        ob_start();

        require_once MODELS_DIR . 'MataKuliah.php';
        $mata_kuliah = new MataKuliahRepository();

        try {
            $mata_kuliah->deleteMataKuliah($params['kode']);

            ob_clean();
            echo json_encode([
                'status' => 'success',
                'message' => 'Course berhasil dihapus',
                'data' => null,
            ]);
        } catch (Exception $e) {
            ob_clean();
            echo json_encode([
                'status' => 'error',
                'message' => 'Course gagal dihapus',
                'data' => null,
            ]);
        }
    }

    public function getCourseEnrolledStudents($params) {
        ob_start();

        require_once MODELS_DIR . 'MataKuliah.php';
        $mata_kuliah = new MataKuliahRepository();
        
        if (!isset($params['page'])) {
            $params['page'] = 1;
        }

        if (!isset($params['search'])) {
            $params['search'] = '';
        }
        
        $ret = $mata_kuliah->getEnrolledStudents($params['kode'], $params['page'], $params['search']);
        $count = $mata_kuliah->getEnrolledStudentCount($params['kode'], $params['search']);
        
        $max_page = ceil($count / 10);
        ob_clean();
        if (!$ret) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Course tidak ditemukan',
                'data' => $ret,
            ]);
        } else {
            echo json_encode([
                'status' => 'success',
                'message' => 'Peserta Course berhasil didapatkan',
                'data' => [
                    'students' => $ret,
                    'max_page' => $max_page,
                ],
            ]);
        }
    }
}
