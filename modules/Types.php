<?php

class Types
{
    const TABLE_NAME = 'types';
    public static function getList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса
        $sql = 'SELECT * FROM ' . self::TABLE_NAME . ' ORDER BY id ASC';

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
            $list[$i] = [
                'id'   => $row['id'],
                'name' => htmlspecialchars($row['name']),
            ];
            $i++;
        }

        // Возврат данных
        return $list;
    }

    public static function addRow($name = false)
    {
        // Обьявление переменных
        $status = array();
        $name = htmlspecialchars($name);

        // Валидация полей
        if (!$name) {
            $status['error']['name'] = 'Пустое значение поля';
        }
        if (strlen($name) > 255) {
            $status['error']['name'] = 'Значение превышает 255 символов';
        }

        if (!isset($status['error'])) {
            // Соединение с БД
            $db = Db::getConnection();

            // Текст запроса
            $sql = 'INSERT INTO ' . self::TABLE_NAME . ' (name) VALUES (:name)';

            // Подготовка запроса
            $result = $db->prepare($sql);
            $result->bindParam(':name', $name, PDO::PARAM_STR);

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
