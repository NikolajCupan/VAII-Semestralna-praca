<?php
use App\Models\Article;
use App\Models\Comment;

/** @var \App\Core\IAuthenticator $auth */
/** @var Article $data */

?>


<script src="../../../public/js/comments.js"></script>

<div class="container">

    <h2 class="zalomenieTextu"><?php echo $data->getTitle() ?></h2>
    <hr class="m-2">


    <div class="d-none d-sm-block container">
        <div class="d-flex justify-content-between">
            <div class="hrubyText left"><?php echo $data->getAuthorName() ?></div>
            <div class="hrubyText right"><?php echo $data->getDate() ?></div>
        </div>

        <hr class="m-2">

        <div class="hrubyText right"><?php echo $data->getTypeName() ?></div>
    </div>

    <div class="d-sm-none">
        <div class="zalomenieTextu hrubyText left"><?php echo $data->getAuthorName() ?></div>
        <div class="hrubyText right"><?php echo $data->getDate() ?></div>

        <hr class="m-2">

        <div class="hrubyText right"><?php echo $data->getTypeName() ?></div>
    </div>


    <?php if ($data->getImage() && $data->imageExists()) { ?>
        <img src="<?php echo $data->getImage() ?>" class="clanokFotka img-responsive" alt="image">
        <hr>
    <?php } ?>


    <p style="white-space: pre-line" class="mt-2 zalomenieTextu"><?php echo $data->getText() ?></p>


    <h4 class="mt-5 zalomenieTextu">Komentáre</h4>
    <hr class="m-2">

    <div>
        <input type="hidden" name="articleId" id="articleId" value="<?php echo $data->getId() ?>">

        <?php if ($auth->isLogged()) { ?>
            <div class="card-footer py-2 border-0">

                <div class="d-flex flex-start w-100">
                    <div class="form-outline w-100">
                        <label style="display: none" for="komentarText"></label>
                        <textarea id="komentarText" name="komentarText" class="form-control" placeholder="Váš komentár" rows="3"></textarea>
                    </div>
                </div>

                <div class="mt-2 pt-1">
                    <input id="createComment" type="submit" name="submit" class="align-middle mb-4 btn btn-outline-dark col btn-sm btn-block" value="Pridať komentár">
                </div>

            </div>
        <?php } ?>
    </div>

    <div id="comments">

    </div>
</div>