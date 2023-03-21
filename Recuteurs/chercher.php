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
                            ?>

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

<body onload="slider()">
    <div class="navbar navbar-expand-md bg-light navbar-light">
        <div class="container">
            <div class="col">
            <a class="navbar-brand fw-bold" href="../Accueil/index.html " >
                <img id="logo" src="logo.png">
            </a>  </div>
            <div class="col ">
                <div class="row ">
                    <ul class="navbar-nav justify-content-end ">
                 <li class="nav-item ">
                   <a class="nav-link text-primary cn fw-bold" href="Profil.php"> Mon Profil </a>
                </li>
                <li class="nav-item ">
                   <a class="nav-link text-primary cn fw-bold " href="../Accueil/index.html">Se déconnecter</a>
                </li>
                    </ul>
                </div>
                <div class="row">
            <ul class="navbar-nav justify-content-end ">
               <li class="nav-item">
                    <a class="nav-link fst-italic" href="acc.html   "> Accueil Recruteur </a>
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
    <div class="container mt-3 ">
        <div class="row p-2 head ">
            <div class="col-12">

                <h2 class="text-center"> Chercher Des CV </h2>
            </div>
        </div>
    </div>

        <div  class="container mt-3 slider">
          
            <div class="slide">
                <img src="images/im3.jpg" id="slideImg" alt="img">
            </div>
            
        <div class="overplay">
            <form method="post">
        <div class="row d-flex justify-content-around p-5">
            <div class="col-lg-3 ">
                <select class="form-select f1" name="domaine" aria-label="Domaine entreprise">
                    <option selected>--Domaine--</option>
                    <option value="info">Informatique</option>
                    <option value="com">Commerce</option>
                    <option value="meca">Mécanique</option>
                    <option value="elec">Electrique</option>
                    <option value="cui">Cuisine</option>
                    <option value="med">Medecine</option>
                    <option value="med">Medecine</option>
                </select>
             </div>

            <div class="col-lg-3 ">
                <select  class="form-select f1" name="ville_cand" aria-label="Ville">
                    <option selected>--Ville--</option>
                    <option value="Casablanca">Casablanca</option>
                    <option value="Rabat">Rabat</option>
                    <option value="Tanger">Tanger</option>
                    <option value="Fes">Fes</option>
                    <option value="Meknes">Meknes</option>
                    <option value="Essaouira">Essaouira</option>
                    <option value="Mohammedia">Mohammedia</option>
                    <option value="aga">Agadir</option>
                    <option value="kech">Marrakech</option>
                    <option value="houss">El Housseima</option>
                </select>
            </div>
            <div class="col-lg-3 ">
                <select class="form-select f1" name="niveau" aria-label="Niveau">
                    <option selected>--Niveau--</option>
                    <option value="7">Bac+7</option>
                    <option value="5">Bac+5</option>
                    <option value="3">Bac+3</option>
                    <option value="2">Bac+2</option>
                    <option value="1">Bac</option>
                    <option value="0">Niveau Bac</option>
                </select>
            </div>
            
            <div class="col-lg-1 bbt ">
                <button class="btn btn-primary " name="subb" type="submit">Submit</button>
            </div>

        </div>
    </form>
                        
            
            </div>
            </div>
        <section>
            <div class="container mt-3 p-4 bg-light ">
                <div class="row m-1">
                    
                            <?php

                            if(isset($_POST["subb"])){

                            $domaine=$_POST["domaine"];
                            $ville_cand= $_POST["ville_cand"];
                            $niveau=$_POST["niveau"];

                            $cand = "SELECT  * FROM candidat where ville_cand='$ville_cand' AND domaine='$domaine' AND niveau='$niveau' ";
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
                                        
                                    $comp = "SELECT DISTINCT competence.* FROM candidat,competence where ville_cand='$ville_cand' AND domaine='$domaine' AND niveau='$niveau' AND candidat.id_candidat=competence.id_candidat AND competence.id_candidat='$id_candidat'";
                                    $stmt = $conn->query($comp);
                                    
    
                                    if ($stmt->rowCount() > 0) {
                                        echo "<br><br><h6 style=\"text-decoration:underline;\">Compétences :</h6>";
                                        while ($rowC = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<span>" . htmlspecialchars($rowC["nom_comp"]) . ", </span>";
                                            }
                                        }
                                    $exp = "SELECT DISTINCT experience.* FROM candidat,experience where ville_cand='$ville_cand' AND domaine='$domaine' AND niveau='$niveau' AND candidat.id_candidat=experience.id_candidat AND experience.id_candidat='$id_candidat'";
                                    $stmt = $conn->query($exp);

                                    if ($stmt->rowCount() > 0) {
                                        echo "<br><br><h6 style=\"text-decoration:underline;\">Experiences :</h6>";
                                        while ($rowE = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<span>" . htmlspecialchars($rowE["nom_exp"]) . " à ". htmlspecialchars($rowE["nom_entreprise"]) ."</span>";
                                            echo "<span style=\";\"> De " . htmlspecialchars($rowE["debut_exp"]). " à ".htmlspecialchars($rowE["fin_exp"]). "</span><br>";
                                            }
                                        }
                                        
                                    $dip = "SELECT DISTINCT diplome.* FROM candidat,diplome where ville_cand='$ville_cand' AND domaine='$domaine' AND niveau='$niveau' AND candidat.id_candidat=diplome.id_candidat AND diplome.id_candidat='$id_candidat'";
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
                                  else {
                                            echo "Aucun résultat trouvé.";
                                        }
                            }
                            ?>
                </div>
            </div>
            
        </section>
        <script>
            var slideImg = document.getElementById("slideImg");
            var images = new Array(
                
                "images/im1.jpg",
                "images/im5.jpg",
                "images/im6.jpg",
                "images/im9.jpg"
            );
            var len= images.length;
            var i = 0;
            function slider(){
                if( i > len-1 ){
                    i=0;
                }
                slideImg.src=images[i];
                i++;
                setTimeout('slider()',3000);
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
</body>

</html>