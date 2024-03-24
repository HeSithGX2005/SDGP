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
    const defaultImagePath = 'emp.jpg'; // Adjust this path

    // Build the image path
    const imagePath = employee.Photo ? `${API_URL}/uploads/${employee.Photo.replace(/\\/g, '/').split('/').pop()}` : defaultImagePath;

    // Get the image element
    const imageElement = document.getElementById('employeeImage');

    // Set the image source
    imageElement.src = imagePath;

    // Error handling if the image fails to load
    imageElement.onerror = function() {
        imageElement.src = defaultImagePath;
    };
    
    // Set the text content for each detail
    document.getElementById('employeeId').textContent = employee.Employee_ID;
    document.getElementById('employeeName').textContent = employee.Employee_Name;
    document.getElementById('helmetId').textContent = employee.Helmet_ID;
    document.getElementById('position').textContent = employee.Position;
    document.getElementById('contactNo').textContent = employee.Telephone_No;
    document.getElementById('email').textContent = employee.Email;
    document.getElementById('joinDate').textContent = new Date(employee.Join_Date).toLocaleDateString();
}

