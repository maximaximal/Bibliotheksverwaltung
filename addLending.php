<?php

require './bootstrap.php';

function checkSet($post) 
{
    return isset($_POST[$post]);
}

if(!checkSet("lender")
    || !checkSet("class")) {
    echo "Not all variables were set!";
    exit();
}

$lender = $_POST['lender'];
$class = $_POST['class'];
$ids = $_POST['ids'];

if(!is_string($lender)) {
    echo "lender has to be a string!";
    exit();
}
if(!is_string($class)) {
    echo "class has to be a string!";
    exit();
}
if(!is_string($ids)) {
    echo "ids has to be a string!";
    exit();
}

$lending = ORM::for_table("lendings")
    ->create(array(
        "lender" => $lender,
        "class" => $class,
        "issuedBy" => $_SESSION['user']->getID(),
        "books" => $ids
    ));

$lending->save();

header("Location: index.php?page=addLending&data=success");