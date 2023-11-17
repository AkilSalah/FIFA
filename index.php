<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FIFA WORLD CUP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
</head>

<body>
<nav class="navbar nav navbar-light position-absolute">
  <a class="navbar-brand nav " href="#">
    <img src="IMG/Logo-W-removebg-preview.png" width="80" style="margin-left: 740%;"  alt="">
  </a>
</nav>
<div class="containe">
  <img src="IMG/5205447.jpg" class="img-fluid" alt="...">
  <div class="overlay">
    <h1>FIFA World Cup Morocco™</h1>
    <p>Bienvenue sur le site "Morocco World Cup Explorer", votre hub central pour tout ce qui concerne la Coupe du Monde 2030 au Maroc ! Plongez dans l'excitation du plus grand événement sportif mondial alors que les équipes de football du monde entier s'affrontent dans des stades emblématiques. Découvrez le calendrier officiel, explorez les équipes, suivez les analyses en direct, et restez connecté à l'action grâce à notre couverture complète. Que vous soyez un fervent fan de football ou simplement curieux, "Morocco World Cup Explorer" vous offre une expérience immersive pour vivre pleinement chaque instant de cette compétition historique au cœur du Maroc.</p>
  </div>
</div>
  <section class="groupes " >
    <h1 class="text-center fw-bold my-5">FIFA World Cup™ Groupes</h1>

    <?php
    include_once("connexion.php");

    $searchTerm = '';

    if (!isset($_GET['showAllGroups'])) {
      $searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';
    }

    $query = "SELECT * FROM groupe";

    if (!empty($searchTerm)) {
      $query = "SELECT * FROM groupe WHERE nom_groupe LIKE '%$searchTerm%'";
    }

    $reqGroupes = mysqli_query($con, $query);
    ?>

    <nav class="navbar bg-body-tertiary">
      <div class="container-fluid justify-content-around">

        <a class="btn fw-bold btn-outline-dark" href="index.php?showAllGroups=1">G r o u p e s</a>
        <form class="d-flex" action="" method="GET">
          <input class="form-control me-2" id="searchInput" name="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-danger" type="submit" id="searchButton">Search</button>
        </form>
      </div>
    </nav>

<div class="grps" >
    <div class="row row-cols-1 row-cols-md-4 g-4 mx-auto mt-5 grp" id="groupCards"   >
      <?php while ($rowGroupe = mysqli_fetch_assoc($reqGroupes)) : ?>
        <div class="col mx-auto ">
          <div class="card ">
            <div class="card-header text-white fw-bold fs-5 text-center" style="background-color: #990011FF;"><?= $rowGroupe['nom_groupe'] ?></div>
            <?php
            $groupe_id = $rowGroupe['id_groupe'];
            $reqEquipes = mysqli_query($con, "SELECT * FROM equipe WHERE id_groupe = $groupe_id");
            ?>
            <?php while ($rowEquipe = mysqli_fetch_assoc($reqEquipes)) : ?>
              <div class="card-body d-flex justify-content-between fw-bold">
                <img src="<?= $rowEquipe["logo"] ?>" alt="logo">
                <p class="my-auto"><?= $rowEquipe["nom_equipe"] ?></p>

                <!-- À ajouter à l'intérieur de la boucle d'équipes, dans la carte d'équipe -->
                <button  class="btn " data-bs-toggle="modal" data-bs-target="#equipeModal<?= $rowEquipe['id_equipe'] ?>">
                  <i class="fas fa-external-link-alt my-auto mx-auto " style="color: black;"></i>
                </button>

                <!-- Modal pour chaque équipe -->
                <div class="modal fade" id="equipeModal<?= $rowEquipe['id_equipe'] ?>" tabindex="-1" aria-labelledby="equipeModalLabel<?= $rowEquipe['id_equipe'] ?>" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="equipeModalLabel<?= $rowEquipe['id_equipe'] ?>"> <img src="<?=$rowEquipe["logo"]?>" alt="">  <?= $rowEquipe['nom_equipe'] ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <h4 class="text-danger" >Continent :</h4><p> <?= $rowEquipe['continent_equipe'] ?></p>
                        <h4 class="text-danger" >Capitain :</h4> <p> <?= $rowEquipe['capitain_equipe'] ?></p>
                        <h4 class="text-danger" >Description :</h4> <p> <?= $rowEquipe['description'] ?></p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fermer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
            <div class="card-footer text-black fw-bold fs-5 text-center" style="background-color: #FCF6F5FF;"><?= $rowGroupe["stade"] ?></div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
    <footer class="text-center text-white mt-5" style="background-color: #990011FF;">
      <div class="container p-4">
        <section class="">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
              <div class="ratio ratio-16x9">
                <iframe class="shadow-1-strong rounded" width="560" height="315" src="https://www.youtube.com/embed/2JjFcL3BvUY?si=PYz4AlIott3iepgM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                ></iframe>
              </div>
            </div>
          </div>
        </section>

      </div>

      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2023 Copyright:
        <a class="text-white" href="https://mdbootstrap.com/">CodeX.com</a>
      </div>

    </footer>


    <script src="script.js"></script>
</body>

</html>