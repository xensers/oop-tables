<?php

require_once ROOT. '/modules/Employees.php';
require_once ROOT. '/modules/Machines.php';

class EmployeesController
{
    function actionView()
    {
        // Получение списка
        $employeesList = Employees::getList();
        $machinesList  = Machines::getList();

        // Проверка наличия глобальных уведомлений
        $status = (isset($GLOBALS['status'])) ? $GLOBALS['status'] : false ;

        // Подключение вида
        require_once ROOT.'/views/accounting/employees.php';
        return true;
    }

    public function actionAddRow()
    {
        $surname    = (isset($_POST['surname']))    ? $_POST['surname']    : false;
        $name       = (isset($_POST['name']))       ? $_POST['name']       : false;
        $patronymic = (isset($_POST['patronymic'])) ? $_POST['patronymic'] : false;
        $birthday   = (isset($_POST['birthday']))   ? $_POST['birthday']   : false;
        $machine_id = (isset($_POST['machine_id'])) ? $_POST['machine_id'] : false;
        $GLOBALS['status'] = Employees::addRow($surname, $name, $patronymic, $birthday, $machine_id);
        return false;
    }

    public function actionDeleteRow($id = false)
    {
        $GLOBALS['status'] = Employees::deleteRow($id);
        return false;
    }

}
