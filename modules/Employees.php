<?php

class Employees
{
    const TABLE_NAME = 'employees';
    public static function getList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса
        $sql = 'SELECT  e.id, e.surname, e.name, e.patronymic, e.birthday, e.machine_id, m.name AS machine_name '.
                'FROM employees e '.
                'JOIN machines m ON e.machine_id = m.id '.
                'ORDER BY e.id ASC';

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
            $date = date_create($row['birthday']);

            $list[$i] = [
                'id'   => (int) $row['id'],
                'surname' => htmlspecialchars($row['surname']),
                'name' => htmlspecialchars($row['name']),
                'patronymic' => htmlspecialchars($row['patronymic']),
                'birthday' => date_format($date, 'd.m.Y'),
                'machine_id' => (int) $row['machine_id'],
                'machine_name' => htmlspecialchars($row['machine_name']),
            ];
            $i++;
        }


        // Возврат данных
        return $list;
    }

    public static function addRow($surname, $name, $patronymic, $birthday, $machine_id)
    {
        // Обьявление переменных
        $status = array();

        $surname    = htmlspecialchars($surname);
        $name       = htmlspecialchars($name);
        $patronymic = htmlspecialchars($patronymic);
        $birthday   = htmlspecialchars($birthday);
        $machine_id = (int) $machine_id;

        // Валидация полей
        if (!$surname) {
            $status['error']['surname'] = 'Пустое значение поля "Фамилия"';
        } elseif (strlen($surname) > 255) {
            $status['error']['surname'] = 'Значение превышает 255 символов';
        }

        if (!$name) {
            $status['error']['name'] = 'Пустое значение поля "Имя"';
        } elseif (strlen($name) > 255) {
            $status['error']['name'] = 'Значение превышает 255 символов';
        }

        if (!$patronymic) {
            $status['error']['patronymic'] = 'Пустое значение поля "Отчество"';
        } elseif (strlen($patronymic) > 255) {
            $status['error']['patronymic'] = 'Значение превышает 255 символов';
        }

        if (!$birthday) {
          $status['error']['birthday'] = 'Пустое значение поля "Дата рождения"';
        }elseif (!preg_match("/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/", $birthday)){
          $status['error']['birthday'] = 'Дата должна быть в формате YYYY-MM-DD';
        }elseif(date('Y-m-d') < $birthday){
          $status['error']['birthday'] = 'К сожалению нельзя заставить работать еще не рожденного человека';
        }

        if (!isset($status['error'])) {
            // Соединение с БД
            $db = Db::getConnection();

            // Текст запроса
            $sql = 'INSERT INTO ' . self::TABLE_NAME . ' (surname, name, patronymic, birthday, machine_id) VALUES ( :surname, :name, :patronymic, :birthday, :machine_id)';

            // Подготовка запроса
            $result = $db->prepare($sql);
            $result->bindParam(':surname', $surname, PDO::PARAM_STR);
            $result->bindParam(':name', $name, PDO::PARAM_STR);
            $result->bindParam(':patronymic', $patronymic, PDO::PARAM_STR);
            $result->bindParam(':birthday', $birthday, PDO::PARAM_STR);
            $result->bindParam(':machine_id', $machine_id, PDO::PARAM_STR);

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
