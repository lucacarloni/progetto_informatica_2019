<?php
	//Pagina che restituisce i dati attuali del meccanico
	include ("utils.php");
	$myconn = connect();
	
	//prende i dati passati dall'ajax con il get 
	$id=$_GET["id"];
	$numero=$_GET["controllo"];

	//switch per decidere quale attributo prendere con il valore passato dall'ajax di modificaDatiCliente
	switch($numero)
	{

		case 1: $attributo="nome";
            break;
		case 2: $attributo="cognome";
            break;
		case 3: $attributo="via";
            break;
		case 4: $attributo="civico";
            break;
		case 5: $attributo="cap";
            break;			
	}
	//prendo l'attributo selezionato dal form e lo cerco nel db
	$sql="SELECT ".$attributo."
        FROM cliente
        WHERE id_cliente='".$id."'";
	//eseguo query e invio il risultato sotto forma di array associativo
	$ris = $myconn->query($sql);
	$result=$ris->fetch_assoc();
	//invio il risultato all'ajax. Lo troverò nel respondeText
	echo $result[$attributo];
 ?>
