<?php
    if(isset($_GET['disc_id'])){
        $discId = $_GET['disc_id'];
        require_once '../model/config.php';
        $details = $crud->getDiscDetails($discId);
        $title = isset($details['disc_title']) ? $details['disc_title'] : 'This product id does not exist!';
        include '../views/header.php';
        ?>
        <div class="container">
        <h1 class="my-3">Details</h1>
        <form action="#" method="get">
            <div class="row mx-2">
                <div class="col-sm-12 col-lg-4">
                    <img src="../assets/img/<?=isset($details['disc_picture']) ? $details['disc_picture'] : '' ?>" class="img-thumbnail" alt="<?=isset($details['disc_picture']) ? $details['disc_picture'] : '' ?>">
                </div>
                <div class="col-sm-12 col-lg-4" >
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="<?= isset($details['disc_title']) ? $details['disc_title'] : '' ?>" disabled>
                    <label for="year" class="form-label">Year</label>
                    <input type="text" name="year" id="year" class="form-control" value="<?= isset($details['disc_year']) ? $details['disc_year'] : '' ?>"  disabled>
                    <label for="label" class="form-label">Label</label>
                    <input type="text" name="label" id="label" class="form-control" value="<?= isset($details['disc_label']) ? $details['disc_label'] : '' ?>"  disabled>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <label for="artist" class="form-label">Artist</label>
                    <input type="text" name="artist" id="artist" class="form-control" value="<?= isset($details['artist_name']) ? $details['artist_name'] : '' ?>"  disabled>
                    <label for="genre" class="form-label">Genre</label>
                    <input type="text" name="genre" id="genre" class="form-control" value="<?= isset($details['disc_genre']) ? $details['disc_genre'] : '' ?>"  disabled>
                    <label for="price" class="form-label">Price</label>
                    <input type="text" name="price" id="price" class="form-control" value="<?= isset($details['disc_price']) ? $details['disc_price'] : '' ?>"  disabled>
                </div>
            </div>
            <div class="my-5">
                <a href="update_form.php?disc_id=<?= $discId ?>" class="btn btn-primary">Modifier</a>
                <a href="delete_form.php?disc_id=<?= $discId ?>" class="btn btn-danger">Supprimer</a>
                <a href="../" class="btn btn-secondary">Retour</a>
            </div>
        </form>
    </div>
    <?php
    }else{
        $title = 'Product not found!';
        include '../views/header.php';
    ?>
    <div class="container">
        <h1 class="text-danger my-5" >La page que vous cherchiez n'est pas trouvée!</h1>
    </div>
    <?php
    }
    ?>
<?php
    include '../views/footer.php';
?>