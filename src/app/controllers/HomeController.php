<?php

class HomeController {
    public function showHomePage() {
        require_once VIEWS_DIR . 'home/homepage.php';
    }
}