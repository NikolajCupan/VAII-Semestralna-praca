<?php
use App\Models\Article;

/** @var \App\Core\IAuthenticator $auth */
/** @var Article[] $data */
/** @var int $count */
/** @var Article $article */

$count = count($data);

?>


<?php

    function getArticle(Article $article, \App\Core\IAuthenticator $auth)
    {
    ob_start();

    ?>

    <div class="mb-4 container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <?php if ($article->getImage()) { ?>
                        <img src="<?php echo $article->getImage() ?>" class="card-img-top" alt="image">
                    <?php } else { ?>
                        <img src="../../../public/articles/missing.jpg" class="card-img-top" alt="image">
                    <?php } ?>

                    <div class="card-body">
                        <h5 class="card-title"><?php echo $article->getTitle() ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $article->getAuthorName() ?></h6>
                        <p class="card-text"><?php echo $article->getAbbreviatedText() ?></p>
                    </div>


                    <div class="clanokPrvyFooter card-footer text-muted">
                        <?php if ($auth->isLogged()) { ?>
                            <?php if ($article->hasLikeFromUser($auth->getLoggedUserId())) { ?>
                                <a class="clanokLiked" href="?c=articles&a=cancelLike&articleId=<?php echo $article->getId() ?>" class="clanokLikes">🖤 <?php echo $article->getLikesCount() ?> likes</a>
                            <?php } else { ?>
                                <a class="clanokToBeLiked" href="?c=articles&a=like&articleId=<?php echo $article->getId() ?>" class="clanokLikes">🤍 <?php echo $article->getLikesCount() ?> likes</a>
                            <?php } ?>
                        <?php } else { ?>
                            <p class="clanokLikes"><?php echo $article->getLikesCount() ?> likes</p>
                        <?php } ?>
                    </div>


                    <div class="clanokDruhyFooter card-footer text-muted d-flex justify-content-between">
                        <div class="clanokDatum float-left"><?php echo $article->getDate() ?></div>

                        <div class="float-right">
                            <a class="clanok nav-link" href="?c=home&a=about">Cely clanok</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

$content = ob_get_clean();
return $content;
}

?>


<div class="d-none d-lg-block">
    <div class="container">
        <div class="row gx-3">

            <?php
            for ($i = 0; $i < $count; $i++) { ?>
            <div class="col-4">
                <?php $article = $data[$i]; ?>
                        <?php echo getArticle($article, $auth); ?>
            </div>
            <?php } ?>

        </div>
    </div>
</div>


<div class="d-none d-md-block d-lg-none">
    <div class="container">
        <div class="row gx-2">

            <?php for ($i = 0; $i < $count; $i++) { ?>
            <div class="col-6">
                <?php $article = $data[$i]; ?>
                    <?php echo getArticle($article, $auth); ?>
            </div>
            <?php } ?>

        </div>
    </div>
</div>


<div class="d-md-none">
    <div class="container">

        <?php for ($i = 0; $i < $count; $i++) { ?>
            <?php $article = $data[$i]; ?>
            <?php echo getArticle($article, $auth); ?>
        <?php } ?>

    </div>
</div>