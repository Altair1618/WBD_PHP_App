<?php

class CourseController {
    public function getManyCourses($params) {
        // TODO: Get From DB
        $itemCount = 100;
        $params['page_count'] = ceil($itemCount / ITEMS_PER_PAGE);
        
        $params['courses'] = [];
        if (!isset($params['page'])) $params['page'] = 1;

        for ($i = 0; $i < ITEMS_PER_PAGE; $i++) {
            $number = ($params['page'] - 1) * ITEMS_PER_PAGE + $i + 1;

            if ($number > $itemCount) break;

            $params['courses'][] = [
                "kode" => 'IF100' . $number,
                "nama" => 'Mata Kuliah ' . $number,
                "pengajar" => 'Dosen ' . $number,
            ];
        }

        return $params;
    }

    public function showMyCourses($params) {
        $params = $this->getManyCourses($params);

        require_once VIEWS_DIR . 'user/myCourses.php';
    }

    public function getCoursesHTML($params) {
        $params = $this->getManyCourses($params);

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
                            <a class='course-detail-button' href='/courses/{$course['kode']}'>Lihat</a>
                        </div>
                    </div>
                </div>
                ";
            }

            $body_html .= "
            </div>

            <div id='body-footer' class='body-footer'>
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
                <button id='current-page-button' class='current-page-button'>
                    {$params['page']}
                </button>
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
            ";
        }

        echo $body_html;
    }
}