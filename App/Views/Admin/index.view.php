<?php
use App\Models\User;

/** @var User[] $data */
?>


<?php foreach ($data as $user) { ?>

    <div class="card pouzivatel" style="width: 30rem;">
        <div class="card-body">
            <div class="container px-4 text-center">
                <div class="row g-0 text-center">
                    <div class="col-sm-6 col-md-8">
                        <div class="p-3">
                            <h5 class="card-title">Pouzivatel s ID <?php echo $user->getId() ?></h5>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="p-3">
                            <a href="?c=admin&a=delete&id=<?php echo $user->getId() ?>" class="deleteUser card-link">Vymazat</a>
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
            <div class="row gx-5">
                <div class="col">
                    <div class="p-3">
                        <select class="form-select" aria-label="vyber role">
                            <option selected>Zmena role</option>
                            <option value="1">Pouzivatel: u</option>
                            <option value="2">Administrator: a</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="p-3">
                        <a href="?c=admin&modify&id=<?php echo $user->getId() ?>" class="loginTlacidlo btn btn-outline-dark col btn-md btn-block" role="button">Potvrdit</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php } ?>

<div class="medzeraVelka"></div>