<?php

require './bootstrap.php';

//header('Content-Type: application/json');

if(!isset($_GET["q"])) {
    echo "No search term q set!";
    exit();
}

$q = $_GET["q"];

$active = false;

if(isset($_GET["active"])) {
    $active = true;
}


$rawClause = "(`lender` LIKE ? OR `class` LIKE ? OR `id` LIKE ?)";

if($active) {
    $rawClause .= " AND (`active` = TRUE)";
}

$lendings = ORM::for_table("lendings")
    ->where_raw($rawClause, array("%$q%", "%$q%", "%$q%"))
    ->find_many();

$results = array(
    "items" => array(
        
    )
);

foreach($lendings as $lending) 
{
    $item = array(
        "id" => $lending->id,
        "lender" => $lending->lender,
        "class" => $lending->class,
        "bringback" => date("d.m.Y", strtotime($lending->bringback)),
        "books" => $lending->books,
        "issuedBy" => $lending->issuedBy,
        "created" => date("d.m.Y", strtotime($lending->created))
    );

    \array_push($results["items"], $item);
}

echo \json_encode($results);
