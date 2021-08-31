<?php
$title = 'Modification';
include '../views/header.php';
include '../controlers/update_script.php';
?>
<div class="container">
    <div class="row mx-2">
    <?php 
        if(isset($_GET['disc_id'])){
            $discId = $_GET['disc_id'];
            require_once '../model/config.php';
            $details = $crud->getDiscDetails($discId);
            $artists = $crud->getArtistList();
            ?>
            <?php
            if(isset($formError) && isset($fileError) && sizeof($formError) === 0 && sizeof($fileError) === 0 && isset($_POST['submit'])){
                // if there is no error
                // declare some variables to take the input values
                $disc_id = htmlspecialchars($discId);
                $disc_title = htmlspecialchars($_POST['disc_title']);
                $disc_year = htmlspecialchars($_POST['disc_year']);
                $disc_label = htmlspecialchars($_POST['disc_label']);
                $disc_genre = htmlspecialchars($_POST['disc_genre']);
                $disc_price = htmlspecialchars($_POST['disc_price']);
                $artist_id = htmlspecialchars($_POST['artist_id']);
                // if new picture uploaded or not
                if($_FILES['disc_picture']['error'] === 4 ){
                    $disc_picture = $details['disc_picture'];
                } else {
                    // extract the extension of the picture
                    $extension = substr(strrchr($_FILES['disc_picture']['name'], "."), 1);
                    // rename it and replace it to the target directory
                    $target_dir ='../assets/img/';      
                    $disc_picture = $disc_title.".".$extension;
                    $new_name = $target_dir.$disc_picture;
                    move_uploaded_file( $_FILES['disc_picture']['tmp_name'] , $new_name);
                }
                // call updateDisc method
                if($crud->updateDisc($disc_id, $disc_title, $disc_year, $disc_picture, $disc_label, $disc_genre, $disc_price, $artist_id)){
                    // redirect to home page
                    header("Location:../");
                }
            } else {
            ?>
            <h1 class="my-3">Modifier un vinyle</h1>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="row">
                    <label for="title" class="form-label mt-3">Title</label>
                    <input type="text" name="disc_title" id="title" class="form-control" value="<?= isset($details['disc_title']) ? $details['disc_title'] : '' ?>">
                    <span class="error"><?= isset($formError['disc_title']) ? $formError['disc_title'] : '' ?></span>
                    <label for="artist" class="form-label mt-3">Artist</label>
                    <select name="artist_id" id="artist" class="form-control">
                        <option value=""></option>
                        <?php foreach($artists as $artist){
                            ?>
                        <option value="<?= $artist->artist_id ?>" <?= (isset($details['artist_name']) && $details['artist_name'] === $artist->artist_name) ? 'selected' : '' ?>><?= $artist->artist_name ?></option>
                        <?php 
                        } 
                        ?>
                    </select>
                    <span class="error"><?= isset($formError['artist_id']) ? $formError['artist_id'] : '' ?></span>
                    <label for="year" class="form-label mt-3">Year</label>
                    <input type="text" name="disc_year" id="year" class="form-control" value="<?= isset($details['disc_year']) ? $details['disc_year'] : '' ?>">
                    <span class="error"><?= isset($formError['disc_year']) ? $formError['disc_year'] : '' ?></span>
                    <label for="label" class="form-label mt-3">Label</label>
                    <input type="text" name="disc_label" id="label" class="form-control" value="<?= isset($details['disc_label']) ? $details['disc_label'] : '' ?>">
                    <span class="error"><?= isset($formError['disc_label']) ? $formError['disc_label'] : '' ?></span>
                    <label for="genre" class="form-label mt-3">Genre</label>
                    <input type="text" name="disc_genre" id="genre" class="form-control" value="<?= isset($details['disc_genre']) ? $details['disc_genre'] : '' ?>">
                    <span class="error"><?= isset($formError['disc_genre']) ? $formError['disc_genre'] : '' ?></span>
                    <label for="price" class="form-label mt-3">Price</label>
                    <input type="text" name="disc_price" id="price" class="form-control" value="<?= isset($details['disc_price']) ? $details['disc_price'] : '' ?>">
                    <span class="error"><?= isset($formError['disc_price']) ? $formError['disc_price'] : '' ?></span>
                    <label for="price" class="form-label mt-3">Picture</label>
                    <input type="file" class="form-control" id="picture" name="disc_picture">
                    <span class="error"><?= isset($fileError['disc_picture']) ? $fileError['disc_picture'] : '' ?></span>
                    <div class="col-sm-12 col-lg-4 mt-3">
                        <img src="../assets/img/<?=isset($details['disc_picture']) ? $details['disc_picture'] : '' ?>" class="img-thumbnail" alt="<?=isset($details['disc_picture']) ? $details['disc_picture'] : '' ?>">
                    </div>
                    <div class="my-5">
                    <input type="submit" class="btn btn-primary" value="Modifier" name="submit">
                    <a href="../" class="btn btn-secondary">Retour</a>
                </div>
            </form>
            <?php
            }
        ?>
        <?php
        } else {
            ?>
            <div class="container">
                <h1 class="text-danger my-5" >La page que vous cherchiez n'est pas trouvée!</h1>
            </div>
        <?php
        }
    ?>
    </div>
</div>
<?php
    include '../views/footer.php';
?>