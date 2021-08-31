<?php
    $title='Accueil';
    include 'views/header.php';
    require 'model/config.php';
    $result= $crud->getDiscList();
?>
<div class="container">
    <div class="d-flex my-3">
        <h1>Liste des disques</h1>
        <div class="ms-auto"><a href="views/add_form.php" class="btn btn-primary">Ajouter</a></div>
    </div>
    
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4 g-4">
        <?php
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
        ?>
        <div class="col">
            <div class="card">
                <img src="assets/img/<?= $row['disc_picture'] ?>" class="card-img-top" alt="<?= $row['disc_picture'] ?>">
                <div class="card-body">
                    <h3 class="card-title"><?= $row['disc_title'] ?></h3>
                    <p class="card-text"><strong><?= $row['artist_name'] ?></strong></p>
                    <p class="card-text"><strong>Label:</strong><?= $row['disc_label'] ?></p>
                    <p class="card-text"><strong>Year:</strong><?= $row['disc_year'] ?></p>
                    <p class="card-text"><strong>Genre:</strong><?= $row['disc_genre'] ?></p>
                    <a href="views/details.php?disc_id=<?= $row['disc_id'] ?>" class="btn btn-primary">Détails</a>
                </div>
            </div>
        </div>
        <?php 
        } 
        ?>
    </div>
</div>
<?php
    include 'views/footer.php';
?>