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
    || !checkSet("ids")) {
    echo "Not all variables were set!";
    exit();
}

$title = $_POST["title"];
$author = $_POST["author"];
$publisher = $_POST["publisher"];
$year = $_POST["year"];
$features = $_POST["features"];
$condition = $_POST["condition"];
$ids = $_POST["ids"];

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
if(!is_string($ids)) {
    echo "ids has to be a string!";
    exit();
}

$ids = \json_decode($ids);

    $books = ORM::for_table("books")
        ->where_id_in($ids)
        ->find_result_set();

    $books->set('title', $title);
    $books->set('author', $author);
    $books->set('publisher', $publisher);
    $books->set('year', $year);
    $books->set('features', $features);
    $books->set('condition', $condition);

    $books->save();

header("Location: index.php?page=manageBooks&data=changed");
