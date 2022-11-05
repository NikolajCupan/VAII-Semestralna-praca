<?php
    $layout = 'auth';
    /** @var Array $data */
?>


<!--
<div class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Prihlásenie</h5>
                        <div class="text-center text-danger mb-3">
                            <?= @$data['message'] ?>
                        </div>
                        <form class="form-signin" method="post" action="<?= \App\Config\Configuration::LOGIN_URL ?>">
                            <div class="form-label-group mb-3">
                                <input name="login" type="text" id="login" class="form-control" placeholder="Login"
                                       required autofocus>
                            </div>

                            <div class="form-label-group mb-3">
                                <input name="password" type="password" id="password" class="form-control"
                                       placeholder="Password" required>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary" type="submit" name="submit">Prihlásiť
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
-->


<div class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">

            <div class="col-md-8 col-lg-7 col-xl-6">
                <img src="../../../public/images/loginFotka.jpg" class="img-fluid" alt="fotka">
            </div>

            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <form class="form-signin" method="post" action="<?= \App\Config\Configuration::LOGIN_URL ?>">

                    <div class="form-outline mb-4">
                        <label class="form-label" for="login">Zadajte meno</label>
                        <input type="text" id="login" class="form-control form-control-lg" name="login" required autofocus>
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="password">Zadajte heslo</label>
                        <input type="password" id="password" class="form-control form-control-lg" name="password" required>
                    </div>

                    <div class="container text-center">
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-outline-dark col btn-lg btn-block" type="submit" name="submit" role="button">Prihlásiť sa</button>
                            </div>
                            <div class="text-center text-danger mb-3">
                                <?= @$data['message'] ?>
                            </div>
                        </div>
                    </div>

                    <!--
                    <div class="text-center text-danger mb-3">
                        <button class="btn btn-outline-dark col btn-lg btn-block" type="submit" name="submit" role="button">Prihlásiť sa</button>
                        <?= @$data['message'] ?>
                    </div>
                    -->

                </form>
            </div>
        </div>
    </div>
</div>