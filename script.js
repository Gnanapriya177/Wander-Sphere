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

//File.html(form)

const form = document.getElementById("regForm");
  const userTable = document.getElementById("userTable");
  let users = JSON.parse(localStorage.getItem("users")) || [];

  // Display users in table
  function renderTable() {
    userTable.innerHTML = "";
    users.forEach((user, index) => {
      userTable.innerHTML += `
        <tr>
          <td>${user.name}</td>
          <td>${user.email}</td>
          <td>${user.phone}</td>
          <td class="actions">
            <button onclick="editUser(${index})">Edit</button>
            <button onclick="deleteUser(${index})">Delete</button>
          </td>
        </tr>`;
    });
  }

  // Save user (Create/Update)
  form.addEventListener("submit", function(e) {
    e.preventDefault();

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const password = document.getElementById("password").value.trim();
    const confirmPassword = document.getElementById("confirmPassword").value.trim();
    const editIndex = document.getElementById("editIndex").value;

    // Validation
    if (!name || !email || !phone || !password || !confirmPassword){
      alert("All fields are required!");
      return;
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      alert("Invalid email format!");
      return;
    }
    if (!/^\d{10}$/.test(phone)) {
      alert("Phone must be 10 digits!");
      return;
    }
    if (password !== confirmPassword) {
      alert("Passwords do not match!");
      return;
    }

    const user = { name, email, phone, password };

    if (editIndex === "") {
      // Create
      users.push(user);
    } else {
      // Update
      users[editIndex] = user;
      document.getElementById("editIndex").value = "";
    }

    localStorage.setItem("users", JSON.stringify(users));
    form.reset();
    renderTable();
  });

  // Edit user
  function editUser(index) {
    const user = users[index];
    document.getElementById("name").value = user.name;
    document.getElementById("email").value = user.email;
    document.getElementById("phone").value = user.phone;
    document.getElementById("password").value = user.password;
    document.getElementById("confirmPassword").value = user.password;
    document.getElementById("editIndex").value = index;
  }

  // Delete user
  function deleteUser(index) {
    if (confirm("Are you sure you want to delete this user?")) {
      users.splice(index, 1);
      localStorage.setItem("users", JSON.stringify(users));
      renderTable();
    }
  }

  // Initial render
  renderTable();