<?php

class Authentication extends Middleware {
    public function handle($params) {
        $_GET['nama'] = 'Yi Long Musk';
    }
}