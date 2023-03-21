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
                           <a class="nav-link text-primary cn fw-bold " href="Profil.php">Profil</a>
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
                    <h2 style="text-align: center;">Candidat</h2>
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

                            $id_candidat=$_SESSION['cand'];

                            $cand = "SELECT  * FROM candidat where id_candidat='$id_candidat' ";
                            $lig = $conn->query($cand);

                            // Vérification du résultat
                            if ($lig->rowCount() > 0) {
                                $table=array();
                                $i=1; 
                                 while ($ligne = $lig->fetch(PDO::FETCH_ASSOC)) {

                                     $id_candidat=$ligne["id_candidat"];
                                     $id_recruteur=$_SESSION["id"];
                             

                                        $rcomp="SELECT COUNT(id_comp) as n_comp FROM competence WHERE id_candidat='$id_candidat'";
                                        $stmtcomp = $conn->query($rcomp);
                                         $rdip="SELECT COUNT(id_dip) as n_dip FROM diplome WHERE id_candidat='$id_candidat'";
                                        $stmtdip = $conn->query($rdip);
                                         $rexp="SELECT COUNT(id_exp) as n_exp FROM experience WHERE id_candidat='$id_candidat'";
                                        $stmtexp = $conn->query($rexp);
                                        $rcomp = $stmtcomp->fetch(PDO::FETCH_ASSOC);
                                        $rdip = $stmtdip->fetch(PDO::FETCH_ASSOC);
                                        $rexp = $stmtexp->fetch(PDO::FETCH_ASSOC);
                                        $sql = "SELECT * FROM score where id_recruteur='$id_recruteur'";
                                        $stmt = $conn->query($sql);
                                        $final = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $resultat = $final["sc_comp"]*$rcomp["n_comp"] + $final["sc_dip"]*$rdip["n_dip"] + $final["sc_exp"]*$rexp["n_exp"];
                                   
                                        $table[] = array($i, $id_candidat, $resultat);
                                        $i++;
                                 }
                                        function tri_par_score($a, $b) {
                                            return $b[2] - $a[2];
                                        }

                                        usort($table, "tri_par_score");

                                        

                                        foreach ($table as &$item) {
                                            $id_candidat=$item[1];
                                            $ff="SELECT * from candidat where id_candidat='$id_candidat'";
                                            $ligg = $conn->query($ff);
                                            $ligne = $ligg->fetch(PDO::FETCH_ASSOC);

                                            echo "<div style=\" margin:1em; display:flex; justify-content:space-between; padding:1em; border-radius: 10px; background-color: rgba(255,255,255,0.5);\">";
                                    echo "<div style=\"margin:1em;\"><h4>" . htmlspecialchars($ligne["nom_cand"]) . " ". htmlspecialchars($ligne["prenom_cand"]) ."</h4>";
                                    echo "<span style=\";\"> Email:  " . htmlspecialchars($ligne["email_cand"])."</span>";
                                    echo "<br><span style=\";\">Téléphone: 0" . htmlspecialchars($ligne["telephone_cand"])."</span>";
                                    echo "<br><span style=\";\">Ville: " . htmlspecialchars($ligne["ville_cand"])."</span><br>";


                                    if ($ligne["niveau"] == '0') {
                                        echo "Niveau : niveau bac";
                                    } elseif ($ligne["niveau"] == '1') {
                                        echo "Niveau : Bac";
                                    } elseif ($ligne["niveau"] == '2') {
                                        echo "Niveau : Bac +2";
                                        } elseif ($ligne["niveau"] == '3') {
                                        echo "Niveau : Bac +3";
                                        } elseif ($ligne["niveau"] == '5') {
                                        echo "Niveau : Bac +5";
                                        } elseif ($ligne["niveau"] == '7') {
                                        echo "Niveau : Bac +7";}
                                        
                                    $comp = "SELECT DISTINCT competence.* FROM candidat,competence where candidat.id_candidat=competence.id_candidat AND competence.id_candidat='$id_candidat'";
                                    $stmt = $conn->query($comp);
                                    
    
                                    if ($stmt->rowCount() > 0) {
                                        echo "<br><br><h6 style=\"text-decoration:underline;\">Compétences :</h6>";
                                        while ($rowC = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<span>" . htmlspecialchars($rowC["nom_comp"]) . ", </span>";
                                            }
                                        }
                                    $exp = "SELECT DISTINCT experience.* FROM candidat,experience where  candidat.id_candidat=experience.id_candidat AND experience.id_candidat='$id_candidat'";
                                    $stmt = $conn->query($exp);

                                    if ($stmt->rowCount() > 0) {
                                        echo "<br><br><h6 style=\"text-decoration:underline;\">Experiences :</h6>";
                                        while ($rowE = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<span>" . htmlspecialchars($rowE["nom_exp"]) . " à ". htmlspecialchars($rowE["nom_entreprise"]) ."</span>";
                                            echo "<span style=\";\"> De " . htmlspecialchars($rowE["debut_exp"]). " à ".htmlspecialchars($rowE["fin_exp"]). "</span><br>";
                                            }
                                        }
                                        
                                    $dip = "SELECT DISTINCT diplome.* FROM candidat,diplome where  candidat.id_candidat=diplome.id_candidat AND diplome.id_candidat='$id_candidat'";
                                    $stmt = $conn->query($dip);

                                    if ($stmt->rowCount() > 0) {
                                        echo "<br><br><h6 style=\"text-decoration:underline;\">Diplome :</h6>";
                                        while ($rowD = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<span>" . htmlspecialchars($rowD["nom_dip"]) . " - ". htmlspecialchars($rowD["nom_institut"]) ."</span>";
                                            echo "<br><span style=\"\"> De " . htmlspecialchars($rowD["debut_dip"]). " à ".htmlspecialchars($rowD["fin_dip"]). "</span><br>";
                                            }
                                        }
                                        echo "</div>";

                                        echo "<div style=\"margin:1em;\"><h5> Score du candidat </h5>";
                                        echo "<p style=\" border : 2px dashed black;text-align:center; border-radius:50%;font-size:2em; height:50px;\" >". $item[2] ."</p>";
                                        echo "</div>";
                                        echo "</div>";
                                            
                                    }
                                    
                                        } 
                           
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