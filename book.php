<?php

require './bootstrap.php';

if(!isset($_GET["id"])) {
    echo "No id set!";
    exit();
}

$id = $_GET["id"];

$book = ORM::for_table("books")
    ->where_id_is($id)
    ->find_one();

$item = array();

if($book) {
    $item = array(
        "title" => $book->title,
        "id" => $book->id,
        "author" => $book->author,
        "features" => $book->features,
        "condition" => $book->condition,
        "year" => $book->year,
        "publisher" => $book->publisher
    );
}

echo \json_encode($item);
