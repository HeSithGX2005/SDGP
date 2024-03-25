// config.js
// const API_URL = 'https://backend-6hbq.onrender.com'
const API_URL = 'http://localhost:8081'


document.addEventListener('DOMContentLoaded', function() {
    fetch('sidepanel1.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById('sidebar-placeholder').innerHTML = data;
            // Now attach the event listener to the logout link
            attachLogoutListener();
        });
});

function attachLogoutListener() {
    var logoutLink = document.getElementById('logoutLink');
    if (logoutLink) {
        logoutLink.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior

            // Clear all tokens and other data in local storage
            localStorage.clear();

            // Redirect to the login page
            window.location.href = 'login.html';
        });
    }
}