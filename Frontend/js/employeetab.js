document.addEventListener('DOMContentLoaded', function() {
    const searchButton = document.getElementById('searchButton');
    const searchInput = document.getElementById('searchInput');

    loadEmployees();

    searchButton.addEventListener('click', function() {
        loadEmployees(searchInput.value.trim().toLowerCase());
    });

    // Optional: Trigger search when the enter key is pressed
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            loadEmployees(searchInput.value.trim().toLowerCase());
        }
    });
});

function loadEmployees(searchText = '') {
    const token = localStorage.getItem('token');
    fetch(`${API_URL}/employees`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
        }
    })
    .then(response => response.json())
    .then(employees => {
        if (searchText) {
            employees = employees.filter(employee => employee.Employee_Name.toLowerCase().includes(searchText));
        }
        displayEmployees(employees);
    })
    .catch(error => console.error('Error loading employees:', error));
}

function displayEmployees(employees) {
    const employeeContainer = document.getElementById('employeeContainer');
    employeeContainer.innerHTML = '';

    employees.forEach(employee => {
        const imagePath = employee.Photo ? `${API_URL}/uploads/${employee.Photo.split('\\').pop()}` : 'emp.jpg';
        
        const employeeCard = `
            <div class="col-xl-3 col-sm-6 mb-5">
                <div class="bg-white rounded shadow-sm py-5 px-4">
                    <img src="${imagePath}" alt="${employee.Employee_Name}" style="width: 100px; height: 100px; object-fit: cover;" class="rounded-circle mb-3">
                    <h5 class="mb-0">${employee.Employee_Name}</h5>
                    <div class="defaultbutton">
                        <a href="livedefault.html" class="btn btn-primary">Live</a>
                        <button class="btn btn-primary view-button" data-employee-id="${employee.Employee_ID}">View</button>
                    </div>
                </div>
            </div>
        `;
        employeeContainer.insertAdjacentHTML('beforeend', employeeCard);
    });

    // Adding event listeners to the view buttons after they are added to the DOM
    const viewButtons = employeeContainer.querySelectorAll('.view-button');
    viewButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            const employeeId = this.getAttribute('data-employee-id');
            // Implement the logic to fetch employee details and redirect to view page
            console.log('Employee ID for view:', employeeId);
            // For now, just console.log the ID. You'll replace this with the fetchEmployeeDetails logic
        });
    });
}


document.addEventListener('DOMContentLoaded', function() {
    const addButton = document.getElementById('addbutton'); // Make sure this ID matches your Add Employee button in HTML

    // Retrieve the JWT token from localStorage
    const token = localStorage.getItem('token');
    if (token) {
        const user = parseJwt(token);

        if (user.role === 'Super_Admin') {
            addButton.addEventListener('click', function() {
                // Redirect to the add employee page or show the add employee form
                window.location.href = 'addemployee.html';
            });
        } else if (user.role === 'Admin') {
            addButton.addEventListener('click', function() {
                // Show an alert message
                alert('You are not authorized for this activity.');
            });
        } else {
            // Hide the button if the user is not an admin or super admin
            addButton.style.display = 'none';
        }
    } else {
        // If no token is found or it's invalid, redirect to login page or hide the button
        addButton.style.display = 'none';
        // Optionally, redirect to the login page
        // window.location.href = 'login.html';
    }
});

// Helper function to parse the JWT token
function parseJwt(token) {
    try {
        const base64Url = token.split('.')[1];
        const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        return JSON.parse(window.atob(base64));
    } catch (e) {
        return null;
    }
}


document.addEventListener('click', function(event) {
    if (event.target.classList.contains('view-button')) {
        const employeeId = event.target.getAttribute('data-employee-id');
        fetchEmployeeDetails(employeeId);
    }
});

function fetchEmployeeDetails(employeeId) {
    const token = localStorage.getItem('token');

    fetch(`${API_URL}/Employee`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
        },
        body: JSON.stringify({ Employee_ID: employeeId }) // Sending the Employee_ID in the request body
    })
    .then(response => response.json())
    .then(employeeDetails => {
        // Now you have the employee details, you need to populate these into the viewdefault.html
        // This will likely involve storing the details in localStorage and redirecting to that page
        localStorage.setItem('viewEmployeeDetails', JSON.stringify(employeeDetails));
        window.location.href = 'viewdefault.html'; // Redirect to the view page
    })
    .catch(error => console.error('Error fetching employee details:', error));
}


// Add event listener to each "View" button after employee cards are created
function addViewButtonListeners() {
    document.querySelectorAll('.view-button').forEach(button => {
        button.addEventListener('click', function() {
            const employeeId = this.getAttribute('data-employee-id');
            // Store the employee ID and redirect
            localStorage.setItem('currentViewingEmployeeId', employeeId);
            window.location.href = 'viewdefault.html';
        });
    });
}

// Call this function after you create the employee cards
addViewButtonListeners();


