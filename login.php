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
} else {
    $_SESSION['user'] = false;
    \array_push($args["messages"], array(
        "message" => "Login fehlgeschlagen!"
    ));
}

$template = $twig->loadTemplate("status.html.twig");
echo $template->render($args);