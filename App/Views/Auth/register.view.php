<?php
    $layout = 'auth';
    /** @var Array $data */
?>


<link rel="stylesheet" type="text/css" href="../../../public/css/loginStyles.css">

<section class="vh-100">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="ramik card text-black"">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Registrácia</p>

                                <form class="form-signup" method="post" action="?c=auth&a=register">

                                    <div class="text-center text-danger mb-3">
                                        <?= @$data['message'] ?>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="login">Meno</label>
                                            <input type="text" id="login" class="form-control" name="login" required autofocus/>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="email">E-mail</label>
                                            <input type="email" id="email" class="form-control" name="email" required/>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="password">Heslo</label>
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
                                                <button class="loginTlacidlo btn btn-outline-dark col btn-lg btn-block" type="submit" name="submit" role="button">Registrovať</button>
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