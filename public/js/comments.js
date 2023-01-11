class Comments
{
    constructor()
    {
        this.comments = document.getElementById('comments');
        this.commentText = document.getElementById('komentarText');
        this.articleId = document.getElementById('articleId');
        this.createComment = document.getElementById('createComment');

        if (this.createComment != null)
        {
            this.createComment.onclick = () => this.sendComment();
        }
    }


    async loadComments()
    {
        let response = await fetch('?c=comment&a=getArticleComments&articleId=' + this.articleId.value);
        let data = await response.json();

        this.comments.innerHTML = "";

        data.reverse().forEach(comment =>
        {
            this.comments.innerHTML += `
            <div class="mb-2 rounded-0 card">
                <div class="rounded-0 komentarHlavicka card-header d-flex justify-content-between">
                    <div class="d-none d-md-block float-left">
                        ${comment.userName}
                    </div>

                    <div class="d-md-none float-left">
                        ${comment.abbreviatedUserName}
                    </div>

                    <div class="float-right">
                        ${comment.date}
                    </div>
                </div>

                <div class="rounded-0 card-body">
                    ${comment.text}
                </div>
            </div>                
            `;
        });

        setTimeout(() =>
        {
            this.loadComments();
        }, 1000);
    }


    async sendComment()
    {
        if (skontrolujZadaneKomentar(this.commentText))
        {
            location.reload();

            let response = await fetch('?c=comment&a=createComment', {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                method: "POST",
                body: `komentarText=${this.commentText.value}&articleId=${this.articleId.value}`
            });
        }
    }
}


var comments;

window.onload = function()
{
    comments = new Comments();
    comments.loadComments();
};


function skontrolujZadaneKomentar(commentText)
{
    let text = commentText.value;

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