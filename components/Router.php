<?php

/**
* Router
*/
class Router
{
  private $routes;

  public function __construct()
  {
    $routesPath = ROOT.'/config/routes.php';
    $this->routes = include($routesPath);
  }

  private function getURL()
  {
    if (!empty($_GET['route'])) {

      if(stristr($_GET['route'], '?route')) {
        $_GET['route'] = preg_replace("~\?route=~", '', $_GET['route']);
      }

      $urlData = explode('?', $_GET['route']);

      if (!empty($urlData[0])) {
        $route = $urlData[0];
      }else{
        $route = HOME_PAGE;
      }

      if (!empty($urlData[1])) {
        parse_str($urlData[1], $get);
        $_GET = array_merge($_GET, $get);
      }
      $_GET['route'] = $route;

      return trim($_GET['route'], '/');
    }else{
      return $_GET['route'] = HOME_PAGE;
    }
  }


  public function run()
  {
      // Получаем строку запроса
      $url = $this->getURL();
      // Проверяем наличие такого запроса в массиве маршрутов (routes.php)
      foreach ($this->routes as $urlPattern => $path) {
          // Сравниваем $urlPattern и $url
          if (preg_match("~$urlPattern~", $url)) {
              // Получаем внутренний путь из внешнего согласно правилу.
              $internalRoute = preg_replace("~$urlPattern~", $path, $url);

              // Определить контроллер, action, параметры
              $segments = explode('/', $internalRoute);
              $controllerName = array_shift($segments) . 'Controller';
              $controllerName = ucfirst($controllerName);
              $actionName = 'action' . ucfirst(array_shift($segments));
              $parameters = $segments;

              // Подключить файл класса-контроллера
              $controllerFile = ROOT . '/controllers/' .
                      $controllerName . '.php';
              if (file_exists($controllerFile)) {
                  include_once($controllerFile);
              }

              // Создать объект, вызвать метод (т.е. action)
              $controllerObject = new $controllerName;

              /* Вызываем необходимый метод ($actionName) у определенного 
               * класса ($controllerObject) с заданными ($parameters) параметрами
               */
              $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

              // Если метод контроллера успешно вызван, завершаем работу роутера
              if ($result != null) {
                  break;
              }
          }
      }
  }

}
