// Fetch and display alert history
function fetchAlertHistory() {
    const apiEndpoint = `${API_URL}/alert-history`; // Adjust if your endpoint is different

    fetch(apiEndpoint, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('token')}`
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Server returned status: ${response.status}`);
        }
        return response.json();
    })
    .then(alerts => {
        displayAlerts(alerts);
    })
    .catch(error => {
        console.error('Error fetching alert history:', error);
    });
}

// Display the fetched alerts in the table
function displayAlerts(alerts) {
    const tableBody = document.getElementById('alertHistoryBody');
    tableBody.innerHTML = ''; // Clear existing content

    alerts.forEach(alert => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${alert.Employee_Name}</td>
            <td class="mb-1" id="alertname">${alert.Alert_Type}</td>
            <td>${alert.Date}</td>
            <td>${alert.Time}</td>
            <td>${alert.Alert_ID}</td>
        `;
        tableBody.appendChild(row);
    });
}

// Ensure the function is called when the page is loaded
document.addEventListener('DOMContentLoaded', fetchAlertHistory);
