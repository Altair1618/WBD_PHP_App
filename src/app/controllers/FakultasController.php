<?php

require_once MODELS_DIR . 'Fakultas.php';

class FakultasController {
    private $model;

    public function __construct() {
        $this->model = new FakultasRepository();
    }

    public function getFakultas($params) {
        if (isset($params['kode'])) {
            $fakultas = $this->model->getFakultas($params['kode']);
        } else {
            $fakultas = $this->model->getFakultasList();
        }

        echo json_encode($fakultas);
    }
}