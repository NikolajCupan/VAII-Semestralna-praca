<?php
    /** @var \App\Core\IAuthenticator $auth */
    /** @var Array $data */
?>


<div class="container">

    <h2 class="text-left mb-0">Formular na vytvorenie noveho clanku</h2>
    <hr>


    <div class="text-center text-danger mb-3">
        <p><?= @$data['message'] ?>&nbsp;</p>
    </div>


    <form enctype="multipart/form-data" name="clanokFormular" onsubmit="return skontrolujZadaneClanok()" method="post" action="?c=article&a=postArticle" class="form-horizontal">
        <input type="hidden" name="id" value="<?php echo $auth->getLoggedUserId() ?>">

        <div class="form-group mb-4">
            <label for="clanokNadpis" class="hrubyText mb-2">Nadpis</label>
            <input onkeyup='saveValue(this);' type="text" class="form-control" id="clanokNadpis" name="clanokNadpis" placeholder="Vas nadpis">
        </div>

        <div class="form-group mb-2">
            <label for="clanokText" class="hrubyText mb-2">Text</label>
            <textarea onkeyup='saveValue(this);' class="form-control clanokTextVstup" id="clanokText" name="clanokText" rows="15" placeholder="Vas text"></textarea>
        </div>

        <div class="form-group mb-4">
            <label class="form-label" for="clanokFotka"></label>
            <input type="file" class="form-control" id="clanokFotka" name="clanokFotka">
        </div>

        <input type="submit" name="submit" class="btn btn-outline-dark col btn-lg btn-block" value="Potvrdiť">
    </form>
</div>


<script>
    document.getElementById("clanokText").value = getSavedValue("clanokText");
    document.getElementById("clanokNadpis").value = getSavedValue("clanokNadpis");

    function saveValue(e)
    {
        var id = e.id;
        var val = e.value;
        localStorage.setItem(id, val);
    }

    function getSavedValue (v)
    {
        if (!localStorage.getItem(v))
        {
            return "";
        }
        return localStorage.getItem(v);
    }

    window.onpaint = vymazStorage();

    function vymazStorage()
    {
        localStorage.clear();
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
</script>