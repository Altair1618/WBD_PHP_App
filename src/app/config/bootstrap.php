<?php

require_once __DIR__ . '/config.php';

require_once APP_DIR . 'utils/Database.php';
require_once APP_DIR . 'utils/Logger.php';
require_once APP_DIR . 'utils/Router.php';

require_once MODELS_DIR . 'Model.php';
require_once MODELS_DIR . 'Fakultas.php';
require_once MODELS_DIR . 'MataKuliah.php';
require_once MODELS_DIR . 'MateriKelas.php';
require_once MODELS_DIR . 'Modul.php';
require_once MODELS_DIR . 'Pengguna.php';
require_once MODELS_DIR . 'ProgramStudi.php';

require_once MIDDLEWARES_DIR . 'Middleware.php';

function is_admin($user)
{
  return $user['tipe'] == PENGGUNA_TIPE_ADMIN;
}

function get_img_src($user)
{
  if (isset($user['gambar_profil'])) {
    return "/assets/uploads/{$user['id']}-{$user['gambar_profil']}";
  } else {
    return '/assets/images/Portrait_Placeholder.png';
  }
}

function tipe_to_str($user)
{
  return ['Admin', 'Dosen', 'Mahasiswa'][$user['tipe']];
}
