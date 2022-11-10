<?php
use App\Models\User;

/** @var \App\Core\IAuthenticator $auth */
/** @var User[] $data */
?>


<?php foreach ($data as $user) { ?>

    <div class="card pouzivatel" style="width: 30rem;">
        <div class="card-body">
            <div class="container-fluid px-4 text-center">
                <div class="row g-0 text-center">
                    <div class="col-sm-6 col-md-8">
                        <div class="p-3">
                            <h5 class="card-title">Pouzivatel s ID <?php echo $user->getId() ?></h5>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="p-3">
                            <?php if ($user->getId() != $auth->getLoggedUserId()) { ?>
                                <a href="?c=admin&a=delete&id=<?php echo $user->getId() ?>" class="deleteUser card-link">Vymazat</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <ul class="list-group list-group-flush">
            <li class="list-group-item"><span class="hrubyText">Meno: </span><?php echo $user->getUsername() ?></li>
            <li class="list-group-item"><span class="hrubyText">E-mail: </span><?php echo $user->getEmail() ?></li>
            <li class="list-group-item"><span class="hrubyText">Rola: </span><?php echo $user->getRole() ?></li>
        </ul>

        <div class="container overflow-hidden text-center">
            <form method="post" action="?c=admin&a=modify">
                <?php /** @var \App\Models\User $data */
                if ($user->getId()) { ?>
                    <input type="hidden" name="id" value="<?php echo $user->getId() ?>">
                <?php } ?>

                <div>
                    <div class="inline-block-child">
                        <select class="form-select" name="rola" aria-label="Default select example">
                            <option selected>Zmena role</option>
                            <option value="u">Pouzivatel: u</option>
                            <option value="a">Administrator: a</option>
                        </select>
                    </div>

                    <div class="inline-block-child">
                        <?php if ($user->getId() != $auth->getLoggedUserId()) { ?>
                            <input type="submit" value="Potvrdit" class="submitTlacidlo btn btn-outline-dark col btn-md btn-block">
                        <?php } else { ?>
                            <input disabled type="submit" value="Potvrdit" class="submitTlacidlo btn btn-outline-dark col btn-md btn-block">
                        <?php } ?>
                    </div>
                </div>
            </form>
        </div>

    </div>

<?php } ?>