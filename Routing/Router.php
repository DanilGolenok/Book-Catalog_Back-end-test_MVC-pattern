<?php 

class Router 
{
    
  /**
   * Парсит $url на массив: 
   * 0 => имя контроллера
   * 1 => имя действия внутри контроллера
   *
   * @param string $url   
   * @return array
   */
  public static function parse($url)
  {
    $url = str_replace('%20', ' ', $url);

    // Индекс вхождения get параметро в строке $url
    $idx = static::checkGetParams($url);
    
    // Массив get параметров
    $get = [];

    if ($idx != 0) {
      $get = static::parseGetParams($url, $idx);

      // Убераем get параметры из строки запроса
      $url = substr($url, 0, $idx);
    }
  
    if ($url == WEB) {
      return [
        'controller' => 'site',
        'action'     => 'index',
        'get'        => $get
      ]; 
    }

    $params = explode('/', $url);    
    $params = array_slice($params, 2);

    return [
      'controller' => $params[0],
      'action'     => $params[1],
      'get'        => $get
    ];
  }

  /**
   * Функция проверяет наличие get параметров в строке запроса
   *
   * @param $url
   * @return int
   */
  private static function checkGetParams($url)
  {
    return strpos($url, '?');
  }

  /**
   * Функция парсит строку запроса, 
   * возвращая get параметры в виде ассоциативного массива  
   *
   * @param string $url
   * @param int $idx - индекс начала подстроки с get параметрами
   * @return array
   */
  private static function parseGetParams($url, $idx)
  {
    // Записываем get параметры в переменную (string)
    // "id=2&name=exampleName"
    $params = substr($url, $idx + 1, strlen($url) - $idx);

    // ["id=2", "name=exampleName"]
    $params = explode('&', $params);
    
    $parsedParams = [];

    foreach ($params as $param) {
      // get ["id", "2"]
      $explodeParam = explode('=', $param);

      // 0 => paramName, 1 => paramValue
      $parsedParams[$explodeParam[0]] = $explodeParam[1];
    }

    return $parsedParams;
  }
}