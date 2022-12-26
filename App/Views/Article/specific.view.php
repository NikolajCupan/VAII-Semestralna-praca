<?php
use App\Models\Article;

/** @var \App\Core\IAuthenticator $auth */
/** @var Article $data */

?>


<div class="container">

    <h2 class="zalomenieTextu"><?php echo $data->getTitle() ?></h2>
    <hr class="m-2">


    <div class="d-none d-sm-block container">
        <div class="d-flex justify-content-between">
            <div class="hrubyText left"><?php echo $data->getAuthorName() ?></div>
            <div class="hrubyText right"><?php echo $data->getDate() ?></div>
        </div>
    </div>

    <div class="d-sm-none">
        <div class="zalomenieTextu hrubyText left"><?php echo $data->getAuthorName() ?></div>
        <div class="hrubyText right"><?php echo $data->getDate() ?></div>
    </div>

    <hr class="m-2">


    <?php if ($data->getImage()) { ?>
        <img src="<?php echo $data->getImage() ?>" class="clanokFotka img-responsive" alt="image">
        <hr>
    <?php } ?>


    <p class="zalomenieTextu"><?php echo $data->getText() ?></p>
</div>
