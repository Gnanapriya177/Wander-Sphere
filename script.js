	
const navBar = document.querySelector(".nav-bar");
const hamburger = document.querySelector(".hamburger-icon");
	
function toggleMenu(){
	navBar.classList.toggle("show");
}
	
document.addEventListener("click", function(event){
    if (!navBar.contains(event.target) && !hamburger.contains(event.target)) {
	    navBar.classList.remove("show");
}
});