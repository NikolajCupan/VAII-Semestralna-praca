class Login
{
    constructor()
    {
        this.vypis = document.getElementById('chybaPrihlasenie');
        this.vypis.innerHTML = `
            <div>
                &nbsp
            </div>
        `;

        this.meno = document.getElementById('login');
        this.password = document.getElementById('password');
        this.login = document.getElementById('loginTlacidlo');

        this.login.onclick = (event) => {
            event.preventDefault();
            this.tryToLogin();
        };
    }


    async nacitajChybu(chybaText)
    {
        this.vypis.innerHTML = `
                <div>
                    ${chybaText.message}
                </div>         
            `;
    }


    async tryToLogin()
    {
        let response = await fetch('?c=auth&a=tryToLogin', {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            method: "POST",
            body: `meno=${this.meno.value}&heslo=${this.password.value}`
        });

        let data = await response.json();
        if (data.message === '&nbsp')
        {
            window.location.href = "?c=home";
        }
        await this.nacitajChybu(data);
    }
}


var login;

window.onload = async function()
{
    login = new Login();
};