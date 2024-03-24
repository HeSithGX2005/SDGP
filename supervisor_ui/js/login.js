document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission
    
    // Get the input values
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    
    // Validate username and password (you can add your validation logic here)
    if (username === 'admin' && password === 'password') {
        // Redirect to dashboard.html after successful login
        window.location.href = 'dashboard.html';
    } else {
        // Show error message (you can customize this message)
        alert('Invalid username or password. Please try again.');
    }
});