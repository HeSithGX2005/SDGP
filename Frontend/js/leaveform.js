document.addEventListener('DOMContentLoaded', function() {
    initializeDatePickers();
    loadEmployeeIds();
});

function initializeDatePickers() {
    $('#fromDatePicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    $('#toDatePicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });
}

function loadEmployeeIds() {
    const employeeSelect = document.getElementById('employeeIdSelect');
    // Replace with your actual API endpoint
    fetch(`${API_URL}/employees`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('token')}`
        }
    })
    .then(response => response.json())
    .then(employees => {
        employees.forEach(employee => {
            const option = document.createElement('option');
            option.value = employee.Employee_ID;
            option.textContent = `${employee.Employee_ID} - ${employee.Employee_Name}`;
            employeeSelect.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error loading employee IDs.');
    });
}

document.getElementById('leaveForm').addEventListener('submit', function(event) {
    event.preventDefault();
    submitLeaveRequest();
});

function submitLeaveRequest() {
    const employeeId = document.getElementById('employeeIdSelect').value;
    const startDate = document.getElementById('dateFrom').value;
    const endDate = document.getElementById('dateTo').value;
    const reason = document.getElementById('comment').value;

    if (!employeeId || !startDate || !endDate || !reason) {
        alert('Please fill in all the fields.');
        return;
    }

    fetch(`${API_URL}/submitLeave`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('token')}`
        },
        body: JSON.stringify({ 
            Employee_ID: employeeId, 
            Start_Date: startDate, 
            End_Date: endDate, 
            Reason: reason 
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Server responded with an error!');
        }
        return response.text();
    })
    .then(data => {
        alert('Leave request submitted successfully!');
        document.getElementById('leaveForm').reset();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error submitting leave request.');
    });
}
