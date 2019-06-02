<?php

	include("utils.php");
	//per evitare accessi indesiderati
	checkAdminPermissions();
	$myconn=connect();
	//Matricola del meccanico
	$meccanico=$_GET["meccanico"];
	//ricerca del nome e cognome 
	$query="SELECT nome_m, cognome_m
			FROM meccanico 
			WHERE matricola="."'".$meccanico."';";
	//$ris=execute($myconn,$query);
	$ris = $myconn -> query($query);
	
	$row = $ris->fetch_assoc();
	//concatenazione del messaggio (ovvero delle casella)
	$mex="<b>Nome :</b>  " . $row["nome_m"] . "<br>";
	$mex=$mex."<b>Cognome :</b> " . $row["cognome_m"];
	echo $mex;
?>
