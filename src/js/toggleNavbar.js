function toggleOffCanvas() {
    UIkit.offcanvas("#my-id").toggle();
    document.getElementById('hamburger-btn').classList.add("is-active");
}

UIkit.util.on("#my-id", "hide", function(){
    document.getElementById("hamburger-btn").classList.remove("is-active");
});
