<?php

class UserController
{
    public function showProfilePage()
    {
        require_once VIEWS_DIR . 'user/profile.php';
    }

    public function showEditProfilePage()
    {
        require_once VIEWS_DIR . 'user/editProfile.php';
    }

    public function editProfile()
    {
        $_SESSION['errors'] = [];

        $user_repo = new PenggunaRepository();

        $user = $_SESSION['user'];

        $new_name = $_POST['name'];
        $new_username = $_POST['username'];
        $new_email = $_POST['email'];
        $old_password = $_POST['old-password'];

        if (!empty($old_password)) {
            if (password_verify($old_password, $user['password_hash'])) {
                assert(!empty($_POST['new-password'])); // kalo fail berarti ada bug
                $new_password = password_hash($_POST['new-password'], PASSWORD_DEFAULT);
            } else {
                $_SESSION['errors']['password'] = "Password salah";
            }
        } else {
            $new_password = $user['password_hash'];
        }

        if ($new_username !== $user['username'] && $user_repo->getPengguna(username: $new_username) !== false) {
            $_SESSION['errors']['username'] = "Username sudah ada";
        }

        if ($new_email !== $user['email'] && $user_repo->getPengguna(email: $new_email) !== false) {
            $_SESSION['errors']['email'] = "Email sudah ada";
        }

        if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
            // asumsi semua email yang ada di database sudah valid
            $_SESSION['errors']['email'] = "Email tidak valid";
        }

        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
                if (in_array($_FILES['image']['type'], ALLOWED_FILE_TYPES)) {
                    $tmp_name = $_FILES['image']['tmp_name'];
                    $image_name = $_FILES['image']['name'];

                    if (!file_exists(UPLOADS_DIR)) {
                        mkdir(UPLOADS_DIR, recursive: true);
                    }

                    move_uploaded_file($tmp_name, UPLOADS_DIR . "{$user['id']}-{$image_name}");

                    if (isset($user['gambar_profil']) && file_exists(UPLOADS_DIR . "{$user['id']}-{$user['gambar_profil']}")) {
                        unlink(UPLOADS_DIR . "{$user['id']}-{$user['gambar_profil']}");
                    }
                } else {
                    $_SESSION['errors']['file'] = "Tipe file tidak didukung";
                }
            } else {
                $_SESSION['errors']['file'] = "Upload file gagal";
            }
        } else {
            $image_name = $user['gambar_profil'];
        }

        if (!empty($_SESSION['errors'])) {
            Router::getInstance()->redirect('/profile/edit');
        } else {
            unset($_SESSION['errors']);
            $user_repo->updatePengguna((int) $user['id'], $new_username, $new_email, $new_password, $new_name, $user['tipe'], $image_name);
            $_SESSION['user'] = $user_repo->getPengguna(username: $new_username);
            Logger::info(__FILE__, __LINE__, "User `{$user['username']}` profile updated");
            Router::getInstance()->redirect('/profile/' . $user['id']);
        }
    }
}
