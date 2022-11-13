<?php
use App\Models\User;

/** @var \App\Core\IAuthenticator $auth */
/** @var User[] $data */
?>

<table class="center table table-striped">
    <thead class="table-dark">
        <tr>
            <th style="width: 6%" scope="col">ID</th>
            <th style="width: 35%" scope="col">Meno</th>
            <th style="width: 35%" scope="col">Email</th>
            <th style="width: 10%" scope="col">Rola</th>
            <th style="width: 7%" scope="col">Potvrdenie</th>
            <th style="width: 7%" scope="col">Vymazat</th>
        </tr>
    </thead>

    <tbody>

    <?php foreach ($data as $user) { ?>

        <tr>
            <th scope="row"><?php echo $user->getId() ?></th>
            <td><?php echo $user->getUsername() ?></td>
            <td><?php echo $user->getEmail() ?></td>

            <?php if ($user->getId() != $auth->getLoggedUserId()) { ?>
                <form method="post" action="?c=admin&a=modify">

                    <?php /** @var \App\Models\User $data */
                    if ($user->getId()) { ?>
                        <input type="hidden" name="id" value="<?php echo $user->getId() ?>">
                    <?php } ?>

                    <td>
                        <div class="inline-block-child">
                            <select onchange="zmenaStyluTabulka(<?php echo $user->getId() ?>)" class="form-select-sm form-select" name="rola" aria-label="select">
                                <option selected disabled>Rola</option>
                                <option value="u">u</option>
                                <option value="a">a</option>
                            </select>
                        </div>
                    </td>

                    <td>
                        <input disabled value="✓" type="submit" id="<?php echo $user->getId() ?>" class="modifyUser card-link">
                    </td>

                    <td>
                        <a href="?c=admin&a=delete&id=<?php echo $user->getId() ?>" class="deleteUser card-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </a>
                    </td>

                </form>
            <?php } else { ?>
                <td>
                    <div class="inline-block-child">
                        <select class="form-select-sm form-select" name="rola" aria-label="Disabled" disabled>
                            <option value="u">u</option>
                            <option selected value="a">a</option>
                        </select>
                    </div>
                </td>

                <td></td>
                <td></td>
            <?php } ?>

        </tr>

    <?php } ?>

    </tbody>
</table>