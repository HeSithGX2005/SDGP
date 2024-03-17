document.addEventListener('DOMContentLoaded', function() {
    const employeeDetails = localStorage.getItem('viewEmployeeDetails');
    if (employeeDetails) {
        const employee = JSON.parse(employeeDetails);
        displayEmployeeDetails(employee);
    } else {
        console.error('Employee details are not available.');
    }
});

function displayEmployeeDetails(employee) {
    const imagePath = employee.Photo ? `${API_URL}/uploads/${employee.Photo.split('\\').pop()}` : 'emp.jpg';

    // Set the image source
    document.getElementById('employeeImage').src = imagePath;
    
    // Set the text content for each detail
    document.getElementById('employeeId').textContent = employee.Employee_ID;
    document.getElementById('employeeName').textContent = employee.Employee_Name;
    document.getElementById('helmetId').textContent = employee.Helmet_ID;
    document.getElementById('position').textContent = employee.Position;
    document.getElementById('contactNo').textContent = employee.Telephone_No;
    document.getElementById('email').textContent = employee.Email;
    document.getElementById('joinDate').textContent = new Date(employee.Join_Date).toLocaleDateString();
}
