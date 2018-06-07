<?php include ROOT."/views/layouts/header.php" ?>

<h3>Сотрудники</h3>
  <div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th width="20">#</th>
          <th>Фамилия</th>
          <th>Имя</th>
          <th>Отчество</th>
          <th>Дата рождения</th>
          <th>Модель агрегата</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1; foreach ($employeesList as $employeesRow): ?>
          <tr>
              <td><?= $i++ ?></td>
              <td><?= $employeesRow['surname'] ?></td>
              <td><?= $employeesRow['name'] ?></td>
              <td><?= $employeesRow['patronymic'] ?></td>
              <td><?= $employeesRow['birthday'] ?></td>
              <td><?= $employeesRow['machine_name'] ?></td>
              <td class="text-right">
                <a href="<?= ROUTE_METHOD ?>employees/delete/<?= $employeesRow['id'] ?>" class="btn btn-danger">Удалить</a>
              </td>
          </tr>
        <?php endforeach ?>
        <tr class="info">
            <form action="<?= ROUTE_METHOD ?>employees/add" method="POST">
                <td>?</td>
                <td>
                  <div class="form-group <?= isset($status['error']['surname']) ? 'has-error has-feedback' : ''?>">
                    <input type="text" class="form-control" name="surname">
                  </div>
                  </td>
                <td>
                  <div class="form-group <?= isset($status['error']['name']) ? 'has-error has-feedback' : ''?>">
                    <input type="text" class="form-control" name="name">
                  </div>
                  </td>
                <td>
                  <div class="form-group <?= isset($status['error']['patronymic']) ? 'has-error has-feedback' : ''?>">
                    <input type="text" class="form-control" name="patronymic">
                  </div>
                  </td>
                <td>
                  <div class="form-group <?= isset($status['error']['birthday']) ? 'has-error has-feedback' : ''?>">
                    <input type="date" class="form-control" name="birthday">
                  </div>
                </td>
                <td>
                  <div class="form-group <?= isset($status['error']['machine_id']) ? 'has-error has-feedback' : ''?>">
                    <select class="form-control" name="machine_id">
                        <?php foreach ($machinesList as $key => $machine): ?>
                            <option value="<?= $machine['id'] ?>"><?= $machine['name'] ?></option>
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
                  <td colspan='7'><?= $error?></td>
              </tr>
            <?php endforeach ?>
        <?php endif ?>
        <?php if (isset($status['success'])): ?>
          <?php foreach ($status['success'] as $success): ?>
            <tr class="success">
                <td colspan='7'><?= $success ?></td>
            </tr>
          <?php endforeach ?>
        <?php endif ?>
      </tbody>
    </table>
  </div>

<?php include ROOT."/views/layouts/footer.php" ?>
