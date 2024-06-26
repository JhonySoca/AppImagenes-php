<?php
session_start();
require "./controllers/post.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Images</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    

    <div class="container justify-content-center">
        <div class="mt-5 mx-auto">
            <div>
                <?php if(isset($_SESSION["error"])){ ?>

                    <div class="alert alert-danger alert-dismisible fade show" role="alert">
                       <?=$_SESSION["error"]?>
                       <button class="btn-close" type="button" data-bs-dismiss="alert" arial-label="close"></button> 
                    </div>  
                    <?php unset($_SESSION["error"]);

                }?>


                <?php if(isset($_SESSION["success"])){ ?>

                    <div class="alert alert-success alert-dismisible fade show" role="alert">
                       <?=$_SESSION["success"]?>
                       <button class="btn-close" type="button" data-bs-dismiss="alert" arial-label="close"></button> 
                    </div>  
                    <?php unset($_SESSION["success"]);
                    
                }?>



                <form action="controllers/new-post-photo.php" method="POST" enctype="multipart/form-data">

                    <h5 class="mb-3">Elige una imagen y añade una descripcion</h5>
                        <div class="d-flex justify-content-between">
                            <input type="file" class="form-control mb-3" name="files[]" multiple id="file" accept=".png, .jpg, .jpeg" style="width:60%;" required>
                            <textarea name="description" id="description" rows="1" class="form-control mb-3 mx-3" style="resize:none;" placeholder="Añade una descripcion" required></textarea>
                            <button class="btn btn-primary mb-3" type="submit" style="width:20%;" name="btn-new-post-photo">Publicar</button>
                        </div>
                </form>

            </div>
        </div>
    </div>


    <div class="container mt-5 mb-5 py-2">

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-5">
    <?php for($i=0; $i<count($posts); $i++) {

        $imagesName = explode(",", $posts[$i]["images"]); ?>

        <div class="col">
            <div class="carousel slide" id="carousel<?=$posts[$i]["id"]?>" data-bs-ride="false">
                <div class="carousel-indicators">
                    <?php for($j=0; $j<count($imagesName); $j++) {
                        if($j==0) { ?>

                            <button class="active" type="button" data-bs-target="#carousel<?=$posts[$i]["id"]?>" data-bs-slide-to="<?=$j?>" aria-current="true" aria-label="Slide<?=$j?>"></button>
                        <?php } else { ?>
                            <button type="button" data-bs-target="#carousel<?=$posts[$i]["id"]?>" data-bs-slide-to="<?=$j?>" aria-label="Slide<?=$j?>"></button>
                        <?php } ?>
                    <?php } ?>
                </div>

                <div class="carousel-inner">
                    <?php for($j=0; $j<count($imagesName); $j++) {
                        if($j==0) { ?>
                            <div class="carousel-item active">
                        <?php } else { ?>
                            <div class="carousel-item">
                        <?php } ?>

                        <img width="100%" src="./assets/images/posts/<?=$imagesName[$j]?>">

                        </div>
                    <?php } ?>

                    <?php if(count($imagesName) > 1) { ?>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel<?=$posts[$i]["id"]?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel<?=$posts[$i]["id"]?>" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>

                    <?php } ?>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-body">
                    <?=$posts[$i]["description"]?>
                </div>
            </div>

        </div>
    <?php } ?>
</div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>