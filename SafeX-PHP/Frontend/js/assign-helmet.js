document.addEventListener('DOMContentLoaded', function() {
    var assignButtons = document.querySelectorAll('.assign-btn');

    assignButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            var userId = this.getAttribute('data-userid');
            window.location.href = 'assign-helmet.php?user_id=' + userId;
        });
    });
});

function showFields() {
    var selectedOption = document.getElementById("dropdown").value;
    var dynamicForm = document.getElementById("dynamicForm");
    
    dynamicForm.innerHTML = "";
    
    if (selectedOption === "Automatic") {
        dynamicForm.innerHTML += '<label for="NumofWorker">Number of Worker:</label>';
        dynamicForm.innerHTML += '<input type="number" id="input1" name="NumofWorker" required>';
        dynamicForm.innerHTML += '<label for="NumofSupervisior">Number of Supervisior:</label>';
        dynamicForm.innerHTML += '<input type="number" id="input1" name="NumofSupervisior" required>';    
        dynamicForm.innerHTML += '<input type="submit" value="Assign Worker">';
    } else if (selectedOption === "Manual") {
        var dropdownHTML = '<label for="position">Position: </label>';
        dropdownHTML += '<select id="position" name="position" required>';
        dropdownHTML += '<option value="worker">Construction Worker</option>';
        dropdownHTML += '<option value="supervisor">Supervisor</option>';
        dropdownHTML += '</select>';
        
        // Append the dropdown menu HTML to dynamicForm
        dynamicForm.innerHTML += dropdownHTML;;
        dynamicForm.innerHTML += '<label for="employeeSearch">Search Employee:</label>';
        dynamicForm.innerHTML += '<input type="text" id="employeeSearch" name="employeeSearch" placeholder="Search..." required>';
        dynamicForm.innerHTML += '<button type="button" onclick="searchEmployee()">Search</button>';
        
    } 
    
}