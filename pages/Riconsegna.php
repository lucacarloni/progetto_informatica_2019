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
        
                checkMeccPermissions();
        
                createNavBar();
            ?>
        </div>
        
        <div class="bgwhite" style="height: 400px; padding:5%; width: 80%; margin: 0px auto ">
            
        <?php
            if(trim($_GET["targa"]) == "") {
                die("Errore! La targa non e' stata inserita!");
            }
            else {
                $targa = trim($_GET["targa"]); 
            }


            $myconn = connect();
            if($myconn->connect_error){
                die("errore connessione db");
            }

            $query = "SELECT id_veicolo
            FROM veicolo
            WHERE targa= '".$targa."'";
            
            $ris = $myconn->query($query);
            
            if($ris -> num_rows != 0) {
                $row = $ris->fetch_assoc();

                $query = "UPDATE operazione
                SET data_riconsegna_effettiva = NOW()
                WHERE fk_id_veicolo = '".$row["id_veicolo"]."'";
                
                $ris = $myconn -> query($query);

                if(!$ris) {
                    echo "Impossibile eseguire l'operazione";
                }
                else {
                    echo "Operazione avvenuta con successo";
                }

            }

            
        ?>
    
        </div>


	</body>
</html>
