<!--
  Pagina richiamata da modificaVeicolo.php, salvera nel DB i dati ricevuti da essa e restituirà un messaggio di buon esito o fallimento dell'operazione
-->
<?php
  include("utils.php");
  $myconn = connect();
  $veicolo=$_GET["id"];//id è il numero che si trova in alto a sinistra del form che si trova nella pagina modificaVeicolo.php
  $id=explode(" ",$veicolo);//explode è una funzione che divide una stringa in un array utilizzando una variabile separatrice.

  $targa=$_GET["targa"];
  $nome=$_GET["nome"];
  $tipo=$_GET["tipo"];
  $cavalli=$_GET["cavalli"];
  $cilindrata=$_GET["cilindrata"];
  $prop=$_GET["proprietario"];

  $array=explode("-",$prop);

  $sql="UPDATE veicolo
      SET nomeV = '".$nome.
      "', targa = '".$targa.
      "', tipo = '".$tipo.
      "', cavalli = '".$cavalli.
      "', cilindrata = '".$cilindrata.
      "', fk_id_cliente = '".$array[0].
      "' WHERE id_veicolo='".$id[1]."'"; //Utilizzo il secondo elemento perchè è lì che si trova l'id, il primo elemento è "ID:"
  $ris = $myconn->query($sql);
  if(!$ris){// controlla se la query è stata eseguita con successo
    echo "<p>Errore nella modifica!</p>";
  }else{
    echo "<p>Modifica riuscita!</p>";
  }
?>
