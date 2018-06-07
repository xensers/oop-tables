<?php include ROOT."/views/layouts/header.php" ?>

<h3>Этапы обработки</h3>
  <div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th width="20">#</th>
          <th>Сотрудник</th>
          <th>Вид</th>
          <th width="80">Поле</th>
          <th>Площядь</th>
          <th>Дата начала</th>
          <th>Дата окончания</th>
          <th>Культура</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1; foreach ($stagesList as $stagesRow): ?>
          <tr>
              <td><?= $i++ ?></td>
              <td><?= $stagesRow['employe_name'] ?> <?= $stagesRow['employe_surname'] ?> <?= $stagesRow['employe_patronymic'] ?></td>
              <td><?= $stagesRow['type_name'] ?></td>
              <td><?= $stagesRow['field_name'] ?></td>
              <td><?= $stagesRow['field_area'] ?> га</td>
              <td><?= $stagesRow['beginning_date'] ?></td>
              <td><?= $stagesRow['finished_date'] ?></td>
              <td><?= $stagesRow['crop_name'] ?></td>
              <td class="text-right">
                <a href="<?= ROUTE_METHOD ?>stages/delete/<?= $stagesRow['id'] ?>" class="btn btn-danger">Удалить</a>
              </td>
          </tr>
        <?php endforeach ?>
        <tr class="info">
            <form action="<?= ROUTE_METHOD ?>stages/add" method="POST">
                <td>?</td>
                <td>
                  <div class="form-group <?= isset($status['error']['employe_id']) ? 'has-error has-feedback' : ''?>">
                    <select class="form-control" name="employe_id">
                        <?php foreach ($employeesList as $key => $employe): ?>
                            <option value="<?= $employe['id'] ?>"><?= $employe['name'] ?> <?= $employe['surname'] ?> <?= $employe['patronymic'] ?></option>
                        <?php endforeach ?>
                    </select>
                  </div>
                </td>
                <td>
                  <div class="form-group <?= isset($status['error']['type_id']) ? 'has-error has-feedback' : ''?>">
                    <select class="form-control" name="type_id">
                        <?php foreach ($typesList as $key => $type): ?>
                            <option value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                  </div>
                </td>
                <td colspan="2">
                  <div class="form-group <?= isset($status['error']['field_id']) ? 'has-error has-feedback' : ''?>">
                    <select class="form-control" name="field_id">
                        <?php foreach ($fieldsList as $key => $field): ?>
                            <option value="<?= $field['id'] ?>"><?= $field['name'] ?> - <?= $field['area'] ?> га</option>
                        <?php endforeach ?>
                    </select>
                  </div>
                </td>
                <td>
                  <div class="form-group <?= isset($status['error']['beginning_date']) ? 'has-error has-feedback' : ''?>">
                    <input type="date" class="form-control" name="beginning_date">
                  </div>
                </td>
                <td>
                  <div class="form-group <?= isset($status['error']['finished_date']) ? 'has-error has-feedback' : ''?>">
                    <input type="date" class="form-control" name="finished_date">
                  </div>
                </td>
                <td>
                  <div class="form-group <?= isset($status['error']['crop_id']) ? 'has-error has-feedback' : ''?>">
                    <select class="form-control" name="crop_id">
                        <?php foreach ($cropsList as $key => $crop): ?>
                            <option value="<?= $crop['id'] ?>"><?= $crop['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                  </div>
                </td>
                <td class="text-right"><button type="submit" class="btn btn-primary">Добавить</button></td>
            </form>
        </tr>

        <?php if (isset($status['error'])): ?>
            <?php foreach ($status['error'] as $error): ?>
              <tr class="danger">
                  <td colspan='10'><?= $error?></td>
              </tr>
            <?php endforeach ?>
        <?php endif ?>
        <?php if (isset($status['success'])): ?>
          <?php foreach ($status['success'] as $success): ?>
            <tr class="success">
                <td colspan='10'><?= $success ?></td>
            </tr>
          <?php endforeach ?>
        <?php endif ?>
      </tbody>
    </table>
  </div>

<?php include ROOT."/views/layouts/footer.php" ?>
