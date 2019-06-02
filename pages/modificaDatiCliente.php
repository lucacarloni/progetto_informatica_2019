<html>
    <head>
        <meta charset="UTF-8">
        <title>Modifica dati Cliente</title>
        <link rel="stylesheet" href="../css/style.css"  >
    </head>
    <body onload="cambiaNome();cambiaCognome();prendiVia();prendiCivico();prendiCap()">
        <h1 class="center bgblack header_page"> Modifica dati Cliente </h1>

        <div class = 'navbar bgblack maxwidth' id='menu'>
            <?php
				/*
				
				- includo il file che contiene connessioni al db
				- avvio la sessione
				- creo navbar dinamica dal file utils
				- controllo i privilegi dell'admin
				
				*/
                include ("utils.php");
                session_start();
                createNavBar();
                checkAdminPermissions();
				//connetto al db
				$myconn = connect();
            ?>
        </div>

        <script>

		
		/*
		
			I DATI CHE VERRANNO PRESI SONO:
			- nome
			- cognome
			- via
			- civico 
			- cap
			
			SI DA PER SOCNTATO CHE L'UTENTE ABBIA ACCONSENTITO AL TRATTAMENTO DI QUESTI DATI
			
			PER PRENDERE INFORMAZIONI SULL'INDIRIZZO SI UTILIZZANO DELGI SPAN INVISIBILI CHE SALVANO I VALORI PRESI DALL'AJAX PER POI COPIARLI NELLA COLONNA DI DX
		
		
		
		*/

            function cambiaNome() {
			//Funzione che mostra il nome attuale del cliente. Richiama "vecchiDatiCliente.php"
			//prendo il valore selezionato dalla select e lo splitto per prendere solamente l'id
			//tutto ciò per non far viaggiare il cod_fisc in rete
              var nome = document.getElementById("selezionato").value;
			  var res=nome.split("-");
			  var id=res[0];
              if(nome!="")
              {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                      document.getElementById("nome_v").innerHTML = this.responseText;
                    }
                }
                xhttp.open("GET", "vecchiDatiCliente.php?id=" + id + "&controllo="+1, true);
                xhttp.send();
              }
              else
              {
                document.getElementById("nome").value = "";
                document.getElementById("nome_v").innerHTML = "";
              }
            }
            function cambiaCognome() {
			//Funzione che mostra il nome attuale del cliente. Richiama "vecchiDatiCliente.php"
			//prendo il valore selezionato dalla select e lo splitto per prendere solamente l'id
			//tutto ciò per non far viaggiare il cod_fisc in rete
              var nome = document.getElementById("selezionato").value;
			  var res=nome.split("-");
			  var id=res[0];
              if(nome!="")
              {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                      document.getElementById("cognome_v").innerHTML = this.responseText;
                    }
                }
                xhttp.open("GET", "vecchiDatiCliente.php?id=" + id + "&controllo="+2, true);
                xhttp.send();
              }
              else
              {
                document.getElementById("cognome").value = "";
                document.getElementById("cognome_v").innerHTML = "";
              }
            }
			function prendiVia() {
			//Funzione che mostra la via attuale del cliente. Richiama "vecchiDatiCliente.php"
			//prendo il valore selezionato dalla select e lo splitto per prendere solamente l'id
			//tutto ciò per non far viaggiare il cod_fisc in rete
              var nome = document.getElementById("selezionato").value;
			  var res=nome.split("-");
			  var id=res[0];
              if(nome!="")
              {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
						//prendo la responseText e la metto nello span
						document.getElementById("via_span").innerHTML = this.responseText;              
					}
                }
                xhttp.open("GET", "vecchiDatiCliente.php?id=" + id + "&controllo="+3, true);
                xhttp.send();
              }
              else
              {
                document.getElementById("cognome").value = "";
                document.getElementById("cognome_v").innerHTML = "";
              }
            }
			function prendiCap() {
			//Funzione che mostra la via attuale del cliente. Richiama "vecchiDatiCliente.php"
			//prendo il valore selezionato dalla select e lo splitto per prendere solamente l'id
			//tutto ciò per non far viaggiare il cod_fisc in rete
              var nome = document.getElementById("selezionato").value;
			  var res=nome.split("-");
			  var id=res[0];
              if(nome!="")
              {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
						//prendo la responseText e la metto nello span
                      document.getElementById("cap_span").innerHTML = this.responseText;
                    }
                }
                xhttp.open("GET", "vecchiDatiCliente.php?id=" + id + "&controllo="+5, true);
                xhttp.send();
              }
              else
              {
                document.getElementById("cognome").value = "";
                document.getElementById("cognome_v").innerHTML = "";
              }
            }
			function prendiCivico() {
			//Funzione che mostra la via attuale del cliente. Richiama "vecchiDatiCliente.php"
			//prendo il valore selezionato dalla select e lo splitto per prendere solamente l'id
			//tutto ciò per non far viaggiare il cod_fisc in rete
              var nome = document.getElementById("selezionato").value;
			  var res=nome.split("-");
			  var id=res[0];
              if(nome!="")
              {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
						//prendo la responseText e la metto nello span
						document.getElementById("civ_span").innerHTML = this.responseText;
                    }
                }
                xhttp.open("GET", "vecchiDatiCliente.php?id=" + id + "&controllo="+4, true);
                xhttp.send();
              }
              else
              {
                document.getElementById("cognome").value = "";
                document.getElementById("cognome_v").innerHTML = "";
              }
            }			

            function copia()
            {
				//Funzione che copia i vecchi dati nei campi di testo così da non riscrivere tutti i dati per cambiarne uno solo
              document.getElementById("nome").value = document.getElementById("nome_v").innerHTML;
              document.getElementById("cognome").value = document.getElementById("cognome_v").innerHTML;
			  //prendo dati dallo span e li inserisco nell'input text
			  document.getElementById("via").value=document.getElementById("via_span").innerHTML;
			  document.getElementById("civico").value=document.getElementById("civ_span").innerHTML;
			  document.getElementById("cap").value=document.getElementById("cap_span").innerHTML;



            }
        </script>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//controllo se viene premuto il pulsante
            if (isset($_POST["btn"])){

			  
				/*
					PRENDO DATI DAL FORM
				*/
			  
				//dalla combobox prendo la copia id-cod_fisc e faccio l'explode per trasformarla in array
				$array=explode("-",$_POST["selezionato"]);
				//prendo il primo elemento dell'explode per ottenere il cod_fisc
				$cod_fisc=$array[1];
				$nome = $_POST["nome"];
				$cognome = $_POST["cognome"];
				$via=$_POST["via"];
				$civ=$_POST["civico"];
				$cap=$_POST["cap"];
				$mail=$_POST["mail"];
				$password=$_POST["password"];
				$passwordCirp = md5($password);
				$tel=$_POST["telefono"];


				//controllo a tappeto sugli input
				if($mail!="" && !filter_var($mail, FILTER_VALIDATE_EMAIL)){
					echo "<script> alert('Formato mail non corretto');  </script>";
				}	
				else{
					if($via!="" && strlen($via) < 1){
						echo "<script> alert('La via inserita è troppo breve');  </script>";
					}
					else{
						if($civ!="" && strlen($civ) < 0){
							echo "<script> alert('civico inserito non è accettato');  </script>";					  
						}
						else{
							if($cap!="" && strlen($cap) < 5){
								echo "<script> alert('cap troppo breve');  </script>";					  						
							}
							else{
								if($password !="" && strlen($password) < 8){
									echo "<script> alert('password troppo breve. Inserisci password con 8 o più caratteri');  </script>";					  						
								}
								else{
									/*
										PRODUZIONE QUERY
									*/
									
									
									/*	
										Essendo che i primi campi (nome,cognome,via,civibo,cap) sono presi dal db e inseriti negli input text, non controllerò che siano vuoti.
										Questo perchè sugli input text relativi ai dati citati prima viene implementato il required lato client, perciò non potranno mai essere vuoti.
									
									*/
									
									//preformatto la query
									$sql="UPDATE cliente SET nome = '".$nome."',"."cognome = '".$cognome."',"."via = '".$via."',"."civico = '".$civ."',"."cap = '".$cap."' ";							
									//controllo se sono presenti mail e telefono
									if($mail !=""){
										$sql="UPDATE cliente SET nome = '".$nome."',"."cognome = '".$cognome."',"."via = '".$via."',"."civico = '".$civ."',"."cap = '".$cap."' ".", email ='".$mail."' ";
									}
									if($tel!=""){
										$sql=$sql.",telefono='".$tel."' ";
									}
									
									//infine inserisco la clausula rigurdante il codice fiscale
									$sql=$sql." WHERE cod_fisc = '".$cod_fisc."';";	
									//echo "<p>".$sql."</p>";
									
									
									//vedo se la password non è settata.
									//in tal caso aggiorno tutti i dati eccetto la password
									if($password!="")
									{
										//prendo dal db l'id del cliente che ha quel codice fiscale per poter fare upgrade della password
										$query="SELECT id_cliente FROM cliente WHERE cod_fisc='".$cod_fisc."';";
										$ris=$myconn -> query($query);
										if($ris -> num_rows <0){
											echo "<h1> Query errata </h1>";
										}
										else{
											//trasformo il record in array associativo
											$rSet=$ris->fetch_assoc();
											//facico l'update della password sulla tabella registrazione
											$sqlReg="UPDATE registrazione SET password='".$passwordCirp."' WHERE fk_id_cliente=".$rSet["id_cliente"].";";				
											$ris2 = $myconn->query($sqlReg);											
										}


									} 
									else
									{} 

									//eseguo la query dell'update 
									$ris3 = $myconn->query($sql);


								}
							}
						}
					}

				}
			}
        }
          ?>
        <div class="bgwhite" style="height: 400px; padding:5%; width: 40%; margin: 0px auto ">
          <form action="" method="POST">
            <?php
				//produzione della combobox dinamica
				$query = "SELECT * "
                      . "FROM cliente";
				$ris = $myconn->query($query);
                echo "<p>Seleziona il cliente: </p>";
				//quando cambia lo stato della select vado a camibare i dati nei paragrafi fissi nome_v e cognome_v
				//viene fatto richiamando le funzioni cambiaNome() e cambiaCognome()
                echo "<select id='selezionato' name='selezionato' onchange='cambiaNome();cambiaCognome(), prendiVia(), prendiCivico(), prendiCap()'>";//Creazione select per selezionare il meccanico al quale cambiare i dati
                while ($row = $ris->fetch_assoc()) {
					//carico la select con il cood fisc e l'id per poter prendere i dati con ajax senza inviare in rete il codice fiscale
					echo "<option>" . $row["id_cliente"]."-".$row["cod_fisc"]. "</option>";
				}
				echo "</select>";
            ?>
      <table style="border-collapse: collapse">
        <tr>
          <td style="width:3%">
            <table>
			
              <tr>
                <td><p>Nome: </p></td><td><p id="nome_v"></p></td>
              </tr>
              <tr> 
                <td><p>Cognome: </p></td><td><p id="cognome_v"></p></td>
              </tr>
            </table>
          </td>
        
          <td style="width:3%">
            <table style="border-collapse: collapse;width:10%">
              <tr>
                <td><input type="button" class="bgblack" value="->" onclick="copia()"></td>
              </tr>
            </table>
          </td>
          <td style="width:50%">
            <table>
              <tr>
                <td><p>Nuovo nome: </p></td><td style="width:50%"><input type="text" id="nome" name="nome" required></td>
              </tr>
              <tr>
                <td><p>Nuovo cognome: </p></td><td style="width:50%"><input type="text" id="cognome" name="cognome" required></td>
              </tr>
              <tr>
                <td><p>Nuova via: </p></td><td style="width:50%"><input type="text" id="via" name="via"  required></td>
              </tr>		
              <tr>
                <td><p>Nuovo civico: </p></td><td style="width:50%"><input type="text" id="civico" name="civico"  required></td>
              </tr>		
              <tr>
                <td><p>Nuovo cap: </p></td><td style="width:50%"><input type="text" id="cap" name="cap"  required></td>
              </tr>		
              <tr>
                <td><p>Nuovo telefono: </p></td><td style="width:50%"><input type="text" id="telefono" name="telefono"  ></td>
              </tr>			  
			  <tr>
                <td><p>Nuova mail: </p></td><td style="width:50%"><input type="text" id="mail" name="mail" ></td>
              </tr>
              <tr>
                <td><p>Nuova password: </p></td><td style="width:50%"><input type="password" id="password" name="password" ></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
            <div>
              <input type="submit" name ="btn" value="Salva">
          </div>
          <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
              if (isset($_POST["btn"]))
              {
				//controllo risultato della query di update
              if($ris3 < 0){
                echo "<script> alert('Errore nella modifica');  </script>";
              }else{
                echo "<script> alert('Modifica Riuscita');  </script>";
              }
            }
          }
          ?>
          </form>
        </div>
		<span id="cap_span" style="visibility:hidden"></span>
		<span id="via_span" style="visibility:hidden"></span>
		<span id="civ_span" style="visibility:hidden"></span>
  </body>
</html>
