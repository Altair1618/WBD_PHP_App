<?php

class CourseController {
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
}