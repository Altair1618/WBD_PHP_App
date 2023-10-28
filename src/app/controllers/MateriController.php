<?php

class MateriController {
    public function showCreateMateriPage($params) {
        require_once VIEWS_DIR . 'lecturer/createMateri.php';
    }

    public function showEditMateriPage($params) {
        require_once MODELS_DIR . 'MateriKelas.php';
        $materi_kelas = new MateriKelasRepository();
        $materi = $materi_kelas->getMateriKelas($params['materi-id']);

        require_once VIEWS_DIR . 'lecturer/editMateri.php';
    }
}