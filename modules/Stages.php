<?php

class Stages
{
    const TABLE_NAME = 'stages';
    public static function getList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса
        $sql = 'SELECT '.
                    ' s.id, '.
                    ' s.employe_id, '.
                    ' e.name AS employe_name, '.
                    ' e.surname AS employe_surname, '.
                    ' e.patronymic AS employe_patronymic, '.
                    ' s.type_id, '.
                    ' t.name AS type_name, '.
                    ' s.field_id, '.
                    ' f.name AS field_name, '.
                    ' f.area AS field_area, '.
                    ' s.beginning_date, '.
                    ' s.finished_date, '.
                    ' s.crop_id, '.
                    ' c.name AS crop_name '.
                'FROM stages s '.
                'LEFT JOIN employees e ON s.employe_id = e.id '.
                'LEFT JOIN types t ON s.type_id = t.id '.
                'LEFT JOIN fields f ON s.field_id = f.id '.
                'LEFT JOIN crops c ON s.crop_id = c.id '.
                'ORDER BY s.id ASC';

        // Подготовка запроса
        $result = $db->prepare($sql);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение запроса
        $result->execute();

        // Извлечение данных
        $i = 0;

        $list = array();
        while ($row = $result->fetch()) {

            $beginning_date = date_create($row['beginning_date']);
            $beginning_date = date_format($beginning_date, 'd.m.Y');

            $finished_date = date_create($row['finished_date']);
            $finished_date = date_format($finished_date, 'd.m.Y');

            $list[$i] = [
                'id'                 => htmlspecialchars($row['id']),
                'employe_id'         => (int) $row['employe_id'],
                'employe_name'       => htmlspecialchars($row['employe_name']),
                'employe_surname'    => htmlspecialchars($row['employe_surname']),
                'employe_patronymic' => htmlspecialchars($row['employe_patronymic']),
                'type_id'            => (int) $row['type_id'],
                'type_name'          => htmlspecialchars($row['type_name']),
                'field_id'           => (int) $row['field_id'],
                'field_name'         => htmlspecialchars($row['field_name']),
                'field_area'         => htmlspecialchars($row['field_area']),
                'beginning_date'     => $beginning_date,
                'finished_date'      => $finished_date,
                'crop_id'            => (int) $row['crop_id'],
                'crop_name'          => htmlspecialchars($row['crop_name']),
            ];
            $i++;
        }


        // Возврат данных
        return $list;
    }

    public static function addRow($employe_id, $type_id, $field_id, $crop_id, $beginning_date, $finished_date)
    {
        // Обьявление переменных
        $status = array();

        $employe_id     = (int) $employe_id;
        $type_id        = (int) $type_id;
        $field_id       = (int) $field_id;
        $crop_id        = (int) $crop_id;
        $beginning_date = htmlspecialchars($beginning_date);
        $finished_date  = htmlspecialchars($finished_date);

        // Валидация полей
        if (!$employe_id) {
            $status['error']['employe_id'] = 'Пустое значение поля "Сотрудник"';
        }
        if (!$type_id) {
            $status['error']['type_id'] = 'Пустое значение поля "Вид"';
        }
        if (!$field_id) {
            $status['error']['field_id'] = 'Пустое значение поля "Поле"';
        }
        if (!$crop_id) {
            $status['error']['crop_id'] = 'Пустое значение поля "Культура"';
        }

        if (!$beginning_date) {
          $status['error']['beginning_date'] = 'Пустое значение поля "Дата начала"';
        }elseif (!preg_match("/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/", $beginning_date)){
          $status['error']['beginning_date'] = 'Дата должна быть в формате YYYY-MM-DD';
        }
        if (!$finished_date) {
          $status['error']['finished_date'] = 'Пустое значение поля "Дата окончания"';
        }elseif (!preg_match("/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/", $finished_date)){
          $status['error']['finished_date'] = 'Дата должна быть в формате YYYY-MM-DD';
        }

        if (!isset($status['error'])) {
            // Соединение с БД
            $db = Db::getConnection();

            // Текст запроса
            $sql = 'INSERT INTO ' . self::TABLE_NAME . ' (
            employe_id,
            type_id,
            field_id,
            crop_id,
            beginning_date,
            finished_date
        ) VALUES (
        :employe_id,
        :type_id,
        :field_id,
        :crop_id,
        :beginning_date,
        :finished_date
    )';

            // Подготовка запроса
            $result = $db->prepare($sql);
            $result->bindParam(':employe_id',     $employe_id,     PDO::PARAM_STR);
            $result->bindParam(':type_id',        $type_id,        PDO::PARAM_STR);
            $result->bindParam(':field_id',       $field_id,       PDO::PARAM_STR);
            $result->bindParam(':crop_id',        $crop_id,        PDO::PARAM_STR);
            $result->bindParam(':beginning_date', $beginning_date, PDO::PARAM_STR);
            $result->bindParam(':finished_date',  $finished_date,  PDO::PARAM_STR);

            // Выполнение запроса
            if ($result->execute()) {
                $status['success']['reqest'] = 'Новая строка успешно создана';
            } else {
                $status['error']['reqest'] = 'Запрос не удался';
            }
        }

        return $status;
    }
    public static function deleteRow($id)
    {
        // Обьявление переменных
        $status = array();

        // Валидация полей
        if (!$id) {
            $status['error']['id'] = 'Не указан id удаляемого поля';
        }
        if (is_int($id)) {
            $status['error']['id'] = 'id должен быть числом';
        }

        if (!isset($status['error'])) {
            // Соединение с БД
            $db = Db::getConnection();

            // Текст запроса
            $sql = 'DELETE FROM ' . self::TABLE_NAME . ' WHERE id = :id';

            // Подготовка запроса
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            if ($result->execute()) {
                $status['success']['reqest'] = 'Строка успено удалена';
            } else {
                $status['error']['reqest'] = 'Запрос не удался';
            }
        }
        return $status;
    }
}
