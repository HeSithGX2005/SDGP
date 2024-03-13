document.addEventListener("DOMContentLoaded", function() {
    // Fetch alert history data from the database
    fetchAlertHistory();
  });
  
  function fetchAlertHistory() {
    // Simulated data from a database (you should replace this with actual fetch request)
    const alertHistoryData = [
      { id: 1, message: "Alert 1 message" },
      { id: 2, message: "Alert 2 message" },
      { id: 3, message: "Alert 3 message" }
    ];
  
    // Select the container to populate with alert history
    const alertHistoryContainer = document.getElementById("alert-history");
  
    // Create HTML elements for each alert and append them to the container
    alertHistoryData.forEach(alert => {
      const alertElement = document.createElement("div");
      alertElement.classList.add("col-sm-6", "mb-3", "mb-sm-0");
      alertElement.innerHTML = `
        <div class="card">
          <div class="card-body alerts">
            <p class="card-text">${alert.message}</p>
          </div>
        </div>
      `;
      alertHistoryContainer.appendChild(alertElement);
    });
  }
  
