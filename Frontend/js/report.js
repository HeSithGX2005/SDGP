document.getElementById('issueForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const issue = document.getElementById('issue').value;

    fetch(`${API_URL}/reportIssue`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ name: name, email: email, issue: issue })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(data => {
        // Alert removed for streamlined UX
        window.location.href = 'dashboard.html'; // Redirect to dashboard.html
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error reporting the issue');
    });
});