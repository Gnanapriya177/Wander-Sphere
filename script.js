//Navigation Bar
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


// Registration File

$(document).ready(function () {

  // 🔹 Character restrictions
  restrictChars('.restrict-numbers-only', '1234567890');
  restrictChars('.restrict-money', '1234567890£.');
  restrictChars('.restrict-lowercase', 'abcdefghijklmnopqrstuvwxyz');
  restrictChars('.restrict-uppercase', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
  restrictChars('.restrict-uppercase-and-lowercase', 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz');
  restrictChars('.restrict-uppercase-and-lowercase-spaces', 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz ');
  restrictChars('.restrict-numbers-uppercase-lowercase-spaces', '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz ');

  function restrictChars(selector, allowedChars) {
      $(selector).on('keypress', function(event) {
          const chr = String.fromCharCode(event.which);
          if (allowedChars.indexOf(chr) < 0) {
              event.preventDefault();
          }
      });

      $(selector).on('input', function() {
          const pattern = new RegExp(`[^${allowedChars}]`, 'g');
          $(this).val($(this).val().replace(pattern, ''));
      });
  }

  // 🔹 Form validation
  const form = $("#regForm");

  form.on("submit", function (e) {
    const name = $("#name").val().trim();
    const email = $("#email").val().trim();
    const phone = $("#phone").val().trim();
    const password = $("#password").val().trim();

    if (name.length < 3) {
      alert("Name must be at least 3 characters long");
      e.preventDefault();
      return;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      alert("Enter a valid email address");
      e.preventDefault();
      return;
    }

    if (phone.length !== 10) {
      alert("Phone number must be 10 digits");
      e.preventDefault();
      return;
    }

    if (password.length < 6) {
      alert("Password must be at least 6 characters long");
      e.preventDefault();
      return;
    }
  });
});
