<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style2.css">
</head>


<body >

    <div class="navbar navbar-expand-md bg-light navbar-light">
        <div class="container">
            <div class="col">
                <a class="navbar-brand fw-bold" href="../Accueil/index.html">
                    <img id="logo" src="images/logo.png">
                </a>
            </div>
            <div class="col">
                <div class="row">
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
    <div class="container mt-3 ">
        <div class="row p-2 head ">
            <div class="col-12">

                <h2 class="text-center"> Chercher un emploi </h2>
            </div>
        </div>
    </div>


    <div class="container mt-3 slider">

        <div class="slide">
            <img src="images/a3.jpg" id="slideImg" alt="img">

        </div>

        <div class="overplay">
            <form method="post">
                <div class="row d-flex justify-content-around p-5">
                    <div class="col-lg-3 ">
                        <select name="poste" class="form-select f1" aria-label="Domaine entreprise">
                            <option selected>--Poste--</option>
                            <option value="Directeur général"> Directeur général</option>
                            <option value="Developpeur"> Developpeur</option>

                            <option value="Digital Brand Manager">Digital Brand Manager</option>
                            <option value="Responsable communication"> Responsable communication</option>
                            <option value="Secrétaire général">Secrétaire général</option>
                            <option value="Secretaire">Secretaire</option>
                            <option value="Stagiaire">Stagiaire</option>

                        </select>
                    </div>

                    <div class="col-lg-3 ">
                        <select name="domaine" class="form-select f1" aria-label="Domaine entreprise">
                            <option selected>--Domaine--</option>
                            <option value="info">Informatique</option>
                            <option value="Commerce">Commerce</option>
                            <option value="Mécanique">Mécanique</option>
                            <option value="Electrique">Electrique</option>
                            <option value="Cuisine">Cuisine</option>

                            <option value="med">Medecine</option>
                        </select>
                    </div>

                    <div class="col-lg-3 ">
                        <select name="localisation" id="localisation" class="form-select f1" aria-label="Ville">
                            <option selected>--Ville--</option>
                            <option value="Casablanca">Casablanca</option>
                            <option value="Rabat">Rabat</option>
                            <option value="Tanger">Tanger</option>
                            <option value="Fes">Fes</option>
                            <option value="Meknes">Meknes</option>
                            <option value="Essaouira">Essaouira</option>
                            <option value="Mohammedia">Mohammedia</option>
                            <option value="Agadir">Agadir</option>
                            <option value="Marrakech">Marrakech</option>
                            <option value="El Housseima">El Housseima</option>
                        </select>
                    </div>
                    <div class="col-lg-1 bbt ">
                        <button name="ajouter" class="btn btn-primary" type="submit">Confirmer</button>
                    </div>
                </div>
            </form>


        </div>
    </div>

<section class="Form my-4 mx-5">
            <div class="container">
                <div class="row no-gutters bg-light bg-opacity-75  p-3">
                    <h2 style="text-align: center;">Les Offres</h2>
                    <div class="col-lg-12 p-2 mt-2">
    
         <?php 
//session_start();
// Connexion à la base de données MySQL avec PDO
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recjob";


// Connexion à la base de données MySQL avec PDO
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recjob";
try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connexion réussie";
} catch (PDOException $e) {
    echo "Connexion échouée : " . $e->getMessage();
}


if (isset($_POST["ajouter"])) {

    $domaine = $_POST['domaine'];
    $localisation = $_POST['localisation'];
    $poste = $_POST['poste'];

    // Requête SQL pour récupérer les offres correspondantes
    $sql = "SELECT * FROM offre_emploi WHERE domaine='$domaine' AND localisation ='$localisation' AND poste ='$poste'";
    $stmt = $bdd->query($sql);

    // Vérification du résultat

    if ($stmt->rowCount() > 0) {
                     

        while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {

           
            echo "<div style=\" margin:1em; padding:1em; display:flex; border-radius: 10px; background-color: rgba(255,255,255,0.5);\">";
            echo"<div style=\" margin-top:2em;\">";
            if ($ligne["type_contrat"] == 'emp') {
                echo "<img width=200 src=\"emploi.jpeg\">";
            } elseif ($ligne["type_contrat"] == 'st-pre') {
                echo "<img width=200 src=\"pre.png\">";
            }elseif ($ligne["type_contrat"] == 'st') {
                echo "<img width=200 src=\"stage.jpeg\">";
            }
            echo"</div>";
            echo "<div style=\"margin:2em;\"><h4>" . htmlspecialchars($ligne["poste"]) . " -- ". htmlspecialchars($ligne["nom_entreprise"]) ."</h4>";
            echo "<span style=\"font-weight:bold; text-decoration:underline;\"> " . htmlspecialchars($ligne["localisation"])."</span>";
            echo "<br><br><span style=\"border:1px solid black; padding:2px;border-radius:7px; 
            margin-top:5px;margin-bottom:5px;\" >" . htmlspecialchars($ligne["salaire"]) . " Dhs</span>";
            echo "<br>" . htmlspecialchars($ligne["duree"]). " mois";
            echo "<br>" . htmlspecialchars($ligne["descr"]) . "</div>";
            echo "<div>";
           echo "<form method=\"post\">";
           echo "<input type='hidden' name='imp' value='{$ligne["id_offre"]}'>";
            echo "<button style=\"border: none; outline: none;height: 50px;float:right; ;width:100%;background-color: rgb(47, 47, 170);color: white;border-radius: 4px;font-weight: bold;\"  type=\"submit\" id=\"postuler\"  name=\"postuler\"  \">Postuler</button>";
            echo "</form>";
            echo "</div>";
            echo "</div>";

            

        
        }

    } else {

        echo "Aucun offre d'emploi à afficher.";

    }
    

}
if (isset($_POST['postuler'])) {
                $id_offre=$_POST['imp'];
                    $sq = "SELECT  id_offre, id_recruteur  FROM offre_emploi WHERE id_offre='$id_offre'";

                    $stmt1 = $bdd->query($sq);
                  if ($stmt1->rowCount() !== 0) {


                     while ($lig = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        // Récupération des valeurs de id_candidat et id_recruteur depuis $_SESSION et $ligne
                        $id_candidat = $_SESSION['candidat'];
                        $id_recruteur=$lig["id_recruteur"];
                       

                        // Vérifier si l'enregistrement existe déjà dans la base de données
                        //$query = "SELECT * FROM postulation WHERE id_candidat=:id_candidat AND id_recruteur=:id_recruteur AND id_offre=:id_offre";
                       // $result = $bdd->prepare($query);
                       // $result->bindParam(':id_candidat', $id_candidat);
                    /* $result->bindParam(':id_recruteur', $id_recruteur);
                        $result->bindParam(':id_offre', $id_offre);
                        $result->execute();

                        // Si l'enregistrement n'existe pas, insérez-le dans la base de données
                        if ($result->rowCount() == 0) {*/

                            $insert = $bdd->prepare("INSERT INTO postulation (id_candidat, id_recruteur, id_offre) VALUES('$id_candidat', '$id_recruteur', '$id_offre')");
                            $insert->bindParam(':id_candidat', $id_candidat);
                            $insert->bindParam(':id_recruteur', $id_recruteur);
                            $insert->bindParam(':id_offre', $id_offre);
                            $insert->execute();
                            echo '<p style="color:green;">Votre candidature a été envoyée avec succès!</p>';
                      /* // } else {
                            // Si l'enregistrement existe déjà, afficher un message d'erreur
                           // echo '<p style="color:red;">Vous avez déjà postulé pour cette offre!</p>';
                        }*/
                    }
                }

               
            }


?>










                    </div>
                </div>
            </div>
        </section>



</body>

</html>