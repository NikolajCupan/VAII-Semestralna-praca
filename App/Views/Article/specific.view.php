<?php
use App\Models\Article;
use App\Models\Comment;

/** @var \App\Core\IAuthenticator $auth */
/** @var Array $data */
/** @var Article $article */
/** @var Comment[] $comments */

$article = $data['article'];
$comments = $data['comments'];

?>


<div class="container">

    <h2 class="zalomenieTextu"><?php echo $article->getTitle() ?></h2>
    <hr class="m-2">


    <div class="d-none d-sm-block container">
        <div class="d-flex justify-content-between">
            <div class="hrubyText left"><?php echo $article->getAuthorName() ?></div>
            <div class="hrubyText right"><?php echo $article->getDate() ?></div>
        </div>
    </div>

    <div class="d-sm-none">
        <div class="zalomenieTextu hrubyText left"><?php echo $article->getAuthorName() ?></div>
        <div class="hrubyText right"><?php echo $article->getDate() ?></div>
    </div>

    <hr class="m-2">


    <?php if ($article->getImage() && $article->imageExists()) { ?>
        <img src="<?php echo $article->getImage() ?>" class="clanokFotka img-responsive" alt="image">
        <hr>
    <?php } ?>


    <p style="white-space: pre-line" class="zalomenieTextu"><?php echo $article->getText() ?></p>


    <h4 class="mt-5 zalomenieTextu">Komentáre</h4>
    <hr class="m-2">

    <?php if ($auth->isLogged()) { ?>
        <form name="komentarFormular" onsubmit="return skontrolujZadaneKomentar()" method="post" action="?c=comment&a=postComment" class="form-horizontal">
            <input type="hidden" name="articleId" value="<?php echo $article->getId() ?>">

            <div class="card-footer py-2 border-0">

                <div class="d-flex flex-start w-100">
                    <div class="form-outline w-100">
                        <label style="display: none" for="komentarText"></label>
                        <textarea id="komentarText" name="komentarText" class="form-control" placeholder="Váš komentár" rows="3"></textarea>
                    </div>
                </div>

                <div class="mt-2 pt-1">
                    <input type="submit" name="submit" class="align-middle mb-4 btn btn-outline-dark col btn-sm btn-block" value="Pridať komentár">
                </div>

            </div>
        </form>
    <?php } ?>

    <?php if (count($comments) != 0) { ?>
        <?php foreach (array_reverse($comments) as $comment) { ?>
            <div class="mb-2 rounded-0 card">
                <div class="rounded-0 komentarHlavicka card-header d-flex justify-content-between">
                    <div class="d-none d-md-block float-left">
                        <?php echo $comment->getAuthorName() ?>
                    </div>

                    <div class="d-md-none float-left">
                        <?php echo $comment->getAbbreviatedAuthorName() ?>
                    </div>

                    <div class="float-right">
                        <?php echo $comment->getDate() ?>
                    </div>
                </div>

                <div class="rounded-0 card-body">
                    <?php echo nl2br($comment->getText()) ?>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <!--<p class="komentarZiadne">Článok zatiaľ nemá žiadne komentáre, buďte prvý a pridajte komentár!</p>-->
    <?php } ?>

</div>