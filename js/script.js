document.querySelector("#btnAddComment").addEventListener("click", function(){

    // postid
    let buddyId = this.getAttribute("data-buddyId");
    let text = document.querySelector("#commentText").value;

    console.log(buddyId);
    console.log(text);

    // post naar database -> ajax

    let formData = new FormData();

    formData.append('text', text);
    formData.append('buddyId', buddyId);

    fetch('ajax/savecomment.php', {
        method: 'POST',
        body: formData
    })
        .then((response) => response.json())
        .then((result) => {
            console.log("succes:", result);
        let newComment = document.createElement('li');
        newComment.innerHTML = result.body;
        document.querySelector(".post__comments__list").appendChild(newComment);

    })
        .catch((error) => {
        console.error('Error:', error);
    });

    // antw ok? toon comment

});

