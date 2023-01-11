$(function ()
{
    $('[data-toggle="tooltip"]').tooltip()
})


function zmenaStyluProfil(id)
{
    let element = document.getElementById(id);

    element.style.backgroundColor = "#d7d7d7";
    element.style.fontWeight = "bold";
}

function zobrazPole(id)
{
    if (id === "poleNoveHeslo")
    {
        let viditelnost = window.getComputedStyle(document.querySelector('#poleNoveHesloPotvrdenieKontajner')).visibility;

        if (viditelnost === "hidden")
        {
            $('#poleNoveHesloPotvrdenieKontajner').css('visibility', 'visible').hide().fadeIn();
        }
    }
}

function obnovStranku()
{
    let elements = document.getElementsByClassName('poleVstup');

    for (let element of elements)
    {
        element.style.backgroundColor = "white";
        element.style.fontWeight = "normal";

        if (element.id === 'poleNoveHesloPotvrdenieKontajner')
        {
            element.style.visibility = "hidden";
        }
    }
}

function zmenaStyluTabulka(id)
{
    let element = document.getElementById(id);
    element.style.pointerEvents = "all";
    element.style.color = "black";
    element.disabled = false;
}

function skontrolujZadane()
{
    let email = document.forms["profilFormular"]["poleEmail"].value;
    let meno = document.forms["profilFormular"]["poleMeno"].value;
    let heslo = document.forms["profilFormular"]["poleStareHeslo"].value;

    if (meno === "")
    {
        alert("Meno musi byt vyplnene!");
        return false;
    }
    else if (email === "")
    {
        alert("Email musi byt vyplneny!");
        return false;
    }
    else if (heslo === "")
    {
        alert("Sucasne heslo musi byt vyplnene!");
        return false;
    }

    skontrolujEmail(email);
}

function skontrolujEmail(email = null)
{
    if (email == null)
    {
        email = document.forms["registerFormular"]["email"].value;
    }

    if (validujEmail(email) === null)
    {
        alert("Email je neplatny!");
        return false;
    }
}

const validujEmail = (email) => {
    return email.match(
        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
};

$(document).on("click", ".deleteArticle", function () {
    var articleId = "?c=article&a=delete&articleId=" + $(this).data('id');
    $(".modal-footer #articleId").attr("href", articleId);
});

function skontrolujZadaneClanok()
{
    let nadpis = document.forms["clanokFormular"]["clanokNadpis"].value;
    let text = document.forms["clanokFormular"]["clanokText"].value;

    if (nadpis === "")
    {
        alert("Nadpis musí byť zadaný!");
        return false;
    }
    else if (text === "")
    {
        alert("Text musí byť zadaný!");
        return false;
    }

    return true;
}

function skontrolujZadaneKomentar()
{
    let text = document.forms["komentarFormular"]["komentarText"].value;

    if (text.length < 5)
    {
        alert("Komentár musí obshovať aspoň 5 znakov!");
        return false;
    }
    else if (text.length > 500)
    {
        alert("Komentár nemôže obsahovať viac ako 500 znakov!");
        return false;
    }

    return true;
}