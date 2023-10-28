<?php

class CourseController {
    public function getManyCourses($params) {
        if (!isset($params['q-search'])) $params['q-search'] = null;
        if (!isset($params['q-fakultas'])) $params['q-fakultas'] = null;
        if (!isset($params['q-kode_prodi'])) $params['q-kode_prodi'] = null;
        if (!isset($params['q-sort_param'])) $params['q-sort_param'] = 'nama';
        if (!isset($params['q-sort_order'])) $params['q-sort_order'] = 'asc';

        require_once MODELS_DIR . 'MataKuliah.php';
        $mata_kuliah = new MataKuliahRepository();
        $params['courses'] = $mata_kuliah->getMataKuliahFiltered($params['q-search'], $params['q-fakultas'], $params['q-kode_prodi'], $params['q-sort_param'], $params['q-sort_order'], $params['page'], ITEMS_PER_PAGE);

        for ($i = 0; $i < count($params['courses']); $i++) {
            $params['courses'][$i]['pengajar'] = $mata_kuliah->getPengajar($params['courses'][$i]['kode']);
        }

        $item_count = $mata_kuliah->getMataKuliahFilteredCount($params['q-search'], $params['q-fakultas'], $params['q-kode_prodi']);
        $params['page_count'] = ceil($item_count / ITEMS_PER_PAGE);

        return $params;
    }

    public function getCatalogData($params) {
        if (!isset($params['q-search'])) $params['q-search'] = null;
        if (!isset($params['q-fakultas'])) $params['q-fakultas'] = null;
        if (!isset($params['q-kode_prodi'])) $params['q-kode_prodi'] = null;
        if (!isset($params['q-sort_param'])) $params['q-sort_param'] = 'nama';
        if (!isset($params['q-sort_order'])) $params['q-sort_order'] = 'asc';

        require_once MODELS_DIR . 'MataKuliah.php';
        $mata_kuliah = new MataKuliahRepository();
        $params['courses'] = $mata_kuliah->getCatalog($params['q-search'], $params['q-fakultas'], $params['q-kode_prodi'], $params['q-sort_param'], $params['q-sort_order'], $params['page'], ITEMS_PER_PAGE);

        for ($i = 0; $i < count($params['courses']); $i++) {
            $params['courses'][$i]['pengajar'] = $mata_kuliah->getPengajar($params['courses'][$i]['kode']);
        }

        $item_count = $mata_kuliah->getCatalogCount($params['q-search'], $params['q-fakultas'], $params['q-kode_prodi']);
        $params['page_count'] = ceil($item_count / ITEMS_PER_PAGE);

        return $params;
    }

    public function getManyCoursesByUser($params) {
        if (!isset($params['q-search'])) $params['q-search'] = null;
        if (!isset($params['q-fakultas'])) $params['q-fakultas'] = null;
        if (!isset($params['q-kode_prodi'])) $params['q-kode_prodi'] = null;
        if (!isset($params['q-sort_param'])) $params['q-sort_param'] = 'nama';
        if (!isset($params['q-sort_order'])) $params['q-sort_order'] = 'asc';

        require_once MODELS_DIR . 'MataKuliah.php';
        $mata_kuliah = new MataKuliahRepository();
        $params['courses'] = $mata_kuliah->getMataKuliahFilteredWithUser($params['q-search'], $params['q-fakultas'], $params['q-kode_prodi'], $params['q-sort_param'], $params['q-sort_order'], $params['page'], ITEMS_PER_PAGE);

        for ($i = 0; $i < count($params['courses']); $i++) {
            $params['courses'][$i]['pengajar'] = $mata_kuliah->getPengajar($params['courses'][$i]['kode']);
        }

        $item_count = $mata_kuliah->getMataKuliahFilteredWithUserCount($params['q-search'], $params['q-fakultas'], $params['q-kode_prodi']);
        $params['page_count'] = ceil($item_count / ITEMS_PER_PAGE);

        return $params;
    }

    public function showMyCourses($params) {
        if (!isset($params['page'])) $params['page'] = 1;
        
        require_once MODELS_DIR . 'Fakultas.php';
        $fakultas = new FakultasRepository();

        require_once MODELS_DIR . 'ProgramStudi.php';
        $program_studi = new ProgramStudiRepository();

        $params['fakultas'] = $fakultas->getFakultasList();
        $params['program_studi'] = $program_studi->getProgramStudiList();

        require_once VIEWS_DIR . 'user/myCourses.php';
    }

    public function showCourseCatalog($params) {
        if (!isset($params['page'])) $params['page'] = 1;
        
        require_once MODELS_DIR . 'Fakultas.php';
        $fakultas = new FakultasRepository();

        require_once MODELS_DIR . 'ProgramStudi.php';
        $program_studi = new ProgramStudiRepository();

        $params['fakultas'] = $fakultas->getFakultasList();
        $params['program_studi'] = $program_studi->getProgramStudiList();

        require_once VIEWS_DIR . 'user/courseCatalog.php';
    }

    public function showCourseDetail($params) {
        require_once MODELS_DIR . 'MataKuliah.php';
        $mata_kuliah = new MataKuliahRepository();
        $params['course'] = $mata_kuliah->getMataKuliah($params['id']);
        $params['pengajar'] = $mata_kuliah->getPengajar($params['course']['kode']);
        
        require_once MODELS_DIR . 'Modul.php';
        $modul = new ModulRepository();
        $params['modules'] = $modul->getModulByMatKul($params['id']);

        require_once VIEWS_DIR . 'user/courseDetail.php';
    }

    public function getCoursesTaught($params) {
        if (!isset($params['q-search'])) $params['q-search'] = null;
        if (!isset($params['q-fakultas'])) $params['q-fakultas'] = null;
        if (!isset($params['q-kode_prodi'])) $params['q-kode_prodi'] = null;
        if (!isset($params['q-sort_param'])) $params['q-sort_param'] = 'nama';
        if (!isset($params['q-sort_order'])) $params['q-sort_order'] = 'asc';

        require_once MODELS_DIR . 'MataKuliah.php';
        $mata_kuliah = new MataKuliahRepository();
        $params['courses'] = $mata_kuliah->getMataKuliahFilteredWithUser($params['q-search'], $params['q-fakultas'], $params['q-kode_prodi'], $params['q-sort_param'], $params['q-sort_order'], $params['page'], ITEMS_PER_PAGE);

        for ($i = 0; $i < count($params['courses']); $i++) {
            $params['courses'][$i]['jumlah_peserta'] = $mata_kuliah->getEnrolledStudentCount($params['courses'][$i]['kode']);
        }

        $item_count = $mata_kuliah->getMataKuliahFilteredWithUserCount($params['q-search'], $params['q-fakultas'], $params['q-kode_prodi']);
        $params['page_count'] = ceil($item_count / ITEMS_PER_PAGE);

        return $params;
    }

    public function showCoursesTaught($params) {
        if (!isset($params['page'])) $params['page'] = 1;
        
        require_once MODELS_DIR . 'Fakultas.php';
        $fakultas = new FakultasRepository();

        require_once MODELS_DIR . 'ProgramStudi.php';
        $program_studi = new ProgramStudiRepository();

        $params['fakultas'] = $fakultas->getFakultasList();
        $params['program_studi'] = $program_studi->getProgramStudiList();

        require_once VIEWS_DIR . 'lecturer/coursesTaught.php';
    }

    public function showCreateCoursePage($params) {
        require_once VIEWS_DIR . 'lecturer/createCourse.php';
    }

    public function showEditCoursePage($params) {
        require_once MODELS_DIR . 'MataKuliah.php';
        $mata_kuliah = new MataKuliahRepository();
        $course = $mata_kuliah->getMataKuliah($params['id']);

        require_once VIEWS_DIR . 'lecturer/editCourse.php';
    }
}