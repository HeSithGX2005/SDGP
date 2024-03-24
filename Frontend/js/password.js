document.getElementById('changePasswordForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const currentPassword = document.getElementById('currentPassword').value;
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (newPassword !== confirmPassword) {
        alert("New Password and Confirm Password do not match.");
        return;
    }

    const apiEndpoint = `${API_URL}/changePassword`;

    fetch(apiEndpoint, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('token')}`
        },
        body: JSON.stringify({ oldPassword: currentPassword, newPassword: newPassword })
    })
    .then(response => {
        if (!response.ok) {
            // If the HTTP response status code is not in the range 200–299
            throw new Error(`Server returned status: ${response.status}`);
        }
        return response.text(); // Use text() instead of json() if the response is not guaranteed to be JSON
    })
    .then(text => {
        alert('Password changed successfully.');
        window.location.href = 'dashboard.html';
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error changing password.');
    });
});
