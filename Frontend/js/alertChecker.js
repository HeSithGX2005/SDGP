let lastFetchedTime = new Date(0); // Initialize with a very old date

function checkForNewAlerts() {
    fetch(`${API_URL}/alert-history`, {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(alerts => {
        const newAlerts = alerts.filter(alert => new Date(alert.Date) > lastFetchedTime);
        if (newAlerts.length > 0) {
            lastFetchedTime = new Date(newAlerts[0].Date); // Update the last fetched time
            if (confirm('New Alert Received! Please Click OK To Continue')) {
                window.location.href = 'dashboard.html';
            }
        }
    })
    .catch(error => console.error('Error checking for alerts:', error));
}
