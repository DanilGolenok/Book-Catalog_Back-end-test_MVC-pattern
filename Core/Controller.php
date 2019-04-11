<?php 

class Controller 
{
  public $layout = 'main';


  /**
   * Отображает вид по указаному имени файла
   *
   * @param string $fileName - имя файла-вида
   * @param array $externalFiles - массив внешних css и js файлов для данного вида
   * @param array $data
   * @return void
   */
  protected function render($fileName, $externalFiles = null, $data = null)
  {
    $pathToView = 'Views/' 
                  . ucfirst(str_replace('Controller', '', get_class($this))) // Папка с видами контроллера
                  . '/' 
                  . $fileName 
                  . '.php';

    // Включение буферизации вывода
    ob_start(); 
    // Подключаем вид
    require ROOT . $pathToView;
    // Получить из буфера контент содержимого выше подключенного файла
    $content = ob_get_clean(); 

    if (!$this->layout) {
      echo $content;    
    } else {
      require ROOT . 'Views/Layouts/' . $this->layout . '.php';
    }
  }

  public static function registerJsFiles($js)
  {
    if (empty($js)) {
      return "";
    }

    $jsFiles = '';

    foreach ($js as $script) {
      $jsFiles .= "<script src=\"$script\"></script>\n";
    }

    return $jsFiles;
  }

  public static function registerCssFiles($css)
  {
    if (empty($css)) {
      return "";
    }

    $cssFiles = '';

    foreach ($css as $style) {

      $cssFiles .= "<link rel=\"stylesheet\" href=\"$style\">\n";
    }

    return $cssFiles;
  }

}

?>