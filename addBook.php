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
    || !checkSet("place")
    || !checkSet("lang")
    || !checkSet("internalID")
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
$place = $_POST["place"];
$lang = $_POST["lang"];
$internalID = $_POST["internalID"];

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
if(!is_string($place)) {
    echo "place has to be a string!";
    exit();
}
if(!is_string($lang)) {
    echo "lang has to be a string!";
    exit();
}
if(!is_string($internalID)) {
    echo "internalID has to be a string!";
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
            "place" => $place,
            "lang" => $lang,
            "internalID" => $internalID
        ));

    $book->save();
}

header("Location: index.php?page=manageBooks&data=added");