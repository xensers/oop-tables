<?php

require_once ROOT. '/modules/Crops.php';

class CropsController
{
    function actionView()
    {
        // Получение списка
        $cropsList = Crops::getList();

        // Проверка наличия глобальных уведомлений
        $status = (isset($GLOBALS['status'])) ? $GLOBALS['status'] : false ;

        // Подключение вида
        require_once ROOT.'/views/accounting/crops.php';
        return true;
    }

    public function actionAddRow()
    {
        $name = (isset($_POST['name'])) ? $_POST['name'] : false ;
        $GLOBALS['status'] = Crops::addRow($name);
        return false;
    }

    public function actionDeleteRow($id = false)
    {
        $GLOBALS['status'] = Crops::deleteRow($id);
        return false;
    }

}
