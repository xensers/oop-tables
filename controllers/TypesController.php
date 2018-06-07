<?php

require_once ROOT. '/modules/Types.php';

class TypesController
{
    function actionView()
    {
        // Получение списка
        $typesList = Types::getList();

        // Проверка наличия глобальных уведомлений
        $status = (isset($GLOBALS['status'])) ? $GLOBALS['status'] : false ;

        // Подключение вида
        require_once ROOT.'/views/accounting/types.php';
        return true;
    }

    public function actionAddRow()
    {
        $name = (isset($_POST['name'])) ? $_POST['name'] : false ;
        $GLOBALS['status'] = Types::addRow($name);
        return false;
    }

    public function actionDeleteRow($id = false)
    {
        $GLOBALS['status'] = Types::deleteRow($id);
        return false;
    }

}
