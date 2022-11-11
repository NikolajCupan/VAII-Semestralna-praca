$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

function zmenaStylu(id) {
    let element = document.getElementById(id);

    element.style.backgroundColor = "#d7d7d7";
    element.style.fontWeight = "bold";

    if (id == "poleNoveHeslo")
    {
        let viditelnost = window.getComputedStyle(document.querySelector('#poleNoveHesloPotvrdenieKontajner')).visibility;

        if (viditelnost == "hidden")
        {
            $('#poleNoveHesloPotvrdenieKontajner').css('visibility', 'visible').hide().fadeIn();
        }
    }
}