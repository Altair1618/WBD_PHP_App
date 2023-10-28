<?php
function is_admin($user)
{
  return $user['tipe'] == PENGGUNA_TIPE_ADMIN;
}

function get_img_src($user)
{
  if (isset($user['gambar_profil'])) {
    return '/assets/uploads/' . $user['id'] . '-' . $user['gambar_profil'];
  } else {
    return '/assets/images/Portrait_Placeholder.png';
  }
}

function tipe_to_str($user)
{
  return ['Admin', 'Dosen', 'Mahasiswa'][$user['tipe']];
}

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
    <div class="table-container" id="table-container">
      <div class="table-column" id="column-no">
        <p class="cell cell-header" id="header-no">No</p>
        <?php $n = 1 ?>
        <?php foreach ($users as $user) : ?>
          <?php if (!is_admin($user)) : ?>
            <p class="cell cell-value"><?= $n ?></p>
            <?php $n++ ?>
          <?php endif ?>
        <?php endforeach ?>
      </div>
      <div class="table-column" id="column-profpic">
        <p class="cell cell-header" id="header-profpic"></p>
        <?php foreach ($users as $user) : ?>
          <?php if (!is_admin($user)) : ?>
            <div class="cell cell-value img-wrapper">
              <img src="<?= get_img_src($user) ?>" class="cell-img" alt="profile picture">
            </div>
          <?php endif ?>
        <?php endforeach ?>
      </div>
      <div class="table-column" id="column-name">
        <p class="cell cell-header" id="header-name">Nama</p>
        <?php foreach ($users as $user) : ?>
          <?php if (!is_admin($user)) : ?>
            <p class="cell cell-value"><?= htmlspecialchars($user['nama']) ?></p>
          <?php endif ?>
        <?php endforeach ?>
      </div>
      <div class="table-column" id="column-username">
        <p class="cell cell-header" id="header-username">Username</p>
        <?php foreach ($users as $user) : ?>
          <?php if (!is_admin($user)) : ?>
            <p class="cell cell-value"><?= htmlspecialchars($user['username']) ?></p>
          <?php endif ?>
        <?php endforeach ?>
      </div>
      <div class="table-column" id="column-email">
        <p class="cell cell-header" id="header-email">Email</p>
        <?php foreach ($users as $user) : ?>
          <?php if (!is_admin($user)) : ?>
            <p class="cell cell-value"><?= htmlspecialchars($user['email']) ?></p>
          <?php endif ?>
        <?php endforeach ?>
      </div>
      <div class="table-column" id="column-type">
        <p class="cell cell-header" id="header-type">Tipe</p>
        <?php foreach ($users as $user) : ?>
          <?php if (!is_admin($user)) : ?>
            <p class="cell cell-value"><?= tipe_to_str($user) ?></p>
          <?php endif ?>
        <?php endforeach ?>
      </div>
      <div class="table-column" id="column-created-time">
        <p class="cell cell-header" id="header-created-time">Waktu Dibuat</p>
        <?php foreach ($users as $user) : ?>
          <?php if (!is_admin($user)) : ?>
            <p class="cell cell-value"><?= $user['created_at'] ?></p>
          <?php endif ?>
        <?php endforeach ?>
      </div>
      <div class="table-column" id="column-updated-time">
        <p class="cell cell-header" id="header-updated-time">Waktu Diubah</p>
        <?php foreach ($users as $user) : ?>
          <?php if (!is_admin($user)) : ?>
            <p class="cell cell-value"><?= $user['updated_at'] ?></p>
          <?php endif ?>
        <?php endforeach ?>
      </div>
      <div class="table-column" id="column-button">
        <button id="button-tambah" onclick="window.location='/admin/adduser'">Tambah pengguna</button>
        <?php foreach ($users as $user) : ?>
          <?php if (!is_admin($user)) : ?>
            <div class="button-group">
              <button class="button-action button-ubah" onclick="window.location='/admin/edituser/<?= $user['id'] ?>'">Ubah</button>
              <form action="/admin/deleteuser/<?= $user['id'] ?>" method="POST">
                <button class="button-action button-hapus">Hapus</button>
              </form>
            </div>
          <?php endif ?>
        <?php endforeach ?>
      </div>
    </div>
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
    $new_password = $_POST['password'];
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
      Router::getInstance()->redirect('/admin/adduser');
    } else {
      unset($_SESSION['errors']);
      $user_repo->insertPengguna($new_username, $new_email, $new_password, $new_name, $new_tipe, $image_name);
      $user = $user_repo->getPengguna(username: $new_name);
      if (isset($image_name)) {
        move_uploaded_file($tmp_name, UPLOADS_DIR . "{$user['id']}-{$image_name}");
      }
      Logger::info(__FILE__, __LINE__, "User `{$user['username']}` added");
      Router::getInstance()->redirect('/admin/users');
    }
  }

  public function editUser($params)
  {
    $_SESSION['errors'] = [];

    $user_repo = new PenggunaRepository();
    $user = $user_repo->getPengguna(id: (int) $params['id']);

    $new_name = $_POST['name'];
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $old_password = $_POST['old-password'];
    $new_password = $_POST['new-password'];
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

    if (!empty($old_password) && !password_verify($old_password, $user['password_hash'])) {
      $_SESSION['errors']['password'] = "Password salah";
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
      Router::getInstance()->redirect('/admin/edituser/' . $user['id']);
    } else {
      unset($_SESSION['errors']);
      $user_repo->updatePengguna((int) $user['id'], $new_username, $new_email, $new_password, $new_name, $new_tipe, $image_name);
      Logger::info(__FILE__, __LINE__, "User `{$user['username']}` profile updated");
      Router::getInstance()->redirect('/admin/users');
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
    Router::getInstance()->redirect('/admin/users');
  }
}
