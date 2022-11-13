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