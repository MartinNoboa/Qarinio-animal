let open = false;

function toggleOffCanvas() {
    let offC = UIkit.offcanvas("#my-id");
    if(open){
        offC.hide();
    } else{
        offC.show();
    }
}
UIkit.util.on("#my-id", "hide", ()=>document.getElementById("hamburger-btn").classList.remove("is-active"));
UIkit.util.on("#my-id", "hidden", ()=>open=false);

UIkit.util.on("#my-id", "show", ()=>document.getElementById("hamburger-btn").classList.add("is-active"));
UIkit.util.on("#my-id", "shown", ()=>open=true);

// UIkit.util.on("#my-id", "hidden", function(){
//     document.getElementById("hamburger-btn").classList.remove("is-active");
//     open = false;
// });
// UIkit.util.on("#my-id", "shown", function(){
//     document.getElementById("hamburger-btn").classList.add("is-active");
//     open = true;
// });
