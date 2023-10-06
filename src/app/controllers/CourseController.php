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
            $params['courses'][$i]['pengajar'] = 'Yudhistira Dwi Wardhana Asnar';
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
            $params['courses'][$i]['pengajar'] = 'Yudhistira Dwi Wardhana Asnar';
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
            $params['courses'][$i]['pengajar'] = 'Yudhistira Dwi Wardhana Asnar';
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

    public function getCoursesHTML($params) {
        $params = $this->getManyCoursesByUser($params);

        $body_html = '';
        if (!isset($params['courses']) || count($params['courses']) == 0) {
            $body_html = "
            <div class='body-main'>
                <p class='empty-message'>Tidak ada mata kuliah tersedia</p>
            </div>
            ";
        } else {
            $body_html = "
            <div class='body-main'>
            ";

            foreach ($params['courses'] as $course) {
                if (!isset($course['image'])) {
                    $course['image'] = '/assets/images/Course_Default.svg';
                }

                $body_html .= "
                <div class='course-card'>
                    <img class='course-image' src='{$course['image']}' alt='course-image'>

                    <div class='course-info'>
                        <p class='course-code'> {$course['kode']} </p>
                        <p class='course-name'> {$course['nama']} </p>
                        <p class='course-lecturer'> {$course['pengajar']} </p>

                        <div class='course-button-container'>
                            <a class='course-detail-button' href='/courses/{$course['kode']}'>LIHAT</a>
                        </div>
                    </div>
                </div>
                ";
            }

            $body_html .= "
            </div>

            <div id='body-footer' class='body-footer'>
                <div class='page-container'>
            ";
            
            if ($params['page'] > 1) {
                $target = $params['page'] - 1;
                $body_html .= "
                    <button class='page-button'>
                        PREV
                    </button>
                    <button class='page-button'>
                        {$target}
                    </button>
                ";
            }

            $body_html .= "
                </div>

                <button id='current-page-button' class='current-page-button'>
                    {$params['page']}
                </button>

                <div class='page-container'>
            ";
            
            if ($params['page'] < $params['page_count']) {
                $target = $params['page'] + 1;
                $body_html .= "
                    <button class='page-button'>
                        {$target}
                    </button>
                    <button class='page-button'>
                        NEXT
                    </button>
                ";
            }

            $body_html .= "
                </div>
            </div>
            ";
        }

        echo $body_html;
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

    public function getCatalogHTML($params) {
        $params = $this->getCatalogData($params);

        $body_html = '';
        if (!isset($params['courses']) || count($params['courses']) == 0) {
            $body_html = "
            <div class='body-main'>
                <p class='empty-message'>Tidak ada mata kuliah tersedia</p>
            </div>
            ";
        } else {
            $body_html = "
            <div class='body-main'>
            ";

            foreach ($params['courses'] as $course) {
                if (!isset($course['image'])) {
                    $course['image'] = '/assets/images/Course_Default.svg';
                }

                $body_html .= "
                <div class='course-card'>
                    <img class='course-image' src='{$course['image']}' alt='course-image'>

                    <div class='course-info'>
                        <p class='course-code'> {$course['kode']} </p>
                        <p class='course-name'> {$course['nama']} </p>
                        <p class='course-lecturer'> {$course['pengajar']} </p>

                        <div class='course-button-container'>
                            <form action='/api/enroll?kode=" . $course['kode'] . "&user=" . $_SESSION['user']['id'] . "' method='POST' class='course-button-container'>
                                <button class='course-enroll-button' type='submit'>DAFTAR</a>
                            </form>
                        </div>
                    </div>
                </div>
                ";
            }

            $body_html .= "
            </div>

            <div id='body-footer' class='body-footer'>
                <div class='page-container'>
            ";
            
            if ($params['page'] > 1) {
                $target = $params['page'] - 1;
                $body_html .= "
                    <button class='page-button'>
                        PREV
                    </button>
                    <button class='page-button'>
                        {$target}
                    </button>
                    ";
                }
                
            $body_html .= "
                </div>

                <button id='current-page-button' class='current-page-button'>
                    {$params['page']}
                </button>

                <div class='page-container'>
            ";
            
            if ($params['page'] < $params['page_count']) {
                $target = $params['page'] + 1;
                $body_html .= "
                    <button class='page-button'>
                        {$target}
                    </button>
                    <button class='page-button'>
                        NEXT
                    </button>
                    ";
                }
                
            $body_html .= "
                </div>
                </div>
            ";
        }

        echo $body_html;
    }

    public function showCourseDetail($params) {
        require_once MODELS_DIR . 'MataKuliah.php';

        $mata_kuliah = new MataKuliahRepository();
        $params['course'] = $mata_kuliah->getMataKuliah($params['id']);
        $params['pengajar'] = 'Yudhistira Dwi Wardhana Asnar';
        $params['course']['modules'] = [
            [
                'id' => 1,
                'nama' => 'Modul 1',
                'deskripsi' => 'Deskripsi Modul 1',
            ],
            [
                'id' => 2,
                'nama' => 'Modul 2',
                'deskripsi' => 'Deskripsi Modul 2',
            ],
            [
                'id' => 3,
                'nama' => 'Modul 3',
                'deskripsi' => 'Deskripsi Modul 3',
            ],
            [
                'id' => 4,
                'nama' => 'Modul 4',
                'deskripsi' => 'Deskripsi Modul 4',
            ],
            [
                'id' => 5,
                'nama' => 'Modul 5',
                'deskripsi' => 'Deskripsi Modul 5',
            ],
            [
                'id' => 6,
                'nama' => 'Modul 6',
                'deskripsi' => 'Deskripsi Modul 6',
            ],
            [
                'id' => 7,
                'nama' => 'Modul 7',
                'deskripsi' => 'Deskripsi Modul 7',
            ],
            [
                'id' => 8,
                'nama' => 'Modul 8',
                'deskripsi' => 'Deskripsi Modul 8',
            ],
            [
                'id' => 9,
                'nama' => 'Modul 9',
                'deskripsi' => 'Deskripsi Modul 9',
            ],
            [
                'id' => 10,
                'nama' => 'Modul 10',
                'deskripsi' => 'Deskripsi Modul 10',
            ],
        ];

        require_once VIEWS_DIR . 'user/courseDetail.php';
    }
}