document.getElementById('generateReportBtn').addEventListener('click', function() {
    fetch(`${API_URL}/generate-report`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('token')}` // Assuming the token is stored in localStorage
        },
        // Include any other necessary data in the body as per your server logic
        body: JSON.stringify({ /* Your data here */ })
    })
    .then(response => {
        console.log(response); // Log the response for debugging purposes
        if (!response.ok) {
            if(response.status === 403) {
                alert('You are not authorized to perform this action.');
            } else {
                alert('There was a problem generating the report.');
            }
            // If the response isn't okay and isn't a 403, you might not want to throw here
            // as it will skip the rest of the promise chain.
            return Promise.reject('Network response was not ok ' + response.statusText);
        }
        return response.json(); // This will fail if the response is not JSON or empty
    })
    .then(data => {
        console.log(data); // Log the data
        alert('Report generated and email sent successfully!');
    })
    .catch(error => {
        console.error('There has been a problem with your fetch operation:', error);
        // Optionally, you can alert the user here if you want
    });
});
