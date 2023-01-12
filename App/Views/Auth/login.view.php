<?php
    $layout = 'auth';
    /** @var Array $data */
?>


<script src="../../../public/js/login.js"></script>

<div class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">

            <div class="col-md-8 col-lg-7 col-xl-6">
                <img src="../../../public/images/loginFotka.jpg" class="img-fluid" alt="fotka">
            </div>

            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <form class="form-signin" method="post" action="<?= \App\Config\Configuration::LOGIN_URL ?>">

                    <div id="chybaPrihlasenie" class="text-center text-danger mb-3">

                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="login">Zadajte meno</label>
                        <input type="text" id="login" class="form-control form-control-lg" name="login" placeholder="Meno" required autofocus>
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="password">Zadajte heslo</label>
                        <input type="password" id="password" class="form-control form-control-lg" name="password" placeholder="******" required>
                    </div>

                    <div class="container text-center">
                        <div class="row">
                            <div class="col">
                                <button id="loginTlacidlo" class="btn btn-outline-dark col btn-lg btn-block" type="submit" name="submit">Prihlásiť</button>
                            </div>
                            <div class="col">
                                <a href="?c=home" class="loginTlacidlo btn btn-outline-dark col btn-lg btn-block" role="button">Domov</a>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>