<?php

require_once ROOT. '/modules/Stages.php';
require_once ROOT. '/modules/Employees.php';
require_once ROOT. '/modules/Types.php';
require_once ROOT. '/modules/Fields.php';
require_once ROOT. '/modules/Crops.php';

class stagesController
{
    function actionView()
    {
        // Получение списка
        $stagesList = Stages::getList();
        $employeesList  = Employees::getList();
        $typesList  = Types::getList();
        $fieldsList  = Fields::getList();
        $cropsList  = Crops::getList();

        // Проверка наличия глобальных уведомлений
        $status = (isset($GLOBALS['status'])) ? $GLOBALS['status'] : false ;

        // Подключение вида
        require_once ROOT.'/views/accounting/stages.php';
        return true;
    }

    public function actionAddRow()
    {
        $employe_id     = (isset($_POST['employe_id']))     ? $_POST['employe_id']     : false;
        $type_id        = (isset($_POST['type_id']))        ? $_POST['type_id']        : false;
        $field_id       = (isset($_POST['field_id']))       ? $_POST['field_id']       : false;
        $crop_id        = (isset($_POST['crop_id']))        ? $_POST['crop_id']        : false;
        $beginning_date = (isset($_POST['beginning_date'])) ? $_POST['beginning_date'] : false;
        $finished_date  = (isset($_POST['finished_date']))  ? $_POST['finished_date']  : false;
        $GLOBALS['status'] = Stages::addRow($employe_id, $type_id, $field_id, $crop_id, $beginning_date, $finished_date);
        return false;
    }

    public function actionDeleteRow($id = false)
    {
        $GLOBALS['status'] = Stages::deleteRow($id);
        return false;
    }

}
