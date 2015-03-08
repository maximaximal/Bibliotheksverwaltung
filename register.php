<?php

require './bootstrap.php';

$username = $_POST['user'];
$password = $_POST['pass'];
$password2 = $_POST['pass2'];
$name = $_POST['name'];

$user = new App\User();
$success = false;

$args = array(
    "current_page" => "status",
    "messages" => array(
        
    ),
    "title" => "Registrierungsstatus"
);

if($password === $password2) {
    $success = $user->register($username, $name, $password);
} else {
    \array_push($args["messages"], array(
        "message" => "Das Password war nicht in beiden Feldern gleich!",
        "link" => "index.php?page=register",
        "caption" => "Zurück zur Registrierung"
    ));
}

if($success) {
    $_SESSION['user'] = $user;
    \array_push($args["messages"], array(
        "message" => "Registrierung erfolgreich!"
    ));
} else {
    $_SESSION['user'] = false;
    \array_push($args["messages"], array(
        "message" => "Registrierung fehlgeschlagen!"
    ));
}

$template = $twig->loadTemplate("status.html.twig");
echo $template->render($args);
