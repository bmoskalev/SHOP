<?php
include_once "../controllers/Product.php";
include_once "../controllers/Basket.php";
// подгружаем и активируем авто-загрузчик Twig-а
require_once '../lib/Twig/Autoloader.php';
Twig_Autoloader::register();
db::getInstance()->Connect(Config::get('db_user'), Config::get('db_password'), Config::get('db_base'));

include "../templates/menu.php";


try {
    // указывае где хранятся шаблоны
    $loader = new Twig_Loader_Filesystem(PATH_TEMPLATES);

    // инициализируем Twig
    $twig = new Twig_Environment($loader);
    $twig->addGlobal('session', $_SESSION);

    $countGoodsOrder = array(countGoodsOrder($connect));
    $sumGoodsOrder = array(sumGoodsOrder($connect));
    $countOneGoodsOrder = array(countOneGoodsOrder($connect, $id));
    $countOneGoodsOrder = array(sumOneGoodsOrder($connect, $id));


    // подгружаем шаблон
    $template = $twig->loadTemplate('menu.tmpl');

    $items = $db->getArr("catalog", 0, 25);
    $content = "";
    foreach ($items as $item) {
        $content .= $template->render(array(
            'item' => $item
        ));
    }
    // подгружаем шаблон
    $template = $twig->loadTemplate('index.tmpl');

    // передаём в шаблон переменные и значения
    // выводим сформированное содержание


    $page = $template->render(array(
        'content' => $content,
    ));
    echo $page;

} catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
}
