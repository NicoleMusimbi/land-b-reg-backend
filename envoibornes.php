<?php
	header("Access-Control-Allow-Origin:*");
	if(!empty($_POST)){
		if(!empty($_POST['data'])){
			$coords = $_POST['data'];
			$coords[0]['latitude'] = (float) $coords[0]['latitude'];
			$coords[0]['longitude'] = (float) $coords[0]['longitude']+0.000008301;
			
			$coords[1]['latitude'] = (float) $coords[1]['latitude'];
			$coords[1]['longitude'] = (float) $coords[1]['longitude'];
			
			$longueur = 6378388 * acos(sin($coords[0]['latitude']) * sin($coords[1]['latitude']) + cos($coords[0]['latitude']) * cos($coords[1]['latitude']) * cos($coords[1]['longitude'] - $coords[0]['longitude']));
			
			$coords[2]['latitude'] += 0.00000297;
			$coords[2]['longitude'];
			
			$coords[3]['latitude'];
			$coords[3]['longitude'];
			
			$largeur = 6378388 * acos(sin($coords[2]['latitude']) * sin($coords[3]['latitude']) + cos($coords[2]['latitude']) * cos($coords[3]['latitude']) * cos($coords[3]['longitude'] - $coords[2]['longitude']));
			
			include "basedesdonnees.php";
			/*$borne = "LAT " . $coords[0]['latitude']. ",LNG ".$coords[0]['longitude'];
			$borne .= ";LAT " . $coords[1]['latitude']. ",LNG ".$coords[1]['longitude'];
			$borne .= ";LAT " . $coords[2]['latitude']. ",LNG ".$coords[2]['longitude'];
			$borne .= ";LAT " . $coords[3]['latitude']. ",LNG ".$coords[3]['longitude'];*/
			
			$borne = $coords[0]['latitude'].";".$coords[0]['longitude'];
			$borne .= ";".$coords[1]['latitude'].";".$coords[1]['longitude'];
			$borne .= ";".$coords[2]['latitude'].";".$coords[2]['longitude'];
			$borne .= ";".$coords[3]['latitude'].";".$coords[3]['longitude'];

			enregistrerParcelle($borne,$longueur,$largeur);
			$parcelle = obtenirDernierId($borne, $largeur);
			echo json_encode(array(array("parcelle" => base64_encode($parcelle['idBorne'] + 100))));
			
			//$dist = 6.378388 * acos(sin(lat1) * sin(lat2) + cos(lat1) * cos(lat2) * cos(lon2 - lon1));
		}
	}
