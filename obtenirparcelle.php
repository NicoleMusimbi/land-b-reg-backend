<?php
	header("Access-Control-Allow-Origin:*");
	if(!empty($_GET)){
	    if(!empty($_GET['p'])){
	        $codeParcelle = base64_decode($_GET['p']) - 100;
	        include "basedesdonnees.php";
	        $parcelle = obtenirParcelle($codeParcelle);
	        echo $parcelle['bornes'].";".$parcelle['longueur'].";".$parcelle['largeur'];
	    }
	}

//LAT 32.32,LNG 23;LAT 32.23, LNG 90.2;LAT 39, LNG 32;LAT 32.32, LNG 32;78;89