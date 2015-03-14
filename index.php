<?php

require './bootstrap.php';

$page = "";
$data = "";

if(isset($_GET["page"])) {
    $page = $_GET["page"];
}

if(isset($_GET['data'])) {
    $data = $_GET['data'];
}

$nav = new App\Navigation();

if($page === "") {
    $page = "index";
}

$args = array(
    "current_page" => $page,
    "data" => $data
);

$template = $twig->loadTemplate("$page.html.twig");
echo $template->render($args);

?>