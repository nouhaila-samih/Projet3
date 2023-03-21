<?php //session_start();
include "insconfig.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Candidat</title>
    <link href="css/style.css" rel="stylesheet"/>
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
                            <a class="nav-link fst-italic " href="../Accueil/index.html"> Page d'Accueil</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row head" style="margin-bottom: 20px;">
            <div class="col-12 head">
                <h2 class="text-center p-2"> Bienvenue à la page Candidat </h2>
            </div>
        </div>
    </div>
    
        <!--se connecter/sinscrire-->
        <!--<form method="POST" class="Form my-4 mx-5">-->
            <div class="container pl-5">
                <div class="row no-gutters bg-light p-2 bg-opacity-75 ">
                    <div class="col-lg-6 px-5 pt-3 ">
                        <h3 class="font-weight-bold py-3"> Créer votre Compte</h3>
                        <form method="POST">
                            <div class="form-row">
                                <div class="col-lg-10">
                                    <input type="text" name="nom_cand" placeholder="Nom" class="form-control my-3 p-2" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-10">
                                    <input type="text" name="prenom_cand" placeholder="Prénom" class="form-control my-3 p-2" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-10">
                                    <input type="date" name="date_cand" placeholder="Date de naissance" class="form-control my-3 p-2" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-10">
                                    <input type="tel" name="telephone_cand" placeholder="Téléphone" class="form-control my-3 p-2" >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-10">
                                    <input type="text" name="ville_cand" placeholder="Ville" class="form-control my-3 p-2" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-10">
                                    <input type="email" name="email_cand" placeholder="Email" class="form-control my-3 p-2" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-10">
                                    <input type="password" name="psswd_cand" placeholder="*****" class="form-control my-3 p-2" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-10">
                                    <button type="submit" name="inscrire" class="btn1 my-2 mb-4">S'inscrire</button>
                                </div>
                            </div>
                            <p> Vous avez déja un compte ? <br><a href="candidat.php">Se Connecter</a></p>
                        </form>
                    </div>
                    <div class="col-lg-5">
                        <img src="images/a4.jpg" class="img-fluid mt-5 pt-5" alt="">
                    </div>
                </div>
            </div>
<!--</form>-->


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
</body>

</html>