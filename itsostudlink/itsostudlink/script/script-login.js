document.addEventListener('DOMContentLoaded', function() {
    const roleSelection = document.getElementById('role-selection');
    const loginForm = document.getElementById('login-form');
    const loginTitle = document.getElementById('login-title');
    const userTypeInput = document.getElementById('user-type');

    document.getElementById('student-role').addEventListener('click', function() {
        showLoginForm('Student');
    });

    document.getElementById('faculty-role').addEventListener('click', function() {
        showLoginForm('Faculty');
    });

    document.getElementById('admin-role').addEventListener('click', function() {
        showLoginForm('Admin');
    });

    function showLoginForm(role) {
        roleSelection.style.display = 'none';
        loginForm.style.display = 'block';
        loginTitle.textContent = role + ' Login';
        userTypeInput.value = role.toLowerCase();
    }
});