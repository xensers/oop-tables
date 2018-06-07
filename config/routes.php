<?php
return array(
  'crops/add' => 'crops/addRow',
  'crops/delete/([0-9]+)' => 'crops/deleteRow/$1',
  'crops'     => 'crops/view',

  'types/add' => 'types/addRow',
  'types/delete/([0-9]+)' => 'types/deleteRow/$1',
  'types'     => 'types/view',

  'fields/add' => 'fields/addRow',
  'fields/delete/([0-9]+)' => 'fields/deleteRow/$1',
  'fields'     => 'fields/view',

  'stages/add' => 'stages/addRow',
  'stages/delete/([0-9]+)' => 'stages/deleteRow/$1',
  'stages'     => 'stages/view',

  'employees/add' => 'employees/addRow',
  'employees/delete/([0-9]+)' => 'employees/deleteRow/$1',
  'employees'     => 'employees/view',

  'machines/add' => 'machines/addRow',
  'machines/delete/([0-9]+)' => 'machines/deleteRow/$1',
  'machines'     => 'machines/view',

  'index'     => 'site/index',
);
