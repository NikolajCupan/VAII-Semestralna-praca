function odpocet()
{
    var timer = setTimeout(function()
    {
        window.location='?c=home'
    }, 5000);

    let opakovanie = 4;

    let interval = setInterval(function() {
        document.getElementById("odpocet").textContent = opakovanie;

        if (opakovanie > 0) {
            opakovanie--;
        }
        else {
            clearInterval(interval);
        }
    }, 1000);
}

window.onload = odpocet;