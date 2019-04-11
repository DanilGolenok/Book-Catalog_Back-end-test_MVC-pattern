<?php 

define('WEB', str_replace('Web/index.php', '', $_SERVER['SCRIPT_NAME']));
define('ROOT', str_replace('Web/index.php', '', $_SERVER['SCRIPT_FILENAME']));


require ROOT . 'Config/core.php';

// Подключение системы маршрутизации
require ROOT . 'Routing/Dispatcher.php';
require ROOT . 'Routing/Request.php';
require ROOT . 'Routing/Router.php';

(new Dispatcher())->dispatch();