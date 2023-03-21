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

$sql = "SELECT * FROM score WHERE id_recruteur=:id_recruteur";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_recruteur', $id_recruteur);
$stmt->execute();
$score = $stmt->fetch(PDO::FETCH_ASSOC);


if(isset($_POST["scr"])){
    $sc_comp = $_POST["sc_comp"];
    $sc_dip = $_POST["sc_dip"];
    $sc_exp = $_POST["sc_exp"];  
   

    $upd = "UPDATE score SET sc_comp=:sc_comp, sc_dip=:sc_dip, sc_exp=:sc_exp WHERE id_recruteur=:id_recruteur";

    $stmt = $conn->prepare($upd);
    $stmt->bindParam(':sc_comp', $sc_comp);
    $stmt->bindParam(':sc_dip', $sc_dip);
    $stmt->bindParam(':sc_exp', $sc_exp);
    $stmt->bindParam(':id_recruteur', $id_recruteur);

    if ($stmt->execute()) {

        header("Location: Profil.php");

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
                            <div class="form-row ">
                                <div class="col ">
                                    <input name="sc_comp" type="number" placeholder="Score pour Compétance" value="<?php echo $score['sc_comp']; ?>" class="form-control my-3 p-2">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <input name="sc_dip" type="number" placeholder="Score pour Diplome" value="<?php echo $score['sc_dip']; ?>" class="form-control my-3 p-2">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <input name="sc_exp" type="number" placeholder="Score pour Expérience"  value="<?php echo $score['sc_exp']; ?>" class="form-control my-3 p-2">
                                </div>
                            </div>
                            
                            
                            <div class="form-row">
                                <div class="col">
                                    <button type="submit" class="btn1 my-2 mb-4" name="scr">Modifier</button>
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