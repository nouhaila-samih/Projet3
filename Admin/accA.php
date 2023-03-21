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
                   <a class="nav-link text-primary cn fw-bold" href="../Accueil/index.html">  Se déconnecter </a>
                </li>
                    </ul>
                </div>
                <div class="row">
            <ul class="navbar-nav justify-content-end ">
                <li class="nav-item">
                    <a class="nav-link fst-italic" href="#rec"> Recruteurs </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fst-italic" href="#can"> Candidats </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link fst-italic" href="#off"> Offre d'Emploi </a>
                </li>
                
            </ul>
            </div>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row head">
            <div class="col-12 head">
                <h2 class="text-center p-2"> Bienvenue à la page Administrateur </h2>
            </div>
        </div>
    </div>
    <div>
       
        <section class="Form my-4 mx-5">
            <div class="container">
                <div class="row no-gutters bg-light bg-opacity-75  p-3">
                    <h2 style="text-align: center;">Données</h2>
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

                            $rec = "SELECT * FROM recruteur ";
                            $stmt = $conn->query($rec);
                            
                            // Vérification du résultat
                            if ($stmt->rowCount() > 0) {
                                
                                echo "<h4 style=\" margin:1em;\" id='rec'>Recruteurs</h4>";
                                while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                   
                                   
                                   echo "<div style=\" margin:1em; padding:1em; height:130px; border-radius: 10px; background-color: rgba(255,255,255,0.5);\">";
                                    echo "<div>";
                                    echo "<br>" . htmlspecialchars($ligne["nom_recrut"])." " . htmlspecialchars($ligne["prenom_recrut"])." ";
                                    echo "<br>" . htmlspecialchars($ligne["email_recrut"]);
                                    echo"</div>";
                                    
                                    echo "<div>";
                                    echo "<form method='POST'>";
                                    
                                    echo "<input type='hidden' name='dell' value='{$ligne["id_recruteur"]}'>";
                                    echo "<button style=\"border: none; outline: none;height: 30px;float:right;
                                    width:100px;background-color: red;color: white;border-radius: 4px;font-weight: bold;\" type='submit' name='del'>Delete</button>";
                                    
                                    
                                    echo "</form>";
                                    echo"</div>";
                                   echo"</div>";
                                    
                                     if (isset($_POST["del"])) {
                                    
                                    $id = $_POST['dell'];
                                    $delete = "DELETE FROM recruteur WHERE id_recruteur='$id'";
                                    $requete = $conn->prepare($delete);
                                    $requete->bindParam(":id_recruteur", $id_recruteur);
                                    
                                    $requete->execute();
                                    }
                                    
                                }
                            } 


                            
                            $cand = "SELECT * FROM candidat ";
                            $stmt = $conn->query($cand);
                            
                            // Vérification du résultat
                            if ($stmt->rowCount() > 0) {
                                
                                echo "<h4 style=\" margin:1em;\" id='can'>Candidats</h4>";
                                while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                   
                                   
                                   echo "<div style=\" margin:1em; padding:1em; height:130px; border-radius: 10px; background-color: rgba(255,255,255,0.5);\">";
                                    echo "<div>";
                                    echo "<br>" . htmlspecialchars($ligne["nom_cand"])." " . htmlspecialchars($ligne["prenom_cand"])." ";
                                    echo "<br>" . htmlspecialchars($ligne["email_cand"]);
                                    echo"</div>";
                                    
                                    echo "<div>";
                                    echo "<form method='POST'>";
                                    
                                    echo "<input type='hidden' name='dell' value='{$ligne["id_candidat"]}'>";
                                    echo "<button style=\"border: none; outline: none;height: 30px;float:right;
                                    width:100px;background-color: red;color: white;border-radius: 4px;font-weight: bold;\" type='submit' name='del'>Delete</button>";
                                    
                                    
                                    echo "</form>";
                                    echo"</div>";
                                   echo"</div>";
                                    
                                     if (isset($_POST["del"])) {
                                    
                                    $id = $_POST['dell'];
                                    $delete = "DELETE FROM candidat WHERE id_candidat='$id'";
                                    $requete = $conn->prepare($delete);
                                    $requete->bindParam(":id_candidat", $id_candidat);
                                    
                                    $requete->execute();
                                    }
                                    
                                }
                            

                                
                            $offre = "SELECT * FROM offre_emploi ";
                            $stmt = $conn->query($offre);
                            
                            // Vérification du résultat
                            if ($stmt->rowCount() > 0) {
                                
                                echo "<h4 style=\" margin:1em;\" id='off'>Offre d'Emploi</h4>";
                                while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                   
                                   
                                   echo "<div style=\" margin:1em; padding:1em; height:130px; border-radius: 10px; background-color: rgba(255,255,255,0.5);\">";
                                    echo "<div>";
                                    echo "<br>" . htmlspecialchars($ligne["poste"])." - " . htmlspecialchars($ligne["nom_entreprise"])." ";
                                    echo "<br>" . htmlspecialchars($ligne["localisation"]);
                                    echo"</div>";
                                    
                                    echo "<div>";
                                    echo "<form method='POST'>";
                                    
                                    echo "<input type='hidden' name='dell' value='{$ligne["id_offre"]}'>";
                                    echo "<button style=\"border: none; outline: none;height: 30px;float:right;
                                    width:100px;background-color: red;color: white;border-radius: 4px;font-weight: bold;\" type='submit' name='del'>Delete</button>";
                                    
                                    
                                    echo "</form>";
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