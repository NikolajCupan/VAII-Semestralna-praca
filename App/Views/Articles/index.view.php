<?php
use App\Models\Article;

/** @var \App\Core\IAuthenticator $auth */
/** @var Article[] $data */
/** @var int $count */
/** @var Article $article */

$count = count($data);

function getArticle(Article $article)
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

                    <div class="clanokFooter card-footer text-muted d-flex justify-content-between">
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
    <?php for ($i = 0; $i < $count; $i++) { ?>
        <div class=" container">
            <div class="row gx-3">

                <div class="col-4">
                    <?php
                        $article = $data[$i];
                        $i++;
                        echo getArticle($article);
                    ?>
                </div>

                <div class="col-4">
                    <?php
                        if ($i < $count)
                        {
                        $article = $data[$i];
                        echo getArticle($article);
                        }

                        $i++
                    ?>
                </div>

                <div class="col-4">
                    <?php
                        if ($i < $count)
                        {
                            $article = $data[$i];
                            echo getArticle($article);
                        }
                    ?>
                </div>

            </div>
        </div>
    <?php } ?>
</div>


<div class="d-none d-md-block d-lg-none">
    <?php for ($i = 0; $i < $count; $i++) { ?>
        <div class=" container">
            <div class="row gx-2">

                <div class="col-6">
                    <?php
                    $article = $data[$i];
                    $i++;
                    echo getArticle($article);
                    ?>
                </div>

                <div class="col-6">
                    <?php
                    if ($i < $count)
                    {
                        $article = $data[$i];
                        echo getArticle($article);
                    }

                    $i++
                    ?>
                </div>

            </div>
        </div>
    <?php } ?>
</div>


<div class="d-md-none">
    <?php for ($i = 0; $i < $count; $i++) { ?>
        <div class=" container">
            <?php
            $article = $data[$i];
            $i++;
            echo getArticle($article);
            ?>
        </div>
    <?php } ?>
</div>