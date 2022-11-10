<?php
    $layout = 'auth';
    /** @var Array $data */
?>


<link rel="stylesheet" type="text/css" href="../../../public/css/loginStyles.css">
<link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css”/>

<section class="vh-100">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="ramik card text-black">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Registrácia</p>

                                <form class="form-signup" method="post" action="?c=auth&a=register">

                                    <div class="text-center text-danger mb-3">
                                        <p><?= @$data['message'] ?>&nbsp;</p>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col inputPolicko">
                                                        <label class="form-label" for="login">Meno</label>
                                                    </div>

                                                    <div class="col inputPolicko tooltip-container" style="text-align: right">
                                                        <svg data-toggle="tooltip" data-placement="top" title="Meno moze mat maximalne 30 znakov" id="tooltip-button" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>

                                            <input value="<?php echo isset($_POST['login']) ? htmlspecialchars($_POST['login'], ENT_QUOTES) : ''; ?>" type="text" id="login" class="form-control" name="login" required/>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col inputPolicko">
                                                        <label class="form-label" for="email">E-mail</label>
                                                    </div>

                                                    <div class="col inputPolicko tooltip-container" style="text-align: right">
                                                        <svg data-toggle="tooltip" data-placement="top" title="Email moze mat maximalne 75 znakov" id="tooltip-button" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>

                                            <input value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : ''; ?>" type="email" id="email" class="form-control" name="email" required/>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col inputPolicko">
                                                        <label class="form-label" for="password">Heslo</label>
                                                    </div>

                                                    <div class="col inputPolicko tooltip-container" style="text-align: right">
                                                        <svg data-toggle="tooltip" data-placement="top" title="Heslo musi mat minimalne 6 znakov a obsahovat aspon 1 cislo, heslo moze mat maximalne 50 znakov" id="tooltip-button" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="password" id="password" class="form-control" name="password" required/>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="passwordVerify">Potvrdenie hesla</label>
                                            <input type="password" id="passwordVerify" class="form-control" name="passwordVerify" required/>
                                        </div>
                                    </div>

                                    <div class="container text-center">
                                        <div class="row">
                                            <div class="col">
                                                <button class="loginTlacidlo btn btn-outline-dark col btn-lg btn-block" type="submit" name="submit">Registrovať</button>
                                            </div>

                                            <div class="col">
                                                <a href="?c=home" class="loginTlacidlo btn btn-outline-dark col btn-lg btn-block" role="button">Domov</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                            <img src="../../../public/images/registerFotka.jpg" class="img-fluid" alt="fotka">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>