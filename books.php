<?php

require './bootstrap.php';

header('Content-Type: application/json');

if(!isset($_GET["q"])) {
    echo "No search term q set!";
    exit();
}

$q = $_GET["q"];

$books = ORM::for_table("books")
    ->where_raw("`title` LIKE ? OR `author` LIKE ? OR `year` LIKE ? OR `features` LIKE ? OR `publisher` LIKE ?", array("%$q%", "%$q%", "%$q%", "%$q%", "%$q%"))
    ->find_many();

$results = array(
    "items" => array(
        
    )
);

foreach($books as $book) 
{
    $item = array(
        "title" => $book->title,
        "id" => $book->id,
        "author" => $book->author,
        "features" => $book->features,
        "condition" => $book->condition,
        "year" => $book->year,
        "publisher" => $book->publisher
    );

    \array_push($results["items"], $item);
}

echo \json_encode($results);