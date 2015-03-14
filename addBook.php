<?php

require './bootstrap.php';

function checkSet($post) 
{
    return isset($_POST[$post]);
}

if(!checkSet("title")
    || !checkSet("author")
    || !checkSet("publisher")
    || !checkSet("year")
    || !checkSet("features")
    || !checkSet("condition")
    || !checkSet("count")) {
    echo "Not all variables were set!";
    exit();
}

$title = $_POST["title"];
$author = $_POST["author"];
$publisher = $_POST["publisher"];
$year = $_POST["year"];
$features = $_POST["features"];
$condition = $_POST["condition"];
$count = $_POST["count"];

if(!is_string($title)) {
    echo "Title has to be a string!";
    exit();
}
if(!is_string($author)) {
    echo "Author has to be a string!";
    exit();
}
if(!is_scalar($year)) {
    echo "Year has to be a scalar variable!";
    exit();
}
if(!is_string($features)) {
    echo "Features has to be a string!";
    exit();
}
if(!is_string($condition)) {
    echo "Features has to be a string!";
    exit();
}
if(!is_scalar($count)) {
    echo "Count has to be a scalar!";
    exit();
}

for($i = 0; $i < $count; ++$i) 
{
    $book = ORM::for_table("books")
        ->create(array(
            "title" => $title,
            "author" => $author,
            "publisher" => $publisher,
            "year" => $year,
            "features" => $features,
            "condition" => $condition,
        ));

    $book->save();
}

header("Location: index.php?page=manageBooks&data=added");