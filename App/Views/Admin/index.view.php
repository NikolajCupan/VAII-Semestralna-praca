<?php
use App\Models\User;

/** @var User[] $data */
?>


<?php foreach ($data as $user) { ?>

    <div class="card my-3" style="width: 500px;">
        <div class="card-body">
            <p class="card-text">
                <?php
                    echo "ID: " . $user->getId() . "; ";
                    echo "Meno: " . $user->getUsername() . "; ";
                    echo "Heslo: " . $user->getPassword() . "; ";
                    echo "Rola: " . $user->getRole();
                ?>
            </p>
        </div>
    </div>

<?php } ?>