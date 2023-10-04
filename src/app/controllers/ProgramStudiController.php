<?php

require_once MODELS_DIR . 'ProgramStudi.php';

class ProgramStudiController {
    private $model;

    public function __construct() {
        $this->model = new ProgramStudiRepository();
    }

    public function getProgramStudi($params) {
        if (isset($params['kode'])) {
            $program_studi = $this->model->getProgramStudi($params['kode']);
        } else if (isset($params['kode_fakultas'])) {
            $program_studi = $this->model->getProgramStudiByFakultas($params['kode_fakultas']);
        } else {
            $program_studi = $this->model->getProgramStudiList();
        }
        
        echo json_encode($program_studi);
    }
}