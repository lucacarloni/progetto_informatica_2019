<!DOCTYPE>
<html>
    <head>
        <title>Licenzia Meccanico</title>
        <link rel="stylesheet" href="../css/style.css"  >
    </head>

    <body>
        <h1 class="center bgblack header_page">Licenzia Meccanico</h1>
        
        <div class = 'navbar bgblack maxwidth' id='menu'>
            <?php
                include("utils.php");
                session_start();
                checkAdminPermissions();
                createNavBar();
            ?>
        </div>

        <div class="box bgwhite center">
            <?php
            //Collegamento al db
            $myconn = connect();
            ?>
            <form action="" method="POST">

                    <table>
                        <th colspan="2">
                        <h2 style="color: black">Licenzia Meccanico</h2>
                        </th>
                        <tr>				
                            <td>
                                <select name="meccanico"><?php
                                    //Creazione select della matricola
                                    $query = "SELECT matricola FROM meccanico;";
                                    $ris = execute($myconn, $query);
                                    while ($row = $ris->fetch_assoc()) {
                                        echo "<option>" . $row["matricola"] . "</option>";
                                    }
                                    ?>
				    </select></td><td><input type="submit" name="licenzia" value="licenzia"></td>
                        </tr>

                    </table>
                    <?php
                    if (isset($_POST["licenzia"])) {

                            $meccanico = $_POST["meccanico"];
                            $query = "DELETE FROM meccanico
												WHERE meccanico.matricola=" . "'" . $meccanico . "';";
                            //modificato da Claudio
                            //dato che l'execute restituisce sempre -1 con il delete, la query è stata eseguita con la sintassi classica ad ogetti
                            $rSet = $myconn->query($query);
                            header("Refresh:5");
                        	echo "<p id=\"stampa\"> Meccanico eliminato con successo </p>";
                    }
                    ?>

            </form>
    </div>
</body>
</html>
