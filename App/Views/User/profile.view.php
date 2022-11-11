<?php
    /** @var \App\Core\IAuthenticator $auth */
?>


<div class="container">

    <h1>Editovanie profilu</h1>
    <hr>

    <div class="row">
        <div class="col-md-3">
            <div class="text-center">
                <img src="../../../public/images/profilFotka.jpg" class="profilFotka img-fluid" alt="avatar">
            </div>
        </div>

        <div class="col-md-9 personal-info">
            <h3>Osobné informácie</h3>

            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-lg-3 control-label">Meno:</label>
                    <div class="col-lg-8">
                        <input id="poleMeno" onchange="zmenaStylu(this.id)" class="pouzitePole mb-3 form-control" type="text" value="<?php echo $auth->getLoggedUserName() ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Email:</label>
                    <div class="col-lg-8">
                        <input id="poleEmail" onchange="zmenaStylu(this.id)" class="form-control" type="text" value="<?php echo $auth->getLoggedUserEmail() ?>">
                    </div>
                </div>

                <div class="medzeraStredna">&nbsp;</div>

            <h3 class="mt-5">Heslo
                <svg data-toggle="tooltip" data-placement="top" title="Každá zmena údajov musí byť potvrdená zadaním hesla" id="tooltip-button" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                </svg>
            </h3>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Súčasné heslo:</label>
                    <div class="col-lg-8">
                        <input id="poleStareHeslo" onchange="zmenaStylu(this.id)" class="mb-3 form-control" type="password" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Nové heslo:
                        <svg data-toggle="tooltip" data-placement="top" title="Toto pole vyplňe len v prípade, ak si prajete zmenit Vaše heslo" id="tooltip-button" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                        </svg>
                    </label>
                    <div class="col-md-8">
                        <input id="poleNoveHeslo" onclick="zmenaStylu(this.id)" class="mb-3 form-control" type="password" value="">
                    </div>
                </div>

                <div id="poleNoveHesloPotvrdenieKontajner" class="skryte form-group">
                    <label class="col-md-3 control-label">Potvrdenie nového hesla:</label>
                    <div class="col-md-8">
                        <input id="poleNoveHesloPotvrdenie" onchange="zmenaStylu(this.id)" class="mb-3 form-control" type="password" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                        <input type="button" class=" btn btn-outline-dark col btn-lg btn-block" value="Potvrdiť">
                        <span></span>
                        <input type="reset" class="btn btn-default" value="Zrušiť">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<hr>