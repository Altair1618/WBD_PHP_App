<?php

class UserController {
    public function showMyCourses($params) {
        $itemCount = 15;
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

        require_once VIEWS_DIR . 'user/myCourses.php';
    }
}
