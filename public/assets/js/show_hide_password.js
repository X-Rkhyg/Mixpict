// Get the password input element
const passwordInput = document.getElementById('password');

// Get the toggle button element
const toggleButton = document.getElementById('toggleButton');

// Add event listener to the toggle button
toggleButton.addEventListener('click', function() {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
});
