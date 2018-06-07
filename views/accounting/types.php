<?php include ROOT."/views/layouts/header.php" ?>

<h3>Виды обработки полей</h3>
  <div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th width="20">#</th>
          <th>Вид обработки</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1; foreach ($typesList as $typesRow): ?>
          <tr>
              <td><?= $i++ ?></td>
              <td><?= $typesRow['name'] ?></td>
              <td class="text-right">
                <a href="<?= ROUTE_METHOD ?>types/delete/<?= $typesRow['id'] ?>" class="btn btn-danger">Удалить</a>
              </td>
          </tr>
        <?php endforeach ?>
        <tr class="info">
            <form action="<?= ROUTE_METHOD ?>types/add" method="POST">
                <td>?</td>
                <td>
                  <div class="form-group <?= isset($status['error']['name']) ? 'has-error has-feedback' : ''?>">
                    <input type="text" class="form-control" name="name">
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
