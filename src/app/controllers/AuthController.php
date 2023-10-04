<?php

class AuthController {
    public function showSignInPage() {
        require_once VIEWS_DIR . 'auth/sign-in.php';
    }

    public function showSignUpPage() {
        require_once VIEWS_DIR . 'auth/sign-up.php';
    }

    public function signIn() {
        $user_repo = new PenggunaRepository();

        $credentials = $_POST['credentials'];
        $password = $_POST['password'];
        if (filter_var($credentials, FILTER_VALIDATE_EMAIL)) {
            $user = $user_repo->getPengguna(email: $credentials);
        } else {
            $user = $user_repo->getPengguna(username: $credentials);
        }
        if ($user !== false && password_verify($password, $user['password_hash'])) {
            $_SESSION["user"] = $user;
            Logger::info(__FILE__, __LINE__, "User `{$user['username']}` is logged in");
            Router::getInstance()->redirect('/');
        } else {
            Router::getInstance()->redirect('/signin?error');
        }
    }

    public function signUp() {
        $user_repo = new PenggunaRepository();

        $nama = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if ($user_repo->getPengguna(username: $username) !== false) {
            Router::getInstance()->redirect('/signup?error=username');
        } else if ($user_repo->getPengguna(email: $email) !== false) {
            Router::getInstance()->redirect('/signup?error=email');
        } else {
            $user_repo->insertPengguna($username, $email, $password_hash, $nama, PENGGUNA_TIPE_MAHASISWA);
            $_SESSION["user"] = $user_repo->getPengguna(username: $username);
            Logger::info(__FILE__, __LINE__, "user `$username` is logged in");
            Router::getInstance()->redirect('/');
        }
    }

    public function signOut() {
        // TODO: Delete User from Session or anything that implemented in signIn
        Router::getInstance()->redirect('/signin');
    }
}
