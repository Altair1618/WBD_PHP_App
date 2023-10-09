<?php

class AuthController
{
  public function showSignInPage()
  {
    require_once VIEWS_DIR . 'auth/sign-in.php';
  }

  public function showSignUpPage()
  {
    require_once VIEWS_DIR . 'auth/sign-up.php';
  }

  public function signIn()
  {
    $_SESSION['errors'] = [];

    $user_repo = new PenggunaRepository();

    $credentials = $_POST['credentials'];
    $password = $_POST['password'];
    if (filter_var($credentials, FILTER_VALIDATE_EMAIL)) {
      $user = $user_repo->getPengguna(email: $credentials);
    } else {
      $user = $user_repo->getPengguna(username: $credentials);
    }
    if ($user !== false && password_verify($password, $user['password_hash'])) {
      $_SESSION['user'] = $user;
      $_SESSION['isAuthenticated'] = true;
      Logger::info(__FILE__, __LINE__, "User `{$user['username']}` is logged in");
      if (isset($_SESSION['referer']) && $_SESSION['referer'] !== '/signout' && $_SESSION['referer'] !== '/signin') {
        $redirect = $_SESSION['referer'];
      }
      unset($_SESSION['errors']);
      if ($_SESSION['user']['tipe'] == PENGGUNA_TIPE_ADMIN) {
        if (isset($redirect) && $redirect == '/') {
          $redirect = '/admin/users';
        }
        Router::getInstance()->redirect($redirect ?? '/admin/users');
      } else {
        Router::getInstance()->redirect($redirect ?? '/');
      }
    } else {
      $_SESSION['errors']['auth'] = 'Username, email, atau password salah';
      Router::getInstance()->redirect('/signin');
    }
  }

  public function signUp()
  {
    $_SESSION['errors'] = [];

    $user_repo = new PenggunaRepository();

    $nama = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($user_repo->getPengguna(username: $username) !== false) {
      $_SESSION['errors']['username'] = 'Username sudah ada';
    }

    if ($user_repo->getPengguna(email: $email) !== false) {
      $_SESSION['errors']['email'] = 'Email sudah ada';
    } else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      $_SESSION['errors']['email'] = 'Email tidak valid';
    }

    if (!empty($_SESSION['errors'])) {
      Router::getInstance()->redirect('/signup');
    } else {
      $user_repo->insertPengguna($username, $email, $password_hash, $nama, PENGGUNA_TIPE_MAHASISWA);
      $_SESSION["user"] = $user_repo->getPengguna(username: $username);
      Logger::info(__FILE__, __LINE__, "user `$username` is logged in");
      unset($_SESSION['errors']);
      Router::getInstance()->redirect('/');
    }
  }

  public function signOut()
  {
    Logger::info(__FILE__, __LINE__, "User `{$_SESSION['user']['username']}` is logged out");
    if (isset($_SESSION['user'])) {
      unset($_SESSION['user']);
    }
    Router::getInstance()->redirect('/signin');
  }
}
