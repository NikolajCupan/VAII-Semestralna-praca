<?php

use App\Models\Type;

/** @var \App\Core\IAuthenticator $auth */
/** @var Type[] $data */

?>


<div class="container">

    <h2 class="text-left mb-0">Formulár na vytvorenie nového článku</h2>
    <hr>


    <form enctype="multipart/form-data" name="clanokFormular" onsubmit="return skontrolujZadaneClanok()" method="post" action="?c=article&a=postArticle" class="form-horizontal">
        <input type="hidden" name="id" value="<?php echo $auth->getLoggedUserId() ?>">

        <div class="form-group mb-4">
            <label for="clanokNadpis" class="hrubyText mb-2">Nadpis</label>
            <input onkeyup='saveValue(this);' type="text" class="form-control" id="clanokNadpis" name="clanokNadpis" placeholder="Váš nadpis">
        </div>

        <div class="form-group mb-2">
            <label for="clanokText" class="hrubyText mb-2">Text</label>
            <textarea onkeyup='saveValue(this);' class="form-control clanokTextVstup" id="clanokText" name="clanokText" rows="15" placeholder="Váš text"></textarea>
        </div>

        <div class="form-group mb-4">
            <label class="form-label" for="clanokFotka"></label>
            <input type="file" class="form-control" id="clanokFotka" name="clanokFotka">
        </div>

        <div>
            <select class="form-select-md form-select" id="kategoria" name="kategoria" aria-label="select">
                <option selected disabled>Kategória: Nezaradené</option>
                <?php foreach ($data as $type) { ?>
                    <option value="<?php echo $type->getId() ?>"><?php echo $type->getName() ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
                <input type="submit" name="submit" class="btn btn-outline-dark col btn-lg btn-block" value="Potvrdiť">
                <span></span>
                <a type="button" onclick="obnov()" class="btn btn-default">Reset</a>
            </div>
        </div>

    </form>
</div>


<script>
    document.getElementById("clanokText").value = getSavedValue("clanokText");
    document.getElementById("clanokNadpis").value = getSavedValue("clanokNadpis");

    function saveValue(e)
    {
        var id = e.id;
        var val = e.value;
        sessionStorage.setItem(id, val);
    }

    function getSavedValue (v)
    {
        if (!sessionStorage.getItem(v))
        {
            return "";
        }
        return sessionStorage.getItem(v);
    }


    $("#clanokFotka").on("change", function (e) {
        let subor = e.currentTarget.files[0];

        let filesize = ((subor.size / 1024) / 1024).toFixed(4); // MB

        if (filesize > 2)
        {
            $(this).val("");
            alert("Maximalna velkost fotky je 2MB!");
        }
    });


    function obnov()
    {
        sessionStorage.clear();
        location.reload();
    }
</script>