<?php

class Authentication extends Middleware {
    public function handle($params) {
        // TODO: Implement Validation process
        // Put boolean into $_SESSION['isAuthenticated']
        // If authenticated, put user data into $_SESSION['user']
        
        $_SESSION['isAuthenticated'] = true;
        $_SESSION['user'] = [
            'id' => 1,
            'name' => 'Yi Long Ma',
            'email' => 'yilongma@mail.com',
            'tipe' => 'mahasiswa',
        ];
    }
}