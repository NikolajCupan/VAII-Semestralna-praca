<?php
    /** @var \App\Core\IAuthenticator $auth */
    /** @var Array $data */
?>


<div class="container">

    <h2 class="text-left mb-0">Formulár na modifikovanie existujúceho článku</h2>
    <hr>


    <div class="text-center text-danger mb-3">
        <p><?= @$data['message'] ?>&nbsp;</p>
    </div>


    <form enctype="multipart/form-data" name="clanokFormular" onsubmit="return skontrolujZadaneClanok()" method="post" action="?c=article&a=updateArticle" class="form-horizontal">
        <input type="hidden" name="id" value="<?php echo $auth->getLoggedUserId() ?>">
        <input type="hidden" name="articleId" value="<?php echo $data['article']->getId() ?>">

        <div class="form-group mb-4">
            <label for="clanokNadpis" class="hrubyText mb-2">Nadpis</label>
            <input type="text" class="form-control" id="clanokNadpis" name="clanokNadpis" value="<?php echo $data['article']->getTitle() ?>">
        </div>

        <div class="form-group mb-2">
            <label for="clanokText" class="hrubyText mb-2">Text</label>
            <textarea class="form-control clanokTextVstup" id="clanokText" name="clanokText" rows="15"><?php echo $data['article']->getText() ?></textarea>
        </div>

        <?php if ($data['article']->getImage() && $data['article']->imageExists()) { ?>
            <div class="form-group mt-4 mb-4">
                <a type="button" href="?c=article&a=deletePhoto&articleId=<?php echo $data['article']->getId() ?>">
                    <label class="hrubyText clanokZmazanieFotky form-label mb-2" for="clanokFotka">Zmazať aktuálnu fotku</label>
                </a>
                <img src="<?php echo $data['article']->getImage() ?>" class="mx-0 mt-0 float-left clanokFotka img-responsive" alt="image">
            </div>
        <?php } else { ?>
            <div class="form-group mb-4">
                <label class="form-label" for="clanokFotka"></label>
                <input type="file" class="form-control" id="clanokFotka" name="clanokFotka">
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
                <input type="submit" name="submit" class="btn btn-outline-dark col btn-lg btn-block" value="Potvrdiť">
                <span></span>
                <a type="button" href="?c=article&a=modify&articleId=<?php echo $data['article']->getId() ?>" class="btn btn-default">Obnoviť</a>
            </div>
        </div>

    </form>
</div>