<!DOCTYPE html>
<html><!--FINITA-->
<head>
    <meta charset="UTF-8">
    <title>Operazioni meccanico</title>
    <link rel="stylesheet" href="../css/style.css"  >
</head>
<body style="background-image:url('../image/gears.png'); background-size: auto; ">

    <h1 class="center bgblack header_page">Registra Intervento</h1>

    <div class = 'navbar bgblack maxwidth' id='menu'>
        <?php
        include("utils.php");
        session_start();
        checkMeccPermissions();
        createNavBar();
        ?>
    </div>

    <?php
    $myconn = connect();
    ?>

    <div class="box bgwhite center">
        <form action="" method="POST" style="width:90%; margin-left: 0px;">

            <h2 class = "center">Elenco Targhe Veicoli</h2>
            <select id="targa" name="targa">
                <?php
//se per quella targa non ci sono operazioni, allora bisognerà mostargli un pulsante che rimanda all'inserimento operazionoe
                
                $myconn = connect();
                $query = "SELECT targa FROM veicolo ";
                $rset = execute($myconn, $query);

                if ($rset == NULL) {
                    echo "Nessun Risultato";
                } else {
                    //stampo la select

                    while ($row = $rset->fetch_assoc()) {
                        echo "<option>" . $row["targa"] . "</option>";
                    }
                }
                ?>
            </select>
            <input class="bgblack" type="submit" onclick="" value="ok" name="ok"><br>

        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isSet($_POST["ok"])) {
                $targa = $_POST["targa"];
                echo "<div id=\"targaselezionata\">" . $targa . "</div>";
        //Da linkare e verificare tutte le pagine
                $query = "SELECT data_riconsegna_effettiva
                FROM operazione AS o JOIN veicolo AS v 
                ON o.fk_id_veicolo=v.id_veicolo
                WHERE v.targa=" . "'" . $targa . "'
                GROUP BY data_riconsegna_effettiva HAVING MAX(v.id_veicolo);";
                $rset = execute($myconn, $query);
        //Se e in lavorazione
        //controllo se la query mi restituisce righe 0.
        //questo perchè se non ci sono operazioni per quella macchina la query mi restituisce righe 0
                if (!isset($rset)) {
            //non ha operazioni
                    echo " La macchina non ha ancora un operazione <br><table>
                    <tr>
                    <td><input type=\"button\" value=\"Inserisci Nuova Operazione\" onclick=\"location.href='RegistraOperazione.php?targa=" . $targa . "'\"" . "><br></td>
                    </tr>
                    </table>";
                } else {
                    $row = $rset->fetch_assoc();
                    $ris = $row["data_riconsegna_effettiva"];
                    if ($ris == NULL) {
                        echo "La macchina è in lavorazione <br>
                        <a href=\"CollegaIntervento.php?targa=" . $targa . "\">Aggiungi Intervento</a><br>";
                        
                        echo "<a href=\"RegistraProdotto.php?targa=" . $targa . "\">Aggiungi Prodotto</a><br>";
                        echo "<a href=\"modificaVeicolo.php?targa=" . $targa . "\">Modifica Veicolo</a><br>";
                        echo "<a href=\"Riconsegna.php?targa=" . $targa . "\">Riconsegna Veicolo</a><br>";
                    } else {
                        echo " <table>
                        <tr>
                        <td><input type=\"button\" value=\"Inserisci Nuova Operazione\" onclick=\"location.href='RegistraOperazione.php';\"><br></td>
                        </tr>
                        </table>";
                        echo "<>";
                    }
        } //
    }
}
?>

</div>
</body>
</html>
