document.getElementById('submitButton').addEventListener('click', function(event) {
    event.preventDefault();

    const to = document.getElementById('to').value;
    const from = document.getElementById('from').value;
    const message = document.getElementById('message').value;

    fetch(`${API_URL}/sendMessage`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ to: to, from: from, message: message })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(data => {
        alert('Message sent successfully');
        document.getElementById('messageForm').reset(); // Reset the form after successful submission
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error sending message');
    });
});
