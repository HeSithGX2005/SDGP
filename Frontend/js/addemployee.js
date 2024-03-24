document.getElementById('addEmployeeForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData();
    formData.append('name', document.getElementById('name').value);
    formData.append('email', document.getElementById('email').value);
    formData.append('position', document.getElementById('position').value);
    formData.append('telephoneNumber', document.getElementById('telephoneNumber').value);
    formData.append('hourlyRate', document.getElementById('hourlyRate').value);
    formData.append('joinDate', document.getElementById('joinDate').value);
    formData.append('helmetID', document.getElementById('helmetID').value);

    const imageFile = document.getElementById('image').files[0];
    if (imageFile) {
        formData.append('image', imageFile);
    }

    fetch(`${API_URL}/addEmployee`, {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`
        },
        body: formData // FormData will be sent correctly with the 'multipart/form-data' Content-Type
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            alert(data.message);
        } else {
            alert('Employee added successfully');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to add employee');
    });
});
