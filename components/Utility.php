<?php

class Utility
{
    public static function routeMethod()
    {
      $htaccess = ROOT . '/.htaccess';
      if (file_exists($htaccess)) {
        return '/';
      }
      return '/index.php?route=';
    }

    public static function redirectTo($route)
    {
      $redirectTo = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . self::routeMethod() . $route;
      header("Location: " . $redirectTo);
    }
}
