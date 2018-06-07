<?php

require_once ROOT. '/modules/Machines.php';

class MachinesController
{
    function actionView()
    {
        // Получение списка
        $machinesList = Machines::getList();

        // Проверка наличия глобальных уведомлений
        $status = (isset($GLOBALS['status'])) ? $GLOBALS['status'] : false ;

        // Подключение вида
        require_once ROOT.'/views/accounting/machines.php';
        return true;
    }

    public function actionAddRow()
    {
        $name = (isset($_POST['name'])) ? $_POST['name'] : false ;
        $GLOBALS['status'] = Machines::addRow($name);
        return false;
    }

    public function actionDeleteRow($id = false)
    {
        $GLOBALS['status'] = Machines::deleteRow($id);
        return false;
    }

}
