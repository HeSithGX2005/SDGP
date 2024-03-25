document.addEventListener('DOMContentLoaded', function() {
    displayUsername();
    fetchMaterials();
    fetchAlertHistory();
    fetchWorkersOnLeave();
});

function displayUsername() {
    const token = localStorage.getItem('token');
    if (!token) {
        console.log('No token found');
        return;
    }

    const payload = JSON.parse(atob(token.split('.')[1]));
    const username = payload.username; // Adjust depending on your token structure

    document.getElementById('username').textContent = username || 'Unknown';
}

function fetchMaterials() {
  const apiEndpoint = `${API_URL}/materials`; // Adjust this if your endpoint is different

  fetch(apiEndpoint, {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json',
          // Include the Authorization header if your endpoint requires authentication
          'Authorization': `Bearer ${localStorage.getItem('token')}` // Assuming you store your token in localStorage
      }
  })
  .then(response => {
      if (!response.ok) {
          throw new Error(`Server returned status: ${response.status}`);
      }
      return response.json();
  })
  .then(materials => {
      displayMaterials(materials);
  })
  .catch(error => {
      console.error('Error fetching materials:', error);
  });
}

window.handleOrderButtonClick = function(materialType) {
  localStorage.setItem('selectedMaterialType', materialType);
  window.location.href = 'requestitem.html';
};


function displayMaterials(materials) {
  const materialsContainer = document.querySelector('.row.materials-row');
  materialsContainer.innerHTML = '';

  materials.forEach(material => {
      const materialCard = `
          <div class="col-sm-6 mb-3 mb-sm-0">
              <div class="card">
                  <div class="card-body materials">
                      <h6 class="card-title">${material.Type}</h6>
                      <button onclick="handleOrderButtonClick('${material.Material_ID}', '${material.Type}')" class="btn btn-light">Order</button>
                  </div>
              </div>
          </div>
      `;
      materialsContainer.insertAdjacentHTML('beforeend', materialCard);
  });
}

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

function displayAlerts(alerts) {
  const alertsContainer = document.querySelector('.alerts'); // Make sure this selector matches your HTML
  alertsContainer.innerHTML = ''; // Clear the container

  alerts.forEach(alert => {
      const alertCard = `
          <div class="alert-card">
              <div class="alert-type">${alert.Alert_Type}</div>
              <div class="alert-info">
                  <div class="alert-date">${formatDate(alert.Date)}</div>
                  <div class="alert-time">${alert.Time}</div>
              </div>
              <div class="alert-employee">${alert.Employee_Name}</div>
          </div>
      `;
      alertsContainer.insertAdjacentHTML('beforeend', alertCard);
  });
}

function formatDate(dateString) {
  const options = { year: 'numeric', month: 'short', day: 'numeric' };
  return new Date(dateString).toLocaleDateString(undefined, options);
}

function fetchWorkersOnLeave() {
    const apiEndpoint = `${API_URL}/workers-on-leave`; 
  
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
    .then(leaveRecords => {
        displayWorkersOnLeave(leaveRecords);
    })
    .catch(error => {
        console.error('Error fetching workers on leave:', error);
    });
}

function normalizeImagePath(path, defaultImagePath) {
    if (!path) return defaultImagePath;
    return `${API_URL}/uploads/${path.replace(/\\/g, '/').split('/').pop()}`;
}

function displayWorkersOnLeave(leaveRecords) {
    const leaveContainer = document.querySelector('.leave'); // Update the selector as per your HTML
    leaveContainer.innerHTML = ''; // Clear the container

    leaveRecords.forEach(record => {
        // Adjust defaultImagePath if necessary
        const defaultImagePath = 'emp.jpg'; // 'emp.jpg' is a fallback image
        
        // Construct the image path
        const imagePath = record.Photo ? `${API_URL}/uploads/${record.Photo.replace(/\\/g, '/').split('/').pop()}` : defaultImagePath;

        const leaveCard = `
            <div class="worker-leave-card">
                <img src="${imagePath}" alt="${record.Employee_Name}" class="img-fluid rounded-circle mb-3" onerror="this.onerror=null;this.src='${defaultImagePath}';">
                <div class="worker-leave-info">
                    <div class="worker-name">${record.Employee_Name}</div>
                    <!-- Add additional details here as needed -->
                </div>
            </div>
        `;
        leaveContainer.insertAdjacentHTML('beforeend', leaveCard);
    });
}

