<?php 

class Controller 
{
  public $layout = 'main';


  /**
   * Отображает вид по указаному имени файла
   *
   * @param string $fileName - имя файла в видом
   * @return html
   */
  protected function render($fileName)
  {
    $pathToView = 'Views/' 
                  . ucfirst(str_replace('Controller', '', get_class($this))) // Папка с видами контроллера
                  . '/' 
                  . $fileName 
                  . '.php';

    ob_start();
    require ROOT . $pathToView;
    $content = ob_get_clean();

    if (!$this->layout) {
      echo $content;    
    } else {
      require ROOT . 'Views/Layouts/' . $this->layout . '.php';
    }
  }

}

?>