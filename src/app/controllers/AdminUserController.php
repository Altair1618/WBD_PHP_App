<?php
class AdminUserController
{
  public function showUsers($params)
  {
    require_once VIEWS_DIR . 'admin/users.php';
  }

  public function showAddUserPage($params)
  {
    require_once VIEWS_DIR . 'admin/adduser.php';
  }

  public function showEditUserPage($params)
  {
    require_once VIEWS_DIR . 'admin/edituser.php';
  }

  public function getManyUsers($params)
  {
    $params['q-search'] = $params['q-search'] ?? null;

    $params['q-sort_param'] = $params['q-sort_param'] ?? 'id';
    $params['q-sort_order'] = $params['q-sort_order'] ?? 'asc';
    $params['q-user_type'] = $params['q-user_type'] ?? 'none';

    $params['q-sort_param'] = in_array($params['q-sort_param'], ['id', 'nama', 'username', 'created_at', 'updated_at']) ? $params['q-sort_param'] : 'id';
    $params['q-sort_order'] = in_array($params['q-sort_order'], ['asc', 'desc']) ? $params['q-sort_order'] : 'asc';
    $params['q-user_type'] = in_array($params['q-user_type'], ['dosen', 'mahasiswa']) ? $params['q-user_type'] : null;
    $params['q-user_type'] = ["dosen" => PENGGUNA_TIPE_PENGAJAR, "mahasiswa" => PENGGUNA_TIPE_MAHASISWA][$params['q-user_type']] ?? null;
    $params['page'] = $params['page'] ?? 1;

    require_once MODELS_DIR . 'Pengguna.php';
    $user_repo = new PenggunaRepository();
    $params['users'] = $user_repo->getPenggunaFiltered($params['q-search'], $params['q-user_type'], $params['q-sort_param'], $params['q-sort_order'], $params['page'], ITEMS_PER_PAGE);

    $item_count = $user_repo->getPenggunaFilteredCount($params['q-search']);
    $params['page_count'] = ceil($item_count / ITEMS_PER_PAGE);

    return $params;
  }

  public function getUsersHTML($params)
  {
    $params = $this->getManyUsers($params);
    $users = $params['users'];
?>
    <table>
      <thead>
        <tr>
          <th class="column-number">No</th>
          <th class="column-image"></th>
          <th class="column-name">Nama</th>
          <th class="column-username">Username</th>
          <th class="column-email">Email</th>
          <th class="column-type">Tipe</th>
          <th class="column-created-at">Waktu Dibuat</th>
          <th class="column-updated-at">Waktu Diubah</th>
          <th class="column-action">
            <a class="button-action-wrapper" href="/users/create">
              <button id="button-tambah" class="button-action">Tambah Pengguna</button>
            </a>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php $n = ($params['page'] - 1) * ITEMS_PER_PAGE + 1 ?>
        <?php foreach ($users as $user) : ?>
          <?php if (!is_admin($user)) : ?>
            <tr onclick="window.location='/users/<?= $user['id'] ?>'">
              <td class="column-number"><?= $n ?></td>
              <td class="column-image">
                <div class="img-wrapper">
                  <img src="<?= get_img_src($user) ?>" class="cell-img" alt="profile picture">
                </div>
              </td>
              <td class="column-name"><?= htmlspecialchars($user['nama']) ?></td>
              <td class="column-username"><?= htmlspecialchars($user['username']) ?></td>
              <td class="column-email"><?= htmlspecialchars($user['email']) ?></td>
              <td class="column-type"><?= tipe_to_str($user) ?></td>
              <td class="column-created-at"><?= $user['created_at'] ?></td>
              <td class="column-updated-at"><?= $user['updated_at'] ?></td>
              <td class="column-action">
                <div class="button-group">
                  <a class="button-action-wrapper" href="/users/<?= $user['id'] ?>/edit">
                    <button class="button-action button-ubah">Ubah</button>
                  </a>
                  <form class="button-action-wrapper" action="/users/<?= $user['id'] ?>/delete" method="POST">
                    <button class="button-action button-hapus">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
            <?php $n++ ?>
          <?php endif ?>
        <?php endforeach ?>
      </tbody>
    </table>
    <div class="body-footer" id="body-footer">
      <div class="page-number-centered">
        <?php $current_page = max((int) $params['page'], 1) ?>
        <?php $max_page = max((int) $params['page_count'], 1) ?>
        <?php $delta = $max_page - $current_page ?>
        <?php if ($current_page !== 1) : ?>
          <button class="page-control-button" id="button-prev">PREV</button>
        <?php else : ?>
          <button class="page-control-button hidden" id="button-prev" disabled>PREV</button>
        <?php endif ?>
        <div class="page-number-container" id="page-numbers">
          <?php if (0 <= $delta && $delta  < 2) {
            $min_page = max($current_page - 4 + $delta, 1);
          } else {
            $min_page = max($current_page - 2, 1);
          } ?>
          <?php for ($i = $min_page, $j = 1; $i <= $max_page && $j <= min($max_page - $min_page + 1, 5); $i++, $j++) : ?>
            <?php if ($j === 1) : ?>
              <button class="page-number-button" <?php if ($i === $current_page) : ?> id="current-page-button" <?php endif ?>>1</button>
            <?php elseif ($j === 5) : ?>
              <button class="page-number-button" <?php if ($i === $current_page) : ?> id="current-page-button" <?php endif ?>><?= $max_page ?></button>
            <?php elseif (($j === 4 && $i !== ($max_page - 1)) || ($j === 2 && $i !== 2)) : ?>
              <button class="page-number-button disabled" disabled>...</button>
            <?php else : ?>
              <button class="page-number-button" <?php if ($i === $current_page) : ?> id="current-page-button" <?php endif ?>><?= $i ?></button>
            <?php endif ?>
          <?php endfor ?>
        </div>
        <?php if ($current_page !== $max_page) : ?>
          <button class="page-control-button" id="button-next">NEXT</button>
        <?php else : ?>
          <button class="page-control-button hidden" id="button-next" disabled>NEXT</button>
        <?php endif ?>
      </div>
    </div>
<?php }

  public function addUser()
  {
    $_SESSION['errors'] = [];

    $user_repo = new PenggunaRepository();

    $new_name = $_POST['name'];
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $new_tipe = ["dosen" => 1, "mahasiswa" => 2][$_POST['tipe']] ?? 2;

    if ($user_repo->getPengguna(username: $new_username) !== false) {
      $_SESSION['errors']['username'] = "Username sudah ada";
    }

    if ($user_repo->getPengguna(email: $new_email) !== false) {
      $_SESSION['errors']['email'] = "Email sudah ada";
    }

    if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
      // asumsi semua email yang ada di database sudah valid
      $_SESSION['errors']['email'] = "Email tidak valid";
    }

    $image_name = null;
    if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
      if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        if (in_array($_FILES['image']['type'], ALLOWED_FILE_TYPES)) {
          $tmp_name = $_FILES['image']['tmp_name'];
          $image_name = $_FILES['image']['name'];
          if (!file_exists(UPLOADS_DIR)) {
            mkdir(UPLOADS_DIR, recursive: true);
          }
        } else {
          $_SESSION['errors']['file'] = "Tipe file tidak didukung";
        }
      } else {
        $_SESSION['errors']['file'] = "Upload file gagal";
      }
    }

    if (!empty($_SESSION['errors'])) {
      Router::getInstance()->redirect('/users/create');
    } else {
      unset($_SESSION['errors']);
      $user_repo->insertPengguna($new_username, $new_email, $new_password, $new_name, $new_tipe, $image_name);
      $user = $user_repo->getPengguna(username: $new_username);
      if (isset($image_name)) {
        move_uploaded_file($tmp_name, UPLOADS_DIR . "{$user['id']}-{$image_name}");
      }
      Logger::info(__FILE__, __LINE__, "User `{$user['username']}` added");
      Router::getInstance()->redirect('/users');
    }
  }

  public function editUser($params)
  {
    if (isset($_SESSION['user']) && $_SESSION['user']['tipe'] != PENGGUNA_TIPE_ADMIN) {
      require_once CONTROLLERS_DIR . 'UserController.php';
      $controller = new UserController();
      $controller->editProfile();
      return;
    }
    $_SESSION['errors'] = [];

    $user_repo = new PenggunaRepository();
    $user = $user_repo->getPengguna(id: (int) $params['id']);

    $new_name = $_POST['name'];
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $new_password = password_hash($_POST['new-password'], PASSWORD_DEFAULT);
    $new_tipe = ["dosen" => 1, "mahasiswa" => 2][$_POST['tipe']] ?? 2;

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
      Router::getInstance()->redirect("/users/{$user['id']}/edit");
    } else {
      unset($_SESSION['errors']);
      $user_repo->updatePengguna((int) $user['id'], $new_username, $new_email, $new_password, $new_name, $new_tipe, $image_name);
      Logger::info(__FILE__, __LINE__, "User `{$user['username']}` profile updated");
      Router::getInstance()->redirect('/users');
    }
  }

  public function deleteUser($params)
  {
    $user_repo = new PenggunaRepository();
    $user = $user_repo->getPengguna(id: (int) $params['id']);
    if ($user !== false) {
      $user_repo->deletePengguna(id: (int) $user['id']);
    }
    Logger::warn(__FILE__, __LINE__, "User `{$user['username']}` deleted");
    Router::getInstance()->redirect('/users');
  }

  public function showUserDetail($params)
  {
    $repo = new PenggunaRepository();
    $user = $repo->getPengguna(id: (int) $params['id']);
    if ($user === false) {
      Router::getInstance()->error(404);
    } else {
      require_once VIEWS_DIR . 'admin/userDetail.php';
    }
  }
}
