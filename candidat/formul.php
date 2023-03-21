<?php

session_start();

// Connexion à la base de données MySQL avec PDO
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recjob";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connexion réussie";
} catch (PDOException $e) {
    echo "Connexion échouée : " . $e->getMessage();
}


$id_candidat = $_SESSION['candidat'];


//////////////////////////////////////////

// Récupération des données soumises par la partie experionses
if (isset($_POST["ajoutexpe"])) {
    $nom_exp = $_POST["nom_exp"];
    $debut_exp = $_POST["debut_exp"];
    $fin_exp = $_POST["fin_exp"];
    $details_exp = isset($_POST['details_exp']) ? $_POST['details_exp'] : "";
    $nom_entreprise = isset($_POST['nom_entreprise']) ? $_POST['nom_entreprise'] : "";

    // Insertion des données du formulaire dans la table experionse
    $insertion1 = "INSERT INTO experience (nom_exp, debut_exp, fin_exp, details_exp, id_candidat, nom_entreprise) VALUES (:nom_exp, :debut_exp, :fin_exp, :details_exp, :id_candidat, :nom_entreprise)";
    $requete1 = $conn->prepare($insertion1);

    $requete1->bindParam(":id_candidat", $id_candidat);
    $requete1->bindParam(":nom_exp", $nom_exp);
    $requete1->bindParam(":debut_exp", $debut_exp);
    $requete1->bindParam(":fin_exp", $fin_exp);
    $requete1->bindParam(":details_exp", $details_exp);
    $requete1->bindParam(":nom_entreprise", $nom_entreprise);

    if ($requete1->execute()) {
        // Afficher un message de confirmation
        //echo "Les données ont été insérées avec succès.";
    } else {
        // Afficher un message d'erreur
        echo "Erreur : " . $requete1->errorInfo()[2];
    }
} else {
    // Si les données ne sont pas envoyées par le formulaire, afficher un message d'erreur
    //echo "Les données n'ont pas été envoyées par le formulaire.";
}



// Récupération des données soumises par la partie diplome

if (isset($_POST["ajoutdip"])) {

    $nom_dip = isset($_POST['nom_dip']) ? $_POST['nom_dip'] : "";
    $nom_institut = isset($_POST['nom_institut']) ? $_POST['nom_institut'] : "";
    $debut_dip = isset($_POST['debut_dip']) ? $_POST['debut_dip'] : "";
    $fin_dip = isset($_POST['fin_dip']) ? $_POST['fin_dip'] : "";

    // Insertion des données du formulaire dans la table "diplome"

    $insertion2 = "INSERT INTO diplome (nom_dip, nom_institut, debut_dip, fin_dip, id_candidat) VALUES (:nom_dip, :nom_institut, :debut_dip, :fin_dip, :id_candidat)";

    $requete2 = $conn->prepare($insertion2);

    $requete2->bindParam(":nom_dip", $nom_dip);
    $requete2->bindParam(":nom_institut", $nom_institut);
    $requete2->bindParam(":debut_dip", $debut_dip);
    $requete2->bindParam(":fin_dip", $fin_dip);
    $requete2->bindParam(":id_candidat", $id_candidat);

    if ($requete2->execute()) {
        //echo "Les données ont été insérées avec succès.";

    } else {
        echo "Erreur : " . $requete2->errorInfo()[2];
    }
} else {
    //echo "Les données n'ont pas été envoyées par le formulaire.";
}













// Récupération des données soumises par la partie competence

if (isset($_POST["ajoutcomp"])) {
    $nom_comp = isset($_POST['nom_comp']) ? $_POST['nom_comp'] : "";
    $details_comp = isset($_POST['details_comp']) ? $_POST['details_comp'] : "";

    // Insertion des données du formulaire dans la table competence
    $insertion3 = "INSERT INTO competence (nom_comp, details_comp, id_candidat) VALUES (:nom_comp, :details_comp, :id_candidat)";

    $requete3 = $conn->prepare($insertion3);
    $requete3->bindParam(":nom_comp", $nom_comp);
    $requete3->bindParam(":details_comp", $details_comp);
    $requete3->bindParam(":id_candidat", $id_candidat);

    if ($requete3->execute()) {
        // echo "Les données ont été insérées avec succès.";
    } else {
        echo "Erreur : " . $requete3->errorInfo()[2];
    }
} else {
    //echo "Les données n'ont pas été envoyées par le formulaire.";
}





//ajouter le domaine et le niveau


if (isset($_POST["ajouter"])) {


    $details_exp = isset($_POST['niveau']) ? $_POST['niveau'] : "";
    $nom_entreprise = isset($_POST['domaine']) ? $_POST['domaine'] : "";

    // Mise à jour des données du formulaire dans la table candidat
    $mise_a_jour = "UPDATE candidat SET niveau=:niveau, domaine=:domaine WHERE id_candidat=:id_candidat";
    $requete = $conn->prepare($mise_a_jour);

    $requete->bindParam(":id_candidat", $id_candidat);
    $requete->bindParam(":niveau", $details_exp);
    $requete->bindParam(":domaine", $nom_entreprise);

    if ($requete->execute()) {
        // Afficher un message de confirmation
        // echo "Les données ont été mises à jour avec succès.";
    } else {
        // Afficher un message d'erreur
        echo "Erreur : " . $requete->errorInfo()[2];
    }
} else {
    // Si les données ne sont pas envoyées par le formulaire, afficher un message d'erreur
    // echo "Les données n'ont pas été envoyées par le formulaire.";
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formul</title>
    <link rel="stylesheet" href="css/style1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="navbar navbar-expand-md bg-light navbar-light">
        <div class="container">
            <div class="col">
                <a class="navbar-brand fw-bold" href="../Accueil/index.html ">
                    <img id="logo" src="images/logo.png">
                </a>
            </div>
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
                        <li class="nav-item active">
                            <a class="nav-link fst-italic " href="formul.php"> Formulaire CV </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link fst-italic " href="chercher.php"> Chercher les offres </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row head">
            <div class="col-12 head">
                <h2 class="text-center p-2"> Prenez le temps de remplir votre CV correctement ! </h2>
            </div>
        </div>
    </div>

    <section class="Form my-4 mx-5">
        <div class="container ">
            <div class="row no-gutters p-5 bg-light m-5 bg-opacity-75 d-flex justify-content-center">

                <h3 class="font-weight-bold py-3  text-center"> Expérience professionnelle</h3>
                <form method="POST">
                    <div class="row no-gutters d-flex justify-content-center">

                        <div class="col-5 form-floating mb-3">

                            <input type="texte" name="nom_exp" class="form-control" id="floatingInput" placeholder="Nom" required>
                            <label for="floatingInput">-- Nom Expérience--</label>
                        </div>

                        <div class="col-5 form-floating mb-3">

                            <input type="texte" name="nom_entreprise" class="form-control" id="floatingInput" placeholder="Nom" required>
                            <label for="floatingInput">-- Nom Entreprise--</label>
                        </div>
                       

                    </div>






                    <div class="row no-gutters d-flex justify-content-center">



                        <div class=" col-5 form-floating mb-3">
                            <input type="date" name="debut_exp" class="form-control" id="floatingInput" required>
                            <label for="floatingInput">Date debut:</label>
                        </div>


                        <div class=" col-5 form-floating mb-3">
                            <input type="date" name="fin_exp" class="form-control" id="floatingInput" required>
                            <label for="floatingInput">Date fin:</label>
                        </div>
                    </div>


                    <div class="row no-gutters d-flex justify-content-end">

                        
                        <div class="Ajou col-5 form-floating mb-3">
                            <button type="submit" name="ajoutexpe" class="btn btn-primary btn-right">Ajouter</button>
                        </div>



                    </div>


                    <div class="row no-gutters d-flex justify-content-center">
                        <div class="col-6 form-floating mb-3">

                            <div id="liste" style="text-align: center;">

                                <?php
                                // Récupération de toutes les données de la table "experience"
                                $select = "SELECT DISTINCT nom_exp, debut_exp, fin_exp, nom_entreprise FROM experience where id_candidat=$id_candidat";
                                $res = $conn->query($select);
                                $donnees = $res->fetchAll(PDO::FETCH_ASSOC);

                                // Construction d'une chaîne de caractères avec les données de la table "experience"
                                $resultat = "";
                                if (count($donnees) > 0) {
                                    foreach ($donnees as $row) {
                                        $resultat .= $row["nom_exp"] . " &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; "
                                            . $row["debut_exp"] . " &nbsp;&nbsp;-->&nbsp;&nbsp; " .
                                            $row["fin_exp"] . "&nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;&nbsp; " . $row["nom_entreprise"] . "<br>";
                                    }
                                }

                                // Retourne la chaîne de caractères avec les données de la table "experience"
                                echo $resultat;

                                //
                              

                                ?>
                            </div>



                        </div>
                    </div>
            </div>

            </form>
        </div>
        </div>

    </section>

    <section class="Form my-4 mx-5">
        <div class="container ">
            <div class="row no-gutters p-5 bg-light m-5 bg-opacity-75 d-flex justify-content-center">

                <h3 class="font-weight-bold py-3  text-center">Diplôme et Formation</h3>
                <form method="post">
                    <div class="row no-gutters d-flex justify-content-center">
                        <div class="col-5 form-floating mb-3">

                            <input type="texte" name="nom_dip" class="form-control" id="floatingInput" placeholder="Nom" required>
                            <label for="floatingInput">-- Nom Diplome--</label>
                        </div>
                        <div class="col-5 form-floating mb-3">

                            <input type="texte" name="nom_institut" class="form-control" id="floatingInput" placeholder="Nom" required>
                            <label for="floatingInput">-- Nom Institution--</label>
                        </div>

                    </div>
                    <div class="row no-gutters d-flex justify-content-center">


                        <div class=" col-5 form-floating mb-3">
                            <input type="date" name="debut_dip" class="form-control" id="floatingInput" required>
                            <label for="floatingInput">Date début:</label>
                        </div>

                        <div class=" col-5 form-floating mb-3">


                            <input type="date" name="fin_dip" class="form-control" id="floatingInput" required>
                            <label for="floatingInput">Date fin:</label>


                            <div class="Ajou">
                                <button type="submit" name="ajoutdip" class="btn btn-primary btn-right">Ajouter</button>
                            </div>
                        </div>
                    </div>

                    <div class="row no-gutters d-flex justify-content-center">
                        <div class="col-6 form-floating mb-3">

                            <div id="liste" style="text-align: center;">

                                <?php
                                // Récupération de toutes les données de la table "experience"
                                $select = "SELECT DISTINCT nom_dip, debut_dip, fin_dip, nom_institut FROM diplome where id_candidat=$id_candidat";
                                $res = $conn->query($select);
                                $donnees = $res->fetchAll(PDO::FETCH_ASSOC);

                                // Construction d'une chaîne de caractères avec les données de la table "experience"
                                $resultat = "";
                                if (count($donnees) > 0) {
                                    foreach ($donnees as $row) {
                                        $resultat .= $row["nom_dip"] . " &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; "
                                            . $row["debut_dip"] . " &nbsp;&nbsp;-->&nbsp;&nbsp; " .
                                            $row["fin_dip"] . "&nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;&nbsp; " . $row["nom_institut"] . "<br>";
                                    }
                                }

                                // Retourne la chaîne de caractères avec les données de la table "experience"
                                echo $resultat;


                               
                                ?>
                            </div>



                        </div>
                    </div>

                </form>
            </div>
        </div>
        <!--</div>-->

    </section>
    <section class="Form my-4 mx-5">
        <div class="container ">
            <div class="row no-gutters p-5 bg-light m-5 bg-opacity-75 d-flex justify-content-center">

                <h3 class="font-weight-bold py-3  text-center">Compétence</h3>
                <form method="post">
                    <div class="row no-gutters d-flex justify-content-center">
                        <div class="col-5 form-floating mb-3">
                            <input type="text" name="nom_comp" class="form-control" id="floatingInput" required>
                            <label for="floatingInput">--Compétence--</label>

                        </div>
                        <div class=" col-5 form-floating mb-3">
                            <input type="text" name="details_comp" class="form-control" id="floatingInput" required>
                            <label for="floatingInput">--Détails--</label>

                            <div class="Ajou">
                                <button type="submit" name="ajoutcomp" class="btn btn-primary btn-right">Ajouter</button>
                            </div>
                        </div>

                        <div class="col-6 form-floating mb-3">

                            <div id="liste" style="text-align: center;">

                                <?php
                                // Récupération de toutes les données de la table "experience"
                                $select = "SELECT DISTINCT nom_comp, details_comp FROM competence where id_candidat=$id_candidat";
                                $res = $conn->query($select);
                                $donnees = $res->fetchAll(PDO::FETCH_ASSOC);

                                // Construction d'une chaîne de caractères avec les données de la table "experience"
                                $resultat = "";
                                if (count($donnees) > 0) {
                                    foreach ($donnees as $row) {
                                        $resultat .= $row["nom_comp"] . " &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; "
                                            .
                                            $row["details_comp"] . "<br>";
                                    }
                                }

                                // Retourne la chaîne de caractères avec les données de la table "experience"
                                echo $resultat;

                                
                                ?>
                            </div>



                        </div>







                    </div>


                </form>
            </div>
        </div>

    </section>
    <form method="post">
        <section class="Form my-4 mx-5">
            <div class="container ">
                <div class="row no-gutters p-5 bg-light m-5 bg-opacity-75 d-flex justify-content-center">

                    <h3 class="font-weight-bold py-3  text-center">Actuellement</h3>

                    <div class="row no-gutters d-flex justify-content-center">
                        <div class="col-5 form-floating mb-3">
                            <div class="form-row mb-3">

                                <select class="form-select p-3" id="niveau" name="niveau" required>
                                    <option selected>--Niveau--</option>
                                    <option value="7">Bac+7</option>
                                    <option value="5">Bac+5</option>
                                    <option value="3">Bac+3</option>
                                    <option value="2">Bac+2</option>
                                    <option value="1">Bac</option>
                                    <option value="0">Niveau Bac</option>
                               
                                </select>
                            </div>
                        </div>
                        <div class="col-5 form-floating mb-3">
                            <div class="form-row mb-3">

                                <select class="form-select p-3" id="domaine" name="domaine" required>
                                    <option value="" selected disabled>Votre Domaine</option>
                                    <option value="info">informatique</option>
                                    <option value="mécanique">mécanique</option>
                                    <option value="economie">economie</option>
                                    <option value="génie civil">génie civil</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-5 form-floating  mb-3" style="height: 90px;">

                            <input class="cc" type="file" class="form-control" id="cvFile" accept=".pdf">
                            <label for="cvFile" style="margin-top: 20px;">Télécharger votre CV (format PDF uniquement)</label>

                        </div>
                        <br>
                        <script>
                            $('form').submit(function() {
                                var file = $('#cvFile').val();
                                if (file.slice(-4) !== '.pdf') {
                                    alert('Veuillez télécharger un fichier PDF.');
                                    return false;
                                }
                            });
                        </script>
                        <div class="col-10 form-floating mb-3 justify-content-center">

                            <div id="liste" style="text-align: center;">

                                <?php
                                // Récupération de toutes les données de la table "experience"
                                $select = "SELECT DISTINCT domaine, niveau FROM candidat where id_candidat=$id_candidat";

                                $res = $conn->query($select);
                                $donnees = $res->fetchAll(PDO::FETCH_ASSOC);

                                // Construction d'une chaîne de caractères avec les données de la table "experience"
                                $resultat = "";
                                if (count($donnees) > 0) {
                                    foreach ($donnees as $row) {
                                        $resultat .= $row["domaine"] . " &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; " . $row["niveau"] . "<br>";
                                    }
                                }

                                // Retourne la chaîne de caractères avec les données de la table "experience"
                                echo $resultat;




                               
                                ?>


                            </div>


                        </div>





                    </div>
                </div>
                <!--</div>-->

        </section>
        <section class="Form my-4 mx-5">
            <div class="form-row">
                <div class="col-5">
                    <button type="submit" name="ajouter" class="btn1 my-2 mb-4">Envoyez Votre Candidature</button>
                </div>
            </div>
        </section>
    </form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>