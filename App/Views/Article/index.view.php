<?php
use App\Models\Article;

/** @var \App\Core\IAuthenticator $auth */
/** @var Article[] $data */
/** @var int $count */
/** @var Article $article */

$count = count($data);

?>


<?php

    function getHasPermissionToManage(Article $article, \App\Core\IAuthenticator $auth) : bool
    {
        if (!$auth->isLogged())
        {
            return false;
        }

        if ($auth->getLoggedUserRole() == 'a')
        {
            return true;
        }

        if ($auth->getLoggedUserRole() == 'b')
        {
            if ($article->getAuthor() == $auth->getLoggedUserId())
            {
                return true;
            }
        }

        return false;
    }

    function getArticle(Article $article, \App\Core\IAuthenticator $auth)
    {
    ob_start();

    ?>


    <div class="mb-4 container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <?php if ($article->getImage() && $article->imageExists()) { ?>
                        <img src="<?php echo $article->getImage() ?>" class="card-img-top" alt="image">
                    <?php } else { ?>
                        <img src="../../../public/articles/missing.jpg" class="card-img-top" alt="image">
                    <?php } ?>

                    <div class="card-body">
                        <h5 class="card-title"><?php echo $article->getTitle() ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $article->getAuthorName() ?></h6>
                        <p class="card-text"><?php echo $article->getAbbreviatedText() ?></p>
                    </div>


                    <div class="clanokNultyFooter card-footer text-muted">
                        <?php echo $article->getTypeName() ?>
                    </div>


                    <div class="clanokPrvyFooter card-footer text-muted d-flex justify-content-between">
                        <div class="float-left">
                            <?php if ($auth->isLogged()) { ?>
                                <?php if ($article->hasLikeFromUser($auth->getLoggedUserId())) { ?>
                                    <a class="clanokLiked" href="?c=article&a=cancelLike&articleId=<?php echo $article->getId() ?>" class="clanokLikes">🖤 <?php echo $article->getLikesCount() ?> likes</a>
                                <?php } else { ?>
                                    <a class="clanokToBeLiked" href="?c=article&a=like&articleId=<?php echo $article->getId() ?>" class="clanokLikes">🤍 <?php echo $article->getLikesCount() ?> likes</a>
                                <?php } ?>
                            <?php } else { ?>
                                <p class="clanokLikes"><?php echo $article->getLikesCount() ?> likes</p>
                            <?php } ?>
                        </div>

                        <div class="float-right">
                            <?php if (getHasPermissionToManage($article, $auth)) { ?>
                                <a type="button" href="?c=article&a=modify&articleId=<?php echo $article->getId() ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                    </svg>
                                </a>

                                <a type="button" data-id="<?php echo $article->getId() ?>" class="deleteArticle card-link" data-bs-toggle="modal" data-bs-target="#modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </a>
                            <?php } ?>
                        </div>
                    </div>


                    <div class="clanokDruhyFooter card-footer text-muted d-flex justify-content-between">
                        <div class="clanokDatum float-left"><?php echo $article->getDate() ?></div>

                        <div class="float-right">
                            <a class="clanok nav-link" href="?c=article&a=specific&articleId=<?php echo $article->getId() ?>">Celý článok</a>
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
        <?php if ($auth->getLoggedUserRole() == "a" || $auth->getLoggedUserRole() == "b") { ?>
            <a style="margin-left: 12px" class="align-middle mb-4 btn btn-outline-dark col btn-lg btn-block" href="?c=article&a=create">Nový</a>
        <?php } ?>
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


<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Zmazanie článku</h5>
            </div>

            <div class="modal-body">
                Článok po zmazaní nie je možné obnoviť. Naozaj si prajete vykonať akciu?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Zrušiť</button>
                <a name="articleId" id="articleId" href="" type="button" class="btn btn-danger">Zmazať</a>
            </div>
        </div>
    </div>
</div>