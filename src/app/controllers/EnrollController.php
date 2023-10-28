<?php

require_once MODELS_DIR . 'Enroll.php';

class EnrollController {
    private $model;

    public function __construct() {
        $this->model = new EnrollRepository();
    }

    public function createEnroll($params) {
        $this->model->insertEnroll($params['user'], $params['kode']);

        $_SESSION['messages'][] = "Berhasil mendaftar mata kuliah " . $params['kode'];
        $router = Router::getInstance();
        $router->redirect('/courses');
    }
}