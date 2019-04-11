<?php 

class Dispatcher 
{
  public $request;

  /**
   * Функция создаёт объект контроллер
   * и вызывает соответствующий action,
   * исходя из строки запроса
   *
   * @return void
   */
  public function dispatch()
  {    
    $this->request = new Request();
    $controllerInfo = Router::parse($this->request->url);

    $this->request
    ->setInfo(
      $controllerInfo['controller'],
      $controllerInfo['action'],
      $controllerInfo['get']
    );
    
    $controller = $this->loadController($this->request->controller);

    call_user_func_array([$controller, $this->request->action], ['get' => $this->request->get]);  
  }

  /**
   * Функция подключает файл с контроллером
   *
   * @return Controller
   */
  private function loadController($name)
  {
    if (!$this->isIncludeController($name)) {
      return null;
    }

    // nameController
    $class = $this->getControllerClass($name);

    return new $class();
  }

  /**
   * Функция подключает файл с контроллером
   *
   * @param string $name - имя контроллера
   *
   * @return boolean
   */
  private function isIncludeController($name)
  {
    // nameController
    $class = $this->getControllerClass($name);
    
    $file = ROOT . 'Controllers/' . $class . '.php';

    if (!file_exists($file)) {
      return false;
    }

    // Подключаем файл с контроллером
    require $file;

    return true;
  }

  private function getControllerClass($name)
  {
    return ucfirst($name . 'Controller');
  }

}