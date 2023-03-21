<?php session_start();
try {
    $db = new PDO('mysql:host=localhost;dbname=recjob;charset=utf8', 'root', '');
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Candidat</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>


    <div class="navbar navbar-expand-md bg-light navbar-light">
        <div class="container">
            <div class="col">
                <a class="navbar-brand fw-bold" href="../Accueil/index.html ">
                    <img class="photo" id="logo" src="images/logo.png">
                </a>
            </div>
            <div class="col ">
                <div class="row ">
                    <ul class="navbar-nav justify-content-end ">
                        <li class="nav-item ">
                            <a class="nav-link text-primary cn fw-bold" href="candidat.php"> Se connecter </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-primary cn fw-bold " href="inscrire.php">S'inscrire</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <ul class="navbar-nav justify-content-end ">
                        <li class="nav-item active">
                            <a class="nav-link fst-italic " href="../Accueil/index.html">Page d'Accueil</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row head">
            <div class="col-12 ">
                <h2 class="text-center p-2 "> Bienvenue à la page Candidat</h2>
            </div>
        </div>
    </div>
    <div>






        <!--se connecter/sinscrire-->
        <section class="Form my-4 mx-5">
            <div class="container">
                <div class="row no-gutters bg-light bg-opacity-75 ">
                    <div class="col-lg-6">
                        <img id="img" src="images/img.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 px-5 pt-5">
                        <h3 class="font-weight-bold py-3"> Accédez à votre compte</h3>
                        <form method="POST">
                            <div class="form-row">
                                <div class="col-lg-7">
                                    <input type="email" name="email_cand" autocomplete="off" placeholder="Adress-Email" class="form-control my-3 p-2" require>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-7">
                                    <input type="password" name="psswd_cand" autocomplete="off" placeholder="**********" class="form-control my-3 p-2" require>
                                </div>
                            </div>
                            <?php
                           // session_start();
                            if (isset($_POST["login"])) {
                                if($_POST["email_cand"]=="" or $_POST["psswd_cand"]==""){
                                    echo "<p><span style='color:red; font-weight: bold;'>L'email et le mot de passe ne peuvent pas être vides...!</span></p>";
                                } else {

                                    $email_cand=$_POST["email_cand"];
                                    $psswd_cand=$_POST["psswd_cand"];
                                    $sql="SELECT * FROM candidat WHERE email_cand='$email_cand' AND psswd_cand='$psswd_cand'";
                                    $query=$db->query($sql);

                                    $id="SELECT id_candidat  FROM candidat WHERE email_cand='$email_cand'";
                                    $test=$db->query($id);
                                    $row = $test->fetch(PDO::FETCH_ASSOC);
                                    $id_candidat = $row['id_candidat'];

                                    if($query->rowCount()>0){
                                    if($country = $query->fetch()) { 
                                    
                                        $_SESSION['candidat']=$id_candidat ;}
                                        header("Location: chercher.php");
            
        

                                    } else {
                                        echo "<p><span style='color:red; font-weight: bold;'>email ou mot de passe incorrect !!!!</span></p>";
                                    }
                                    
                                }
                            }
                            ?>
                            <div class="form-row">
                                <div class="col-lg-7">
                                    <button type="submit" name="login" class="btn1 my-2 mb-4">Se connecter</button>
                                </div>
                            </div>
                           
                            <p> Vous n'avez pas encore un compte ?<br><a href="inscrire.php">S'inscrire</a></p>
                        </form>
                    </div>



                </div>
            </div>

        </section>
    

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>