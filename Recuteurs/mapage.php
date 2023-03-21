<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Recruteur</title>
    <link href="style.css" rel="stylesheet" />
</head>

<body>
    <div class="navbar navbar-expand-md bg-light navbar-light">
        <div class="container">
            <div class="col">
            <a class="navbar-brand fw-bold" href="../Accueil/index.html" >
                <img id="logo" src="logo.png">
            </a>  </div>
            <div class="col ">
                <div class="row ">
                    <ul class="navbar-nav justify-content-end ">
                        <li class="nav-item ">
                           <a class="nav-link text-primary cn fw-bold " href="Profil.php">Mon Profil</a>
                        </li>
                <li class="nav-item ">
                   <a class="nav-link text-primary cn fw-bold" href="../Accueil/index.html">  Se déconnecter </a>
                </li>
                    </ul>
                </div>
                <div class="row">
            <ul class="navbar-nav justify-content-end ">
                <li class="nav-item">
                    <a class="nav-link fst-italic" href="acc.html"> Accueil Recruteur </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fst-italic" href="mapage.php"> Mes offres </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link fst-italic" href="chercher.php"> Chercher des CV </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link fst-italic" href="offre.html"> Ajouter une offre </a>
                </li>
            </ul>
            </div>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row head">
            <div class="col-12 head">
                <h2 class="text-center p-2"> Bienvenue à la page Recuteur </h2>
            </div>
        </div>
    </div>
    <div>
       
        <section class="Form my-4 mx-5">
            <div class="container">
                <div class="row no-gutters bg-light bg-opacity-75  p-3">
                    <h2 style="text-align: center;">Mes Offres</h2>
                    <div class="col-lg-12 p-2 mt-2">
                        <?php session_start();

                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "recjob";
                            try {
                                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            // echo "Connexion réussie";
                            } catch(PDOException $e) {
                                echo "Connexion échouée : " . $e->getMessage();
                            }

                            $id_recruteur= $_SESSION['id'];

                            $sql = "SELECT * FROM offre_emploi where id_recruteur='$id_recruteur'";
                            $stmt = $conn->query($sql);
                            
                            // Vérification du résultat
                            if ($stmt->rowCount() > 0) {
                                
                                
                                while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                   
                                    $_SESSION['offre']=$ligne["id_offre"];
                                    // Afficher les données dans une div
                                    echo "<div style=\" margin:1em; padding:2em; border-radius: 10px; background-color: rgba(255,255,255,0.5);\">";
                                    echo "<div style=\"  display:flex;\">";
                                    echo"<div style=\" margin-top:1em;\">";
                                    if ($ligne["type_contrat"] == 'emp') {
                                        echo "<img width=200 src=\"emploi.jpeg\">";
                                    } elseif ($ligne["type_contrat"] == 'st-pre') {
                                        echo "<img width=200 src=\"pre.png\">";
                                    }elseif ($ligne["type_contrat"] == 'st') {
                                        echo "<img width=200 src=\"stage.jpeg\">";
                                    }
                                    echo"</div>";
                                    echo "<div style=\"margin:1em; width:60%;\"><h4>" . htmlspecialchars($ligne["poste"]) . " -- ". htmlspecialchars($ligne["nom_entreprise"]) ."</h4>";
                                    echo "<span style=\"font-weight:bold; text-decoration:underline;\"> " . htmlspecialchars($ligne["localisation"])."</span>";
                                    echo "<br><br><span style=\"border:1px solid black; padding:2px;border-radius:7px; 
                                    margin-top:5px;margin-bottom:5px;\" >" . htmlspecialchars($ligne["salaire"]) . " Dhs</span>";
                                    echo "<br>" . htmlspecialchars($ligne["duree"]). " mois";
                                    echo "<br>" . htmlspecialchars($ligne["descr"]);
                                    echo"</div>";
                                    echo "<div style=\"\">";
                                    echo "<h6> Qui ont postulé</h6>";

                                    $req = "SELECT DISTINCT candidat.* FROM candidat, postulation WHERE id_recruteur='$id_recruteur' AND id_offre='" . $ligne["id_offre"] . "' AND candidat.id_candidat=postulation.id_candidat";
                                    $st = $conn->query($req);
                                    if ($st->rowCount() > 0) {
                                
                                while ($li = $st->fetch(PDO::FETCH_ASSOC)) {
                                    $_SESSION['cand']=$li["id_candidat"];
                                 echo "<p> - <a style=\"text-decoration: underline;\" onclick=\"location.href='cv.php'\" name='cv'> " . htmlspecialchars($li["nom_cand"]) . " ". htmlspecialchars($li["prenom_cand"]) ."</a></p>";

                                }}
                                    echo "</div>";
                                    echo "</div>";
                                    echo "<div>";
                                    echo "<form style='display:flex;justify-content:flex-end;' method='POST'>";
                                    echo "<div>";
                                    echo "<input type='hidden' name='dell' value='{$ligne["id_offre"]}'>";
                                    echo "<button style=\"border: none; outline: none;height: 30px;float:right;margin-top:2px ;width:100px;background-color: #E74846;color: white;border-radius: 4px;font-weight: bold;\" type='submit' name='del'>Delete</button>";
                                    echo"</div>";
                                    echo "</form>";
                                    echo "<button style=\"border: none; outline: none;height: 30px;float:right;margin-top:2px ;width:10%;background-color: #4652E7;color: white;border-radius: 4px;font-weight: bold;\" type='submit' onclick=\"location.href='Oupdate.php'\" name='upd'>Update</button>";
                                    echo"</div>";
                                    echo"</div>";
                                    
                                     if (isset($_POST["del"])) {
                                    
                                    $id = $_POST['dell'];
                                    $delete = "DELETE FROM offre_emploi WHERE id_offre='$id'";
                                    $requete = $conn->prepare($delete);
                                    $requete->bindParam(":id_offre", $id_offre);
                                    
                                    $requete->execute();
                                    }
                                    

                                }
                            } else {
                                echo "Aucun offre d'emploi à afficher.";
                            }

                            // Fermeture de la connexion
                            //$conn = null;
                            ?>


                    </div>
                </div>
            </div>
        </section>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
</body>

</html>