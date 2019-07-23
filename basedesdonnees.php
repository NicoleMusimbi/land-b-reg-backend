<?php
	$BDD = null;
	
	function connexionBDD(){
		global $BDD;
		if($BDD == null){
			try{
				$host = "mysql1004.mochahost.com";$db = "nfinic_landbreg";$user = "nfinic_msb_land";$pwd = "fwt02p6rev2u";
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				$BDD = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pwd,$pdo_options);
				return $BDD;
			}catch(Exception $err){die("Database access error ".$err->getMessage());}
		}else return $BDD;
	}
	
	function enregistrerParcelle($bornes,$longueur,$largeur){
		if(!empty($bornes) && !empty($longueur) && !empty($largeur)){
			$BDD = connexionBDD();
			try{
				$req = $BDD -> prepare("INSERT INTO borne(idBorne,bornes,longueur,largeur) VALUES('',?,?,?)");
				$i = $req -> execute(array($bornes,$longueur,$largeur));
				$req -> closeCursor();
				return $i; 
			}catch(Exception $err){
				die("Error ".$err -> getMessage());
			}
		}
	}
	
	function obtenirParcelle($idParcelle){
		if(!empty($idParcelle)){
			$BDD = connexionBDD();
			try{
				$req = $BDD -> prepare("SELECT * FROM borne WHERE idBorne=?");
				$i = $req -> execute(array($idParcelle));
				while($res = $req -> fetch()){
					$req -> closeCursor();
					return $res;
				}
				$req -> closeCursor();
			}catch(Exception $err){
				die("Error ".$err -> getMessage());
			}
		}
	}
	
	function obtenirDernierId($bornes,$largeur){
		if(!empty($bornes) && !empty($largeur)){
			$BDD = connexionBDD();
			try{
				$req = $BDD -> prepare("SELECT * FROM borne WHERE bornes=? AND largeur=? ORDER BY idBorne DESC");
				$i = $req -> execute(array($bornes,$largeur));
				while($res = $req -> fetch()){
					$req -> closeCursor();
					return $res;
				}
				$req -> closeCursor();
			}catch(Exception $err){
				die("Error ".$err -> getMessage());
			}
		}
	}
