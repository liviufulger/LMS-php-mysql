
function toggleMenu() {
    const navBar = document.querySelector('.nav-bar');
    const authContainer = document.querySelector('.auth-container'); 

   
    navBar.classList.toggle('open');
    authContainer.classList.toggle('open');
}


function toggleForm() {
    const form = document.getElementById("createCourseForm");
    const table = document.querySelector(".admin-table");

    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
        table.style.display = "none"; // Hide the admin table
    } else {
        form.style.display = "none";
        table.style.display = "block"; // Show the admin table
    }
}

function showForm(formId) {
    // Hide all forms first
    const forms = document.querySelectorAll('.create-form');
    forms.forEach(form => {
        form.style.display = 'none';
    });

    // Show the selected form
    document.getElementById(formId).style.display = 'block';
}