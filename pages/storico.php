<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="../css/style.css"  >    
</head>
<body>
    <h1 class="center bgblack header_page"> Fattura </h1>

    <div class = 'navbar bgblack maxwidth' id='menu'>
        <?php
        include("utils.php");
       
        session_start();
        checkUserPermissions();
        createNavBar();
        ?>
    </div>

    <div class="bgwhite" style="padding:5%; padding-bottom: 10%; width: 80%; margin: 0px auto ">
        <?php

        $conn = connect();

        if ($conn->connect_error) {
            die("errore connesione");
        }

/*
            IVA:22%
            fattura. imponibile+imposta
*/


            // questa query da sola stampa
            
            // id_fattura  nome    cognome via civico  cap email   data_emissione  nome_intervento tempo_lavorazione   imponibile
            // imposta     
            $sql = 
            "SELECT f.id_fattura, c.nome, c.cognome, c.via, c.civico, c.cap, c.email, f.data_emissione, ai.nome_intervento, ai.tempo_lavorazione, f.imponibile, f.imposta " .
            "FROM fattura as f ".
            "JOIN operazione as o ON o.fk_id_veicolo=f.fk_id_operazione ".
            "JOIN intervento as i on i.id_intervento=o.id_operazione ".
            "JOIN anagrafica_intervento as ai on i.fk_id_anagrafico=ai.id_anagrafico ".
            "JOIN veicolo as v on v.id_veicolo = o.fk_id_veicolo ".
            "JOIN cliente as c on c.id_cliente=v.fk_id_cliente ".
            "WHERE id_cliente=".$_SESSION['id'].";";

            echo "<h2>Le mie fatture:</h2>";

            $rSet = $conn -> query($sql);
            
            if ($rSet->num_rows == 0) {
                echo "Non ci sono fatture presenti!";
            }
            else {
                $idFP = 0;
                /*
                La parte sottostante contiene l'intestazione dei campi. e' stata commentata
                perche' esteticamente rovinava la pagina.
                Puo' essere tranquillamente ripristinata.
                */

                /*
                echo "<table><tr><td>N.</td><td>Nome</td><td>Cognome</td><td>Via</td><td>Civico</td>
                <td>CAP</td><td>E-Mail</td><td>Data Emiss.</td><td>Imponibile</td><td>Imposta</td></tr>
                </table>";
                */

                while ($row = $rSet->fetch_assoc()) {
                    if($idFP != $row['id_fattura']) {
                        echo "</details>";
                        echo "<br>";
                    }

                    // se e' uguale al precedente si tratta della stessa fattura
                    if($row['id_fattura'] == $idFP) {
                        echo $row['nome_intervento'] . " " . $row['tempo_lavorazione'] . "<br>";
                    }
                    else {  // altrimenti stampo tutti i dati
                        echo $row['id_fattura'] . " " . $row['nome'] . " " . $row['cognome'] . " " . $row['via'] . " " .
                        $row['civico'] . " " . $row['cap'] . " " . $row['email'] . " " . $row['data_emissione'] . " " . 
                        $row['imponibile'] . "€ " . $row['imposta'] . "€<br>";

                        echo "<details><summary>DATI INTERVENTI: </summary>";
                        echo $row['nome_intervento'] . " " . $row['tempo_lavorazione'] . "<br>";
                    }
                    
                    // memorizza l'id della fattura precedente in questo modo
                    $idFP = $row['id_fattura'];

                }
            }

            // STAMPO I VEICOLI
            echo "</details>";
            echo "<br>";
            echo "<h2>I miei veicoli:</h2>";

            $sql = "SELECT * FROM veicolo WHERE fk_id_cliente =". $_SESSION['id'];
            $rSet = $conn -> query($sql);
            
            if ($rSet->num_rows == 0) {
                echo "Non ci sono veicoli presenti!";
            }
            else {
                while ($row = $rSet->fetch_assoc()) {
                    echo $row['targa'] . " " . $row['nomeV'] . " " . $row['tipo'] . " " . "<br>";                    
                }
            }

            ?>
        </div>
    </body>
</html>
