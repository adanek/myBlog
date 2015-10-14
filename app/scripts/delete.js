function deleteArticle (id){

    console.log("Deleting the article " + id + "...");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function(){
        if(req.readyState == 4 && req.status== 200){
            console.log('Article deleted');
        }

        window.location = "/articles/create.php";
    };

    req.open("DELETE", "/articles/delete.php", true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send("id="+ id);


}