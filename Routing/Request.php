<?php 

/**
 * Класс описывает строку запроса
 */
class Request 
{

  public $url = '';        // Путь в строке запроса  
  
  public $controller = ''; // Имя контроллера
  
  public $action = '';     // Действие для контроллера

  public $get = [];        // Массив get параметров


  public function __construct()
  {
    $this->url = $_SERVER['REQUEST_URI'];
  }

  public function setInfo($controller, $action, $get)
  {
    $this->controller = $controller;
    $this->action = $action;
    $this->get = $get;
  }

}