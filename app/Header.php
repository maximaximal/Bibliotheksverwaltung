<?php

/**
 * Description of Header
 *
 * @author maximaximal
 */
class Header {
    private $name = "Bibliotheksregister";
    private $basename = "";
    
    public function __construct() 
    {
        $this->basename = basename($_SERVER['REQUEST_URI']);
    }
    public function render()
    {
        $c = "";
        
        $c .= "<header>\n";
        $c .= "    <div class='ym-wrapper'>\n";
        $c .= "         <div class='ym-wbox'>\n";
        $c .= "             <h1>$this->name</h1>\n";
        $c .= "         </div>\n";
        $c .= "    </div>\n";
        $c .= "    <nav id='nav'>\n";
        $c .= "        <div class='ym-wrapper'>\n";
        $c .= "            <div class='ym-hlist'>\n";
        $c .= "                <ul>\n";
        $c .= "                    ";
        $c .= "                </ul>\n";
    }
    private function navLink($url)
    {
        $c = "";
        if()
    }
}
