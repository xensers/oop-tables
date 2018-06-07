<?php

// 1. Подключение файлов
  require_once(__DIR__.'/components/Utility.php');
  require_once(__DIR__.'/components/Db.php');
  require_once(__DIR__.'/components/Router.php');

// 2. Общие настройки
  define('ROOT', dirname(__FILE__));
  define('ROUTE_METHOD', Utility::routeMethod());
  define('HOME_PAGE', 'stages');
  define('E404_PAGE', HOME_PAGE);

  // Обтображение ошибок
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

// 3. Вызов Router
  $router = new Router();
  $router->run();
