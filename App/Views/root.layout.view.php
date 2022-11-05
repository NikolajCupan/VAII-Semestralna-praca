<?php
    /** @var string $contentHTML */
    /** @var \App\Core\IAuthenticator $auth */
?>


<!DOCTYPE html>
<html lang="sk">
    <head>
        <title><?= \App\Config\Configuration::APP_NAME ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="../../public/images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../../public/css/mainStyles.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
                crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
                integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
                crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
                integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk"
                crossorigin="anonymous"></script>
        <script src="../../public/js/script.js"></script>
    </head>

    <body>
        <div class="pasik">
            <a href="?c=home">
                <img class="logo" src="../../public/images/logo.png" alt="logo">
            </a>

            <div class="menuLave d-none d-sm-block">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="?c=home&a=contact">Kontakt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?c=home&a=about">O nás</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?c=articles">Články</a>
                    </li>
                </ul>
            </div>

            <?php
            /** @var \App\Core\IAuthenticator $auth */
            if (!$auth->isLogged()) {
            ?>
                <div class="menuPrave d-none d-sm-block">
                    <ul class="nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Pouzivatel</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= \App\Config\Configuration::LOGIN_URL ?>">Prihlásenie</a></li>
                                <li><a class="dropdown-item" href="?c=auth&a=register">Registrácia</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="?c=home&a=help">Help</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            <?php } else { ?>
                <div class="menuPrave d-none d-sm-block">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="?c=auth&a=logout">Odhlásenie</a>
                        </li>
                    </ul>
                </div>
            <?php } ?>

            <div class="maleMenu d-xs-block d-sm-none">
                <ul class="nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Menu</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?c=home&a=contact">Kontakt</a></li>
                            <li><a class="dropdown-item" href="?c=home&a=about">O nás</a></li>
                            <li><a class="dropdown-item" href="?c=articles">Články</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= \App\Config\Configuration::LOGIN_URL ?>">Prihlásenie</a></li>
                            <li><a class="dropdown-item" href="?c=auth&a=register">Registrácia</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="?c=home&a=help">Help</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>

        <div class="prechodDo"></div>

<!--    zobrazuje obsah stranky-->
        <div class="container-fluid mt-3">
            <div class="web-content">
                <?= $contentHTML ?>
            </div>
        </div>

        <div class="medzeraMala"></div>
        <div class="prechodZ"></div>
        <div class="pasik"></div>
    </body>
</html>