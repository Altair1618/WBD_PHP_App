<?php
class AdminFakultasController
{
  public function showFakultas($params)
  {
    require_once VIEWS_DIR . 'admin/fakultas.php';
  }

  public function showAddFakultasPage($params)
  {
    require_once VIEWS_DIR . 'admin/addfakultas.php';
  }

  public function showEditFakultasPage($params)
  {
    require_once VIEWS_DIR . 'admin/editfakultas.php';
  }

  public function getManyFakultas($params)
  {
    $params['q-search'] = $params['q-search'] ?? null;

    $params['q-sort_param'] = $params['q-sort_param'] ?? 'kode';
    $params['q-sort_order'] = $params['q-sort_order'] ?? 'asc';

    $params['q-sort_param'] = in_array($params['q-sort_param'], ['kode', 'created_at', 'updated_at']) ? $params['q-sort_param'] : 'kode';
    $params['q-sort_order'] = in_array($params['q-sort_order'], ['asc', 'desc']) ? $params['q-sort_order'] : 'asc';
    $params['page'] = $params['page'] ?? 1;

    require_once MODELS_DIR . 'Pengguna.php';
    $fakul_repo = new FakultasRepository();
    $params['fakultas'] = $fakul_repo->getFakultasFiltered($params['q-search'], $params['q-sort_param'], $params['q-sort_order'], $params['page'], ITEMS_PER_PAGE);

    $item_count = $fakul_repo->getFakultasFilteredCount($params['q-search']);
    $params['page_count'] = ceil($item_count / ITEMS_PER_PAGE);

    return $params;
  }

  public function getFakultasHTML($params)
  {
    $params = $this->getManyFakultas($params);
    $fakultas = $params['fakultas'];
?>
    <div class="table-container" id="table-container">
      <div class="table-column" id="column-no">
        <p class="cell cell-header" id="header-no">No</p>
        <?php $n = 1 ?>
        <?php foreach ($fakultas as $fakul) : ?>
          <p class="cell cell-value"><?= $n ?></p>
        <?php endforeach ?>
      </div>

      <div class="table-column" id="column-kode">
        <p class="cell cell-header" id="header-kode">Kode Fakultas</p>
        <?php foreach ($fakultas as $fakul) : ?>
          <p class="cell cell-value"><?= htmlspecialchars($fakul['kode']) ?></p>
        <?php endforeach ?>
      </div>

      <div class="table-column" id="column-name">
        <p class="cell cell-header" id="header-name">Nama</p>
        <?php foreach ($fakultas as $fakul) : ?>
          <p class="cell cell-value"><?= htmlspecialchars($fakul['nama']) ?></p>
        <?php endforeach ?>
      </div>

      <div class="table-column" id="column-created-time">
        <p class="cell cell-header" id="header-created-time">Waktu Dibuat</p>
        <?php foreach ($fakultas as $fakul) : ?>
          <p class="cell cell-value"><?= $fakul['created_at'] ?></p>
        <?php endforeach ?>
      </div>

      <div class="table-column" id="column-updated-time">
        <p class="cell cell-header" id="header-updated-time">Waktu Diubah</p>
        <?php foreach ($fakultas as $fakul) : ?>
          <p class="cell cell-value"><?= $fakul['updated_at'] ?></p>
        <?php endforeach ?>
      </div>
      <div class="table-column" id="column-button">
        <button id="button-tambah" onclick="window.location='/admin/addfakultas'">Tambah Fakultas</button>
        <?php foreach ($fakultas as $fakul) : ?>
          <div class="button-group">
            <button class="button-action button-ubah" onclick="window.location='/admin/editfakultas/<?= $fakul['kode'] ?>'">Ubah</button>
            <form action="/admin/deletefakultas/<?= $fakul['kode'] ?>" method="POST">
              <button class="button-action button-hapus">Hapus</button>
            </form>
          </div>
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

  public function addFakultas()
  {
    $_SESSION['errors'] = [];

    $repo = new FakultasRepository();

    $new_kode = $_POST['kode'];
    $new_name = $_POST['name'];

    if ($repo->getFakultas($new_kode) !== false) {
      $_SESSION['errors']['kode'] = "Kode fakultas sudah ada";
    }

    if (!empty($_SESSION['errors'])) {
      Router::getInstance()->redirect('/admin/addfakultas');
    } else {
      unset($_SESSION['errors']);
      $repo->insertFakultas($new_kode, $new_name);
      Logger::info(__FILE__, __LINE__, "Fakultas `$new_kode` added");
      Router::getInstance()->redirect('/admin/fakultas');
    }
  }

  public function editFakultas($params)
  {
    $repo = new FakultasRepository();
    $fakul = $repo->getFakultas($params['kode']);

    $new_name = $_POST['name'];

    $repo->updateFakultas($fakul['kode'], $new_name);
    Logger::info(__FILE__, __LINE__, "Fakultas `{$fakul['kode']}` updated");
    Router::getInstance()->redirect('/admin/fakultas');
  }
}
