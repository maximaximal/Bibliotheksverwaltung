<?php

require './bootstrap.php';

if(!isset($_GET["q"])) {
    echo "No search term q set!";
    exit();
}

$q = $_GET["q"];

$books = ORM::for_table("books")
    ->where_like("title", "%$q%")
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
        "year" => $book->year
    );

    \array_push($results["items"], $item);
}

echo \json_encode($results);