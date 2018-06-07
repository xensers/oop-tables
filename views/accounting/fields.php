
<?php include ROOT."/views/layouts/header.php" ?>

<h3>Обрабатываемые поля</h3>
  <div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th width="20">#</th>
          <th>Поле</th>
          <th>Площядь поля (га)</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1; foreach ($fieldsList as $fieldRow): ?>
          <tr>
              <td><?= $i++ ?></td>
              <td><?= $fieldRow['name'] ?></td>
              <td><?= $fieldRow['area'] ?></td>
              <td class="text-right">
                <a href="<?= ROUTE_METHOD ?>fields/delete/<?= $fieldRow['id'] ?>" class="btn btn-danger">Удалить</a>
              </td>
          </tr>
        <?php endforeach ?>
        <tr class="info">
            <form action="<?= ROUTE_METHOD ?>fields/add" method="POST">
                <td>?</td>
                <td>
                  <div class="form-group <?= isset($status['error']['name']) ? 'has-error has-feedback' : ''?>">
                    <input type="text" class="form-control" name="name">
                  </div>
                  </td>
                <td>
                  <div class="form-group <?= isset($status['error']['area']) ? 'has-error has-feedback' : ''?>">
                    <input type="text" class="form-control" name="area">
                  </div>
                  </td>
                <td class="text-right"><button type="submit" class="btn btn-primary">Добавить</button></td>
            </form>
        </tr>
        <?php if (isset($status['error'])): ?>
            <?php foreach ($status['error'] as $error): ?>
              <tr class="danger">
                  <td colspan='4'><?= $error?></td>
              </tr>
            <?php endforeach ?>
        <?php endif ?>
        <?php if (isset($status['success'])): ?>
          <?php foreach ($status['success'] as $success): ?>
            <tr class="success">
                <td colspan='4'><?= $success ?></td>
            </tr>
          <?php endforeach ?>
        <?php endif ?>
      </tbody>
    </table>
  </div>

<?php include ROOT."/views/layouts/footer.php" ?>
