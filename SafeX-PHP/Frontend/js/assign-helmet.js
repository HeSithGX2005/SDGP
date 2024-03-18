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

function showFields() {
    var selectedOption = document.getElementById("dropdown").value;
    var dynamicForm = document.getElementById("dynamicForm");
    var dynamicContent = dynamicForm.querySelector(".dynamicform"); // Selecting the div with class "dynamicform"

    // Clear previous content inside dynamicContent
    dynamicContent.innerHTML = "";

    if (selectedOption === "Automatic") {
        dynamicContent.innerHTML += '<input type="hidden" id="input1" name="operation" value ="Automatic">';
        dynamicContent.innerHTML += '<label for="NumofWorker">Number of Worker:</label>';
        dynamicContent.innerHTML += '<input type="number" id="input1" name="NumofWorker" required>';
        dynamicContent.innerHTML += '<label for="NumofSupervisor">Number of Supervisor:</label>';
        dynamicContent.innerHTML += '<input type="number" id="input2" name="NumofSupervisor" required>';    
        dynamicContent.innerHTML += '<input type="submit" value="Assign Worker">';
    } else if (selectedOption === "Manual") {
        dynamicContent.innerHTML += '<input type="hidden" id="input1" name="operation" value ="Manual">';
        var dropdownHTML = '<label for="position">Position: </label>';
        dropdownHTML += '<select id="position" name="position" required>';
        dropdownHTML += '<option value="worker">Construction Worker</option>';
        dropdownHTML += '<option value="supervisor">Supervisor</option>';
        dropdownHTML += '</select>';
        
        // Append the dropdown menu HTML to dynamicContent
        dynamicContent.innerHTML += dropdownHTML;
        dynamicContent.innerHTML += '<label for="employeeSearch">Search Employee:</label>';
        dynamicContent.innerHTML += '<input type="text" id="employeeSearch" name="employeeSearch" placeholder="Search..." required>';
        dynamicContent.innerHTML += '<button type="button" onclick="searchEmployee()">Search</button>';
    }

    
    function sendAjaxRequest(value) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                } else {
                    console.error('Error:', xhr.statusText);
                }
            }
        };
        xhr.open('POST', 'update_table.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('selectedValue=' + encodeURIComponent(value));
    }
}