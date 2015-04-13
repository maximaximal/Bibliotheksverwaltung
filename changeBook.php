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
$lang = $_POST["lang"];
$place = $_POST["place"];
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
if(!is_string($ids)) {
    echo "ids has to be a string!";
    exit();
}
if(!is_string($lang)) {
    echo "lang has to be a string!";
    exit();
}
if(!is_string($place)) {
    echo "place has to be a string!";
    exit();
}
if(!is_string($internalID)) {
    echo "internalID has to be a string!";
    exit();
}

$ids = \json_decode($ids);

    $books = ORM::for_table("books")
        ->where_id_in($ids)
        ->find_result_set();

    if(strlen($title) > 0)
        $books->set('title', $title);
    if(strlen($author) > 0)
        $books->set('author', $author);
    if(strlen($publisher) > 0)
        $books->set('publisher', $publisher);
    if(strlen($year) > 0)
        $books->set('year', $year);
    if(strlen($features) > 0)
        $books->set('features', $features);
    if(strlen($condition) > 0)
        $books->set('condition', $condition);
    if(strlen($lang) > 0)
        $books->set('lang', $lang);
    if(strlen($place) > 0)
        $books->set('place', $place);
    if(strlen($internalID) > 0)
        $books->set('internalID', $internalID);

    $books->save();

header("Location: index.php?page=manageBooks&data=changed");
