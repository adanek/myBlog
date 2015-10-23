function showForm() {
    var form = document.getElementById('form-comment');
    form.classList.remove('hidden');

    var btn = document.getElementById('btn-form-show');
    btn.classList.add('hidden');
}

function hideForm() {
    var form = document.getElementById('form-comment');
    form.classList.add('hidden');

    var btn = document.getElementById('btn-form-show');
    btn.classList.remove('hidden');
}


function addComment(e) {
    if (e.preventDefault) e.preventDefault();
    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var list = document.getElementById('comments');
            var e = document.createElement('div');
            e.innerHTML = req.responseText;
            list.insertBefore(e, list.firstChild);
            hideForm();
        }
    };

    var form = document.getElementById('form-comment');
    var data = new FormData(form);

    req.open('POST', '/articles/comments.php', true);
    req.send(data);

    return false;
}

function deleteComment(comment_id){

    var req = new XMLHttpRequest();
    req.onreadystatechange = function(){

        if(req.readyState == 4 && req.status == 200){

            var elem = document.getElementById('comment-' + comment_id);
            elem.parentNode.removeChild(elem);
        }
    }

    req.open('DELETE', '/articles/comments.php', true);
    req.send("comment-id=" + comment_id);
}

(function () {
    var form = document.getElementById('form-comment');

    if (form.attachEvent) {
        form.attachEvent('submit', addComment);
    }
    else {
        form.addEventListener('submit', addComment);
    }
})();
