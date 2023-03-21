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

$id_recruteur=$_SESSION['id'];
$id_offre=$_SESSION["offre"];

$sql = "SELECT * FROM offre_emploi WHERE id_offre='$id_offre'";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_offre', $id_offre);
$stmt->execute();
$off = $stmt->fetch(PDO::FETCH_ASSOC);


if(isset($_POST["offf"])){
     $poste = $_POST["poste"];
    $nom_entreprise = $_POST["nom_entreprise"];
    $domaine = $_POST["domaine"];
    $type_contrat = $_POST["type_contrat"];
    $duree = $_POST["duree"];
    $localisation = $_POST["localisation"];
    $salaire = $_POST["salaire"];
    $descr = $_POST["descr"];
   

    $upd = "UPDATE offre_emploi SET poste='$poste', nom_entreprise='$nom_entreprise', domaine='$domaine', type_contrat='$type_contrat', duree='$duree', localisation='$localisation', salaire='$salaire', descr='$descr' WHERE id_offre='$id_offre'";
    $requete = $conn->prepare($upd);
    $requete->bindParam(":poste", $poste);
    $requete->bindParam(":nom_entreprise", $nom_entreprise);
    $requete->bindParam(":domaine", $domaine);
    $requete->bindParam(":type_contrat", $type_contrat);
    $requete->bindParam(":duree", $duree);
    $requete->bindParam(":localisation", $localisation);
    $requete->bindParam(":salaire", $salaire);
    $requete->bindParam(":descr", $descr);

   if ($requete->execute()) {

        header("Location: mapage.php");

   }

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
    <link href="style.css" rel="stylesheet"/>
</head>

<body>
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
                <h2 class="text-center p-2"> Bienvenue à la page Recruteur </h2>
            </div>
        </div>
    </div>
    <div>
        <!--se connecter/sinscrire-->
        <section class="Form my-4 mx-5">
            <div class="container pl-5">
                <div class="row no-gutters bg-light p-2 bg-opacity-75 d-flex justify-content-center">
                    <div class="col-lg-9 px-5 pt-3 ">
                        <h3 class="font-weight-bold py-3 text-center"> Modifier les informations du Score</h3>
                        <form  method="post">
                            
                            <div class=" col form-floating mt-5 mb-3">
                                <input type="name" class="form-control" id="floatingInput" value="<?php echo $off['poste']; ?>" name="poste" placeholder="Nom du poste">
                                <label for="floatingInput">Nom du poste</label>
                            </div>
                            <div class=" col form-floating mb-3">
                                <input type="name" class="form-control" id="floatingInput" value="<?php echo $off['nom_entreprise']; ?>" name="nom_entreprise" placeholder="Nom d'Entreprise'">
                                <label for="floatingInput">Nom de l'Entreprise</label>
                            </div>
                            <div class="form-row mb-3 ">
                                <div class="col">
                                    <select class="form-select p-3" name="domaine" value="<?php echo $off['domaine']; ?>" aria-label="Domaine entreprise">
                                        <option selected>--Domaine--</option>
                                        <option value="info">Informatique</option>
                                        <option value="com">Commerce</option>
                                        <option value="meca">Mécanique</option>
                                        <option value="elec">Electrique</option>
                                        <option value="cui">Cuisine</option>
                                        <option value="med">Medecine</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col">
                                    <select class="form-select p-3" value="<?php echo $off['type_contrat']; ?>" name="type_contrat" aria-label="type">
                                        <option selected>-- Type de Contrat --</option>
                                        <option value="emp">Emploi</option>
                                        <option value="st-pre">Stage Pré Embauche</option>
                                        <option value="st">Stage</option>
                                    </select>
                                </div>
                            </div>
                            <div class=" col form-floating mb-3">
                                <input type="number" class="form-control" value="<?php echo $off['duree']; ?>" name="duree" id="floatingInput" placeholder="Durée">
                                <label for="floatingInput">Durée (mois)</label>
                            </div>
                            <div class=" col form-floating mb-3">
                                <input type="text" class="form-control" name="localisation" value="<?php echo $off['localisation']; ?>" id="floatingInput" placeholder="adresse">
                                <label for="floatingInput">Adresse</label>
                            </div>
                            <div class=" col form-floating mb-3">
                                <input type="number" class="form-control" name="salaire" value="<?php echo $off['salaire']; ?>" id="floatingInput" placeholder="salaire">
                                <label for="floatingInput">Salaire</label>
                            </div>
                            <div class=" col form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" value="<?php echo $off['descr']; ?>" name="descr" placeholder="description">
                                <label for="floatingInput">Description</label>
                            </div>
                            
                            <div class="form-row">
                                <div class="col">
                                    <button type="submit" class="btn1 my-2 mb-4" name="offf">Modifier</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </section>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
</body>

</html>