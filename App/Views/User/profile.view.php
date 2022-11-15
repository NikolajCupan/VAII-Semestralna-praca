<?php
    /** @var \App\Core\IAuthenticator $auth */
    /** @var Array $data */
?>


<div class="container">

    <h1>Editovanie profilu</h1>
    <hr>

    <div class="row">
        <div class="col-md-3">
            <div class="text-center">
                <img src="../../../public/images/profilFotka.jpg" class="mb-3 profilFotka img-fluid" alt="avatar">
                <div class="text-center text-danger mb-3">
                    <p><?= @$data['message'] ?>&nbsp;</p>
                </div>
            </div>
        </div>

        <div class="col-md-9 personal-info">
            <h3>Osobné informácie</h3>

            <form name="profilFormular" onsubmit="return skontrolujZadane()" method="post" action="?c=user&a=editProfile" class="form-horizontal">
                <input type="hidden" name="id" value="<?php echo $auth->getLoggedUserId() ?>">

                <div class="form-group">
                    <label for="poleMeno" class="col-lg-3 control-label">Meno:</label>
                    <div class="col-lg-8">
                        <input name="poleMeno" id="poleMeno" onchange="zmenaStyluProfil(this.id)" class="poleVstup mb-3 form-control" type="text" value="<?php echo $auth->getLoggedUserName() ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="poleEmail" class="col-lg-3 control-label">Email:</label>
                    <div class="col-lg-8">
                        <input name="poleEmail" id="poleEmail" onchange="zmenaStyluProfil(this.id)" class="poleVstup form-control" type="email" value="<?php echo $auth->getLoggedUserEmail() ?>">
                    </div>
                </div>

                <div class="medzeraStredna">&nbsp;</div>

            <h3 class="mt-5">Heslo
                <img alt="?" src="../../../public/images/otaznikIkonka.png" data-toggle="tooltip" data-placement="top" title="Každá zmena údajov musí byť potvrdená zadaním hesla" width="16" height="16" class="bi bi-question-circle">
            </h3>

                <div class="form-group">
                    <label for="poleStareHeslo" class="col-lg-3 control-label">Súčasné heslo:</label>
                    <div class="col-lg-8">
                        <input name="poleStareHeslo" id="poleStareHeslo" onchange="zmenaStyluProfil(this.id)" class="poleVstup mb-3 form-control" type="password" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="poleNoveHeslo" class="col-lg-3 control-label">Nové heslo:
                        <img alt="?" src="../../../public/images/otaznikIkonka.png" data-toggle="tooltip" data-placement="top" title="Toto pole vyplňe len v prípade, ak si prajete zmenit Vaše heslo" width="16" height="16" class="bi bi-question-circle">
                    </label>
                    <div class="col-lg-8">
                        <input name="poleNoveHeslo" id="poleNoveHeslo" onchange="zmenaStyluProfil(this.id)" onfocus="zobrazPole(this.id)" class="poleVstup mb-3 form-control" type="password" value="">
                    </div>
                </div>

                <div id="poleNoveHesloPotvrdenieKontajner" class="poleVstup skryte form-group">
                    <label for="poleNoveHesloPotvrdenie" class="col-lg-3 control-label">Potvrdenie nového hesla:</label>
                    <div class="col-lg-8">
                        <input name="poleNoveHesloPotvrdenie" id="poleNoveHesloPotvrdenie" onchange="zmenaStyluProfil(this.id)" class="mb-3 form-control" type="password" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                        <input type="submit" name="submit" class="btn btn-outline-dark col btn-lg btn-block" value="Potvrdiť">
                        <span></span>
                        <input onclick="obnovStranku()" type="reset" class="btn btn-default" value="Zrušiť">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>