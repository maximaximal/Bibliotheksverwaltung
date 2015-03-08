<?php

require './bootstrap.php';

$page = "";

if(isset($_GET["page"])) {
    $page = $_GET["page"];
}

$nav = new App\Navigation();

if($page === "") {
    $page = "index";
}

$args = array(
    "current_page" => $page,
);

$template = $twig->loadTemplate("$page.html.twig");
echo $template->render($args);

?>