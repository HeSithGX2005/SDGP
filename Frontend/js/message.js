document.getElementById('messageForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const form = this;
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
        form.reset(); // Reset the form after successful submission
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error sending message');
    });
});