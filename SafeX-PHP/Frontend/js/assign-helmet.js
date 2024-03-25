document.addEventListener('DOMContentLoaded', function() {
    var assignButtons = document.querySelectorAll('.assign-btn');

    assignButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            var siteId = this.getAttribute('data-userid');
            window.location.href = 'assign-helmet.php?siteId=' + siteId;
        });
    });
});

function updateTableData(siteId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_table.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Parse the response as JSON
            var data = JSON.parse(xhr.responseText);

            // Get the tableBody element
            var tableBody = document.getElementById("tableBody");

            // Clear previous table content
            tableBody.innerHTML = "";

            // Loop through the data and create new table rows
            data.forEach(function(row, index) {
                var newRow = document.createElement("tr");

                // Create table cells and append them to the new row
                var rowNumberCell = document.createElement("td");
                rowNumberCell.textContent = row.row_number;
                newRow.appendChild(rowNumberCell);

                var nameCell = document.createElement("td");
                nameCell.textContent = row.name;
                newRow.appendChild(nameCell);

                var positionCell = document.createElement("td");
                positionCell.textContent = row.position;
                newRow.appendChild(positionCell);

                var actionCell = document.createElement("td");
                if (row.action.startsWith("deleteWorker")) {
                    var actionButton = document.createElement("button");
                    actionButton.classList.add("btn", "btn-danger");
                    actionButton.setAttribute("onclick", row.action);
                    actionButton.textContent = "Delete";
                    actionCell.appendChild(actionButton);
                } else if (row.action.startsWith("manualAssignment")) {
                    var actionButton = document.createElement("button");
                    actionButton.classList.add("btn", "btn-danger");
                    actionButton.setAttribute("onclick", row.action);
                    actionButton.textContent = "Assign Worker";
                    actionCell.appendChild(actionButton);
                } else {
                    actionCell.innerHTML = row.action;
                }
                newRow.appendChild(actionCell);

                // Append the new row to the table body
                tableBody.appendChild(newRow);
            });
        }
    };

    var params = "siteId=" + encodeURIComponent(siteId);
    xhr.send(params);
}

