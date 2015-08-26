<?php

require './bootstrap.php';

if(!isset($_SESSION['user'])) {
    echo "No user is logged in!";
    exit();
}

$user = $_SESSION['user'];

if(!$user->hasPermission("end_lending")) {
    echo "User has no permission to end lendings!";
    exit();
}

function checkSet($post) 
{
    return isset($_POST[$post]);
}

if(!checkSet("lender")
    || !checkSet("class") 
    || !checkSet("ids")
    || !checkSet("bringback")) {
    echo "Not all variables were set!";
    exit();
}

$timestamp = strtotime(time());
$idArray = json_decode($ids);
if(!count($idArray) > 0) {
    echo "You have to input more than 0 books!";
    exit();
}

$lending = ORM::for_table("lendings")
    ->create(array(
        "lender" => $lender,
        "class" => $class,
        "issuedBy" => $_SESSION['user']->getID(),
        "books" => $ids,
        "bringback" => date("Y-m-d H:i:s", $timestamp)
    ));

$lending->save();

$books = ORM::for_table("books")
    ->where_id_in(json_decode($ids))
    ->find_result_set();
    
if($books) {
    $books->set("lending", $lending->id());
    $books->save();
}
else {
    echo "Book IDs not found!";
    exit();
}

header("Location: index.php?page=addLending&data=success");
