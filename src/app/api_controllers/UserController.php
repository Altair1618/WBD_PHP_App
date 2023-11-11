<?php

require_once MODELS_DIR . 'Pengguna.php';

class UserController {
    private $model;

    public function __construct() {
        $this->model = new PenggunaRepository();
    }

    public function getOneUser($params) {
        if (isset($params['id'])) {
            $user = $this->model->getPengguna(id: $params['id']);
        } else if (isset($params['username'])) {
            $user = $this->model->getPengguna(username: $params['username']);
        } else if (isset($params['email'])) {
            $user = $this->model->getPengguna(email: $params['email']);
        } else if (isset($params['credentials'])) {
            $user = $this->model->getPengguna(username: $params['credentials']);
            if (!$user) {
                $user = $this->model->getPengguna(email: $params['credentials']);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Parameter tidak lengkap',
                'data' => null
            ]);

            return;
        }
        
        if (!$user) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Pengguna tidak ditemukan',
                'data' => null
            ]);
        } else {
            unset($user['password_hash']);
            echo json_encode([
                'status' => 'success',
                'message' => 'Data Pengguna berhasil didapatkan',
                'data' => $user
            ]);
        }

        return;
    }
}