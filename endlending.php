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

if(!isset($_POST["json"])) {
    echo "Not all variables were set!";
    exit();
}

$lendingID = -1;
$ids = array();

if(isset($_GET["id"])) {
    $lendingID = $_GET["id"];
} else {
    echo "No lending ID was provided!";
    exit();
}

$ids = $_POST["json"];
$ids = (array) json_decode($ids);

$timestamp = strtotime(time());

$lending = ORM::for_table("lendings")->find_one($lendingID);
$lending->active = false;
$lending->save();

$books = null;
$bookIDs = array();

if(count($ids) > 1) {
    foreach($ids as $id => $cond) {
        $ids[intval($id)] = $cond;
        array_push($bookIDs, intval($id));
    }

    $books = ORM::for_table("books")
        ->where_id_in($bookIDs)
        ->find_result_set();

    if($books) {
        $books->set("lending", -1);

        foreach($books as $book) {
            $book->condition = $ids[$book->id()];
        }
        $books->save();
    }
} else {
    $bookID = reset($ids);

    $book = ORM::for_table("books")->find_one($bookID);
    $book->condition = $ids[$bookID];
    $book->lending = -1;
    $book->save();
}

echo "true";
