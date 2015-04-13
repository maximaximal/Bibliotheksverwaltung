<?php

require './bootstrap.php';

//header('Content-Type: application/json');

if(!isset($_GET["id"])) {
    echo "No id set!";
    exit();
}

$id = $_GET["id"];

$lending = ORM::for_table("lendings")
    ->where_equal("lendings.id", $id)
    ->join("books", array('lendings.id', '=', 'books.lending'))
    ->find_many();

$results = array();

if($lending) {
    $results = array(
        "lender" => $lending[0]->lender,
        "class" => $lending[0]["class"],
        "issuedBy" => $lending[0]["issuedBy"],
        "bringback" => $lending[0]["bringback"],
        "created" => $lending[0]["created"],
        "books" => array(
        
        )
    );
    
    $item = array();
    foreach($lending as $book)
    {
        $item = array(
            "title" => $book->title,
            "id" => $book->id,
            "author" => $book->author,
            "features" => $book->features,
            "condition" => $book->condition,
            "year" => $book->year,
            "publisher" => $book->publisher,
            "internalID" => $book->internalID,
            "place" => $book->place,
            "lang" => $book->lang
        );
        array_push($results["books"], $item);
    }
}

echo \json_encode($results);
