<?php

require './bootstrap.php';

$username = $_POST['user'];
$password = $_POST['pass'];

$user = new App\User();
$success = $user->login($username, $password);

$args = array(
    "current_page" => "status",
    "messages" => array(
        
    ),
    "title" => "Loginstatus"
);

if($success) {
    $_SESSION['user'] = $user;
    \array_push($args["messages"], array(
        "message" => "Login erfolgreich!"
    ));
    \array_push($args["messages"], array(
        "message" => "Sie können nun auf die für Sie freigeschalteten Funktionen über die obere Leiste zugreifen."
    ));
} else {
    $_SESSION['user'] = false;
    \array_push($args["messages"], array(
        "message" => "Login fehlgeschlagen!"
    ));
}

$twig->addGlobal("user", $_SESSION['user']);

$nav = new App\Navigation();
$twig->addGlobal("navigation", $nav->getTwigArray());

$template = $twig->loadTemplate("status.html.twig");
echo $template->render($args);