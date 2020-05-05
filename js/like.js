// document.querySelector("#btnLike").addEventListener("click", function(){

//     // postid
//     let likeId = this.getAttribute("data-likeId");
    
//     console.log(likeId);
// });

$(document).ready(function () {
    $("#btnLike").on("click", function () {
        // Here we are getting the reaction which is tapped by using the data-reaction attribute defined in main page
        var likeId = $(this).attr("data-likeId");
        console.log(likeId);
    });
});