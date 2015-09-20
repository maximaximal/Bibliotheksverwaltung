<?php namespace App;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Navigation
 *
 * @author maximaximal
 */
class Navigation {
    private $items = array(
        array(
            "page" => "index",
            "caption" => "Hauptseite"
        ),
        array(
            "page" => "login",
            "caption" => "Anmelden",
            "user" => false
        ),
        array(
            "href" => "logout.php",
            "caption" => "Abmelden",
            "user" => true
        ),
        array(
            "page" => "register",
            "caption" => "Registrieren",
            "user" => false
        ),
        array(
            "page" => "manageBooks",
            "caption" => "Bücher verwalten",
            "requiredPerms" => array("manage_books")
        ),
        array(
            "page" => "viewLendings",
            "caption" => "Ausleihungen einsehen",
            "requiredPerms" => array("view_lendings")
        ),
        array(
            "page" => "viewBook",
            "caption" => "Buch einsehen",
            "requiredPerms" => array("view_book")
        ),
        array(
            "page" => "addLending",
            "caption" => "Bücher ausleihen",
            "requiredPerms" => array("add_lending")
        ),
        array(
            "page" => "endLending",
            "caption" => "Bücher zurückgeben",
            "requiredPerms" => array("end_lending")
        )
    );
    
    public function getTwigArray()
    {
        $twigArray = array();

        foreach($this->items as $item)
        {
            $entry = array(
                "caption" => $item["caption"]
            );

            if(isset($item["page"])) {
                $entry["page"] = $item["page"];
                $entry["href"] = "index.php?page=".$item["page"];
            } else if(isset($item["href"])) {
                $entry["page"] = "";
                $entry["href"] = $item["href"];
            }

            $add = false;
            
            if(isset($item['requiredPerms'])) {
                if(is_object($_SESSION['user'])) {
                    $user = $_SESSION['user'];
                    $add = true;

                    foreach($item['requiredPerms'] as $perm) 
                    {
                        if(!$user->hasPermission($perm)) {
                            $add = false;
                        }
                    }
                }
            } else {
                $add = true;
            }

            if(isset($item["user"])) {
                if($_SESSION["user"]) {
                    if($item["user"]) {
                        $add = true;
                    } else {
                        $add = false;
                    }
                } else {
                    if($item["user"]) {
                        $add = false;
                    } else {
                        $add = true;
                    }
                }
            }

            if($add) {
                \array_push($twigArray, $entry);
            }
        }

        return $twigArray;
    }
}
