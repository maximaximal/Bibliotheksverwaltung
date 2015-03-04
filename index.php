<?php
require './bootstrap.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Test</title>
        
        <link href="css/imports.css" rel="stylesheet" type="text/css"/>
	<!--[if lte IE 7]>
	<link href="yaml/core/iehacks.css" rel="stylesheet" type="text/css" />
	<![endif]-->

	<!--[if lt IE 9]>
	<script src="lib/html5shiv/html5shiv.js"></script>
	<![endif]-->
    </head>
    <body>
        <!-- Seitenmarkup Beispiel -->
        <header>
            <div class="ym-wrapper">
                <div class="ym-wbox">
                    <h1>Bibliotheksregister</h1>
                </div>
            </div>
            <nav id="nav">
                <div class="ym-wrapper">
                    <div class="ym-hlist">
                        <ul>
                            <li class="active"><strong>Start</strong></li>
                            <li><a href="#">Anmelden</a></li>
                        </ul>
                        <form class="ym-searchform">
                            <input class="ym-searchfield" type="search" placeholder="Search..." />
                            <input class="ym-searchbutton" type="submit" value="Search" />
                        </form>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="ym-wrapper">
                <div class="ym-wbox">
                    <?php
                        
                    ?>
                </div>
            </div>
        </main>
    </body>
</html>
