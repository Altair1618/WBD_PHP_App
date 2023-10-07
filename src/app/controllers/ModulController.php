<?php

class ModulController {
    public function showModulDetail($params) {
        require_once MODELS_DIR . 'MataKuliah.php';
        $mata_kuliah = new MataKuliahRepository();
        $params['course'] = $mata_kuliah->getMataKuliah($params['course-id']);
        $params['pengajar'] = 'Yudhistira Dwi Wardhana Asnar';
        
        require_once MODELS_DIR . 'Modul.php';
        $modul = new ModulRepository();
        $params['modul'] = $modul->getModul($params['modul-id']);

        require_once MODELS_DIR . 'MateriKelas.php';
        $materi_kelas = new MateriKelasRepository();
        $params['materi_kelas'] = $materi_kelas->getMateriKelasByModul($params['modul-id']);

        require_once VIEWS_DIR . 'user/modulDetail.php';
    }
}