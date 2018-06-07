<?php

require_once ROOT. '/modules/Fields.php';

class FieldsController
{
    function actionView()
    {
        // Получение списка
        $fieldsList = Fields::getList();

        // Проверка наличия глобальных уведомлений
        $status = (isset($GLOBALS['status'])) ? $GLOBALS['status'] : false ;

        // Подключение вида
        require_once ROOT.'/views/accounting/fields.php';
        return true;
    }

    public function actionAddRow()
    {
        $name = (isset($_POST['name'])) ? $_POST['name'] : false ;
        $area = (isset($_POST['area'])) ? $_POST['area'] : false ;
        $GLOBALS['status'] = Fields::addRow($name, $area);
        return false;
    }

    public function actionDeleteRow($id = false)
    {
        $GLOBALS['status'] = Fields::deleteRow($id);
        return false;
    }

}
