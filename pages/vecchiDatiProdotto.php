<?php
  //Pagina che restituisce i dati attuali del prodotto
  include ("utils.php");
  $myconn = connect();

  $nome=$_GET["nome"];
  $numero=$_GET["controllo"];

  switch($numero)
  {
    case 0: $attributo="nome_prod";
            break;
    case 1: $attributo="costo_unitario";
            break;
    case 2: $attributo="aliquota_iva";
            break;
    case 3: $attributo="categoria";
            break;
  }
  $array=explode("-",$nome);//explode è una funzione che divide una stringa in un array utilizzando una variabile separatrice.
  $sql="SELECT ".$attributo."
        FROM prodotto
        WHERE id_prodotto='".$array[0]."'";
  $ris = $myconn->query($sql);
  $result=$ris->fetch_assoc();

  echo $result[$attributo];
 ?>
