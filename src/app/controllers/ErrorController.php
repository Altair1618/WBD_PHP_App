<?php

class ErrorController {
    public function showErrorPage($params) {
        http_response_code($params["errorCode"]);
        require_once VIEWS_DIR . "error.php";
    }
}