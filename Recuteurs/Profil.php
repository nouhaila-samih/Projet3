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
                    <h2 style="text-align: center;">Mon Profil</h2>
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

                            $sql = "SELECT * FROM recruteur where id_recruteur='$id_recruteur'";
                            $stmt = $conn->query($sql);
                            $ligne = $stmt->fetch(PDO::FETCH_ASSOC);
                                   echo "<div style=\" font-size:20px;margin:1em; padding:1em; border-radius: 10px; background-color: rgba(255,255,255,0.5);\">";
                                    echo "<p><span style=\" text-decoration: underline\" >Nom</span>: " . htmlspecialchars($ligne["nom_recrut"]) ."</p>";
                                    echo"<p><span style=\" text-decoration: underline\" >Prénom</span>: ". htmlspecialchars($ligne["prenom_recrut"]) ."</p>";
                                    echo"<p><span style=\" text-decoration: underline\" >Email</span>: ". htmlspecialchars($ligne["email_recrut"]) ."</p>";
                                    echo"<p><span style=\" text-decoration: underline\" >Téléphone</span>: 0". htmlspecialchars($ligne["telephone_recrut"]) ."</p>";

                                    echo "</div>";
                                
                           
                            ?>
                          
                    <button style="border: none; outline: none;height: 50px;float:right; ;width:20%;background-color: rgb(47, 47, 170);color: white;border-radius: 4px;font-weight: bold;" onclick="location.href='pupdate.php'" id="btn1" type="button"  name="upd">Modifier les Informations</button>
             </div>
             <div class="col-lg-12 p-2 mt-2">
                        <?php 

                            $id_recruteur= $_SESSION['id'];

                            $sql = "SELECT * FROM score where id_recruteur='$id_recruteur'";
                            $stmt = $conn->query($sql);
                            if ($stmt->rowCount() > 0) {
                               
                            $ligne = $stmt->fetch(PDO::FETCH_ASSOC);
                                   echo "<div style=\" font-size:20px;margin:1em; padding:1em; border-radius: 10px; background-color: rgba(255,255,255,0.5);\">";
                                    echo "<p><span style=\" text-decoration: underline\" >Score de Compétance</span>: " . htmlspecialchars($ligne["sc_comp"]) ."</p>";
                                    echo"<p><span style=\" text-decoration: underline\" >Score de Diplome</span>: ". htmlspecialchars($ligne["sc_dip"]) ."</p>";
                                    echo"<p><span style=\" text-decoration: underline\" >Score d'Expérience</span>: ". htmlspecialchars($ligne["sc_exp"]) ."</p>";

                                    echo "</div>";
                            }
                            
                            ?>
                          
                    <button style="border: none; outline: none;height: 50px;float:right; ;width:25%;background-color: rgb(47, 47, 170);color: white;border-radius: 4px;font-weight: bold;" onclick="location.href='scupdate.php'" id="btn1" type="button"  name="upd">Modifier les options du score</button>
             </div>

                    </div>
                </div>
            </div>
        </section>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
</body>

</html>